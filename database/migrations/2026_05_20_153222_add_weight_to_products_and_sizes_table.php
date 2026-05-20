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
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('weight', 8, 2)->nullable()->after('quantity_type')->comment('Weight in lbs for shipping');
        });

        Schema::table('product_sizes', function (Blueprint $table) {
            $table->decimal('weight', 8, 2)->nullable()->after('stock')->comment('Weight in lbs for shipping');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('weight');
        });

        Schema::table('product_sizes', function (Blueprint $table) {
            $table->dropColumn('weight');
        });
    }
};
