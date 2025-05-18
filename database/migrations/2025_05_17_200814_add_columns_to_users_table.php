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
        Schema::table('users', function (Blueprint $table) {
            $table->string('surname')->nullable();
            $table->tinyInteger('role_id')->default(1);
            $table->string('phone')->nullable();

            $table->foreignId('product_id')->nullable()->constrained('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('surname');
            $table->dropColumn('role_id');
            $table->dropColumn('phone');

            $table->dropColumn('product_id');
        });
    }
};
