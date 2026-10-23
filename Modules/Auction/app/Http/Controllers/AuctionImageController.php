<?php

namespace Modules\Auction\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Modules\Auction\Models\Auction;
use Modules\Auction\Models\AuctionImage;

class AuctionImageController extends Controller
{
    public function index(Auction $auction)
    {
        return response()->json([
            'data' => $auction->images()
                ->orderBy('sort_order')
                ->get()
                ->map(fn (AuctionImage $image) => [
                    'id' => $image->id,
                    'auction_id' => $image->auction_id,
                    'image_path' => $image->image_path,
                    'url' => Storage::disk('public')->url($image->image_path),
                    'alt_text' => $image->alt_text,
                    'is_primary' => $image->is_primary,
                    'sort_order' => $image->sort_order,
                ]),
        ]);
    }

    public function store(Request $request, Auction $auction)
    {
        $validated = $request->validate([
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'alt_text' => ['nullable', 'string', 'max:255'],
            'is_primary' => ['sometimes', 'boolean'],
            'sort_order' => ['sometimes', 'integer', 'min:0'],
        ]);

        $path = $request->file('image')->store('auction-images', 'public');

        try {
            $image = DB::transaction(function () use ($auction, $validated, $path) {
                $makePrimary = (bool) ($validated['is_primary'] ?? false);

                if ($makePrimary || !$auction->images()->exists()) {
                    $auction->images()->update(['is_primary' => false]);
                    $makePrimary = true;
                }

                return $auction->images()->create([
                    'image_path' => $path,
                    'alt_text' => $validated['alt_text'] ?? null,
                    'is_primary' => $makePrimary,
                    'sort_order' => $validated['sort_order'] ?? 0,
                ]);
            });
        } catch (\Throwable $exception) {
            Storage::disk('public')->delete($path);
            throw $exception;
        }

        return response()->json([
            'message' => 'Auction image uploaded successfully.',
            'data' => [
                'id' => $image->id,
                'auction_id' => $image->auction_id,
                'image_path' => $image->image_path,
                'url' => Storage::disk('public')->url($image->image_path),
                'alt_text' => $image->alt_text,
                'is_primary' => $image->is_primary,
                'sort_order' => $image->sort_order,
            ],
        ], 201);
    }

    public function show(Auction $auction, AuctionImage $auctionImage)
    {
        $this->ensureBelongsToAuction($auction, $auctionImage);

        return response()->json([
            'data' => $auctionImage,
            'url' => Storage::disk('public')->url($auctionImage->image_path),
        ]);
    }

    public function update(Request $request, Auction $auction, AuctionImage $auctionImage)
    {
        $this->ensureBelongsToAuction($auction, $auctionImage);

        $validated = $request->validate([
            'image' => ['sometimes', 'required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'alt_text' => ['sometimes', 'nullable', 'string', 'max:255'],
            'is_primary' => ['sometimes', 'boolean'],
            'sort_order' => ['sometimes', 'integer', 'min:0'],
        ]);

        $newPath = null;

        if ($request->hasFile('image')) {
            $newPath = $request->file('image')->store('auction-images', 'public');
        }

        try {
            DB::transaction(function () use ($auction, $auctionImage, $validated, $newPath) {
                if (($validated['is_primary'] ?? false) === true) {
                    $auction->images()
                        ->where('id', '!=', $auctionImage->id)
                        ->update(['is_primary' => false]);
                }

                $updates = collect($validated)->only([
                    'alt_text',
                    'is_primary',
                    'sort_order',
                ])->all();

                if ($newPath !== null) {
                    $updates['image_path'] = $newPath;
                }

                $auctionImage->update($updates);
            });
        } catch (\Throwable $exception) {
            if ($newPath !== null) {
                Storage::disk('public')->delete($newPath);
            }

            throw $exception;
        }

        if ($newPath !== null) {
            Storage::disk('public')->delete(
                $auctionImage->getOriginal('image_path')
            );
        }

        return response()->json([
            'message' => 'Auction image updated successfully.',
            'data' => $auctionImage->fresh(),
            'url' => Storage::disk('public')->url($auctionImage->fresh()->image_path),
        ]);
    }

    public function destroy(Auction $auction, AuctionImage $auctionImage)
    {
        $this->ensureBelongsToAuction($auction, $auctionImage);

        DB::transaction(function () use ($auction, $auctionImage) {
            $wasPrimary = $auctionImage->is_primary;

            $auctionImage->delete();

            if ($wasPrimary) {
                $nextImage = $auction->images()
                    ->orderBy('sort_order')
                    ->orderBy('created_at')
                    ->first();

                $nextImage?->update(['is_primary' => true]);
            }
        });

        Storage::disk('public')->delete($auctionImage->image_path);

        return response()->json([
            'message' => 'Auction image deleted successfully.',
        ]);
    }

    private function ensureBelongsToAuction(
        Auction $auction,
        AuctionImage $auctionImage
    ): void {
        if ($auctionImage->auction_id !== $auction->id) {
            throw ValidationException::withMessages([
                'auction_image' => 'This image does not belong to the specified auction.',
            ]);
        }
    }
}