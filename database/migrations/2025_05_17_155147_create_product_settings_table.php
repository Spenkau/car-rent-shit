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
        Schema::create('product_settings', function (Blueprint $table) {
            $table->id();


            $table->foreignId('product_id')->constrained()->cascadeOnDelete();

            $table->year('release_year');
            $table->tinyInteger('gearbox_type');
            $table->float('engine_volume');

            $table->tinyInteger('drive_type');
            $table->unsignedSmallInteger('power');
            $table->unsignedSmallInteger('mileage')->nullable();

            $table->tinyInteger('doors_count')->nullable();
            $table->tinyInteger('seats_count')->nullable();

            $table->string('color')->nullable();
            $table->string('vin')->nullable()->unique();

            $table->boolean('is_customs_cleared')->default(true);
            $table->boolean('is_crashed')->default(false);
            $table->boolean('is_on_credit')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_settings');
    }
};
