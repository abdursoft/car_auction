<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\VehicleModel;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
{
    // show add listing page 
    public function addListing()
    {
        $brands = Brand::all();
        $models = VehicleModel::all();

        return Inertia::render('seller/Sell', [
            'brands' => $brands,
            'models' => $models,
        ]);
    }
}
