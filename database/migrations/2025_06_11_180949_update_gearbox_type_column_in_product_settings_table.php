<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('product_settings', function (Blueprint $table) {
            $table->tinyInteger('gearbox_type')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('product_settings', function (Blueprint $table) {
            $table->tinyInteger('gearbox_type')->nullable(false)->change();
        });
    }
};
