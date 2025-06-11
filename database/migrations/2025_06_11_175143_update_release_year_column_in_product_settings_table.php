<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('product_settings', function (Blueprint $table) {
            $table->dropColumn('release_year');
            $table->integer('release_year')->nullable()->after('product_id');
        });
    }

    public function down(): void
    {
        Schema::table('product_settings', function (Blueprint $table) {
            $table->dropColumn('release_year');
            $table->year('release_year')->after('product_id');
        });
    }
};
