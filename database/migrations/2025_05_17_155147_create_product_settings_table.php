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
            $table->float('engine_volume')->nullable();

            $table->tinyInteger('engine_type')->nullable();
            $table->tinyInteger('drive_type')->nullable();
            $table->unsignedSmallInteger('power')->nullable();
            $table->unsignedSmallInteger('mileage')->nullable();

            $table->tinyInteger('doors_count')->nullable();
            $table->tinyInteger('seats_count')->nullable();

            $table->string('color')->nullable();
            $table->string('vin')->nullable()->unique();

            $table->boolean('is_customs_cleared')->default(true);
            $table->boolean('is_crashed')->default(false);
            $table->boolean('is_on_credit')->default(false);

            $table->decimal('price')->nullable()->default(0.00);
            $table->string('model_3d')->nullable()->after('is_on_credit');
            $table->string('image')->nullable()->after('model_3d');

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
