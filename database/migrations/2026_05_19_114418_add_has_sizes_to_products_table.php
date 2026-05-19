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
            $table->boolean('has_sizes')->default(false)->after('brand_id');
            $table->decimal('mrp_price', 10, 2)->nullable()->change();
            $table->integer('stock')->nullable()->change();
        });

        Schema::table('product_sizes', function (Blueprint $table) {
            if (!Schema::hasColumn('product_sizes', 'image')) {
                $table->string('image')->nullable()->after('stock');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_sizes', function (Blueprint $table) {
            if (Schema::hasColumn('product_sizes', 'image')) {
                $table->dropColumn('image');
            }
        });

        Schema::table('products', function (Blueprint $table) {
            $table->decimal('mrp_price', 10, 2)->nullable(false)->change();
            $table->integer('stock')->default(0)->nullable(false)->change();
            $table->dropColumn('has_sizes');
        });
    }
};
