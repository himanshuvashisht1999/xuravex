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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('brand_id')->nullable()->constrained()->nullOnDelete();
            
            // Pricing & Quantity
            $table->decimal('mrp_price', 10, 2);
            $table->decimal('selling_price', 10, 2)->nullable();
            $table->string('quantity')->nullable();
            $table->string('quantity_type')->nullable();
            
            // Inventory & Tracking
            $table->string('sku')->unique()->nullable();
            $table->string('barcode')->nullable();
            $table->string('hsn_code')->nullable();
            $table->integer('stock')->default(0);
            $table->integer('min_stock')->default(0);
            
            // Description
            $table->text('description')->nullable();
            $table->text('short_description')->nullable();
            
            // Lab / Technical Data
            $table->string('batch_number')->nullable();
            $table->string('purity')->nullable();
            $table->string('verification_status')->nullable(); // e.g., Verified
            $table->string('coa_report')->nullable(); // File path
            
            // Media & Status
            $table->json('images')->nullable();
            $table->boolean('status')->default(true);
            $table->boolean('is_featured')->default(false);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
