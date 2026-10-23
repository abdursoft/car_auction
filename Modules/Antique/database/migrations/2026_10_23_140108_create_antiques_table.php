<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('antiques', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('title');
            $table->string('maker')->nullable();
            $table->unsignedSmallInteger('estimated_year')->nullable();
            $table->string('material')->nullable();
            $table->text('provenance')->nullable();
            $table->text('condition_description')->nullable();
            $table->text('description')->nullable();

            $table->foreignUuid('antique_material_id')
                ->constrained('antique_materials')
                ->restrictOnDelete();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antiques');
    }
};
