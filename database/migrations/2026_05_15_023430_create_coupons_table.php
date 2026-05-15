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
        Schema::create('coupons', function (Blueprint $label) {
            $label->id();
            $label->string('code')->unique();
            $label->enum('type', ['percentage', 'fixed']);
            $label->decimal('value', 10, 2);
            $label->decimal('min_spend', 10, 2)->nullable();
            $label->integer('usage_limit')->nullable();
            $label->integer('usage_count')->default(0);
            $label->date('expiry_date');
            $label->text('description')->nullable();
            $label->boolean('status')->default(true);
            $label->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
