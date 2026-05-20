<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'brand_id',
        'has_sizes',
        'mrp_price',
        'selling_price',
        'quantity',
        'quantity_type',
        'sku',
        'barcode',
        'hsn_code',
        'stock',
        'min_stock',
        'description',
        'short_description',
        'batch_number',
        'purity',
        'verification_status',
        'coa_report',
        'images',
        'status',
        'is_featured',
        'weight'
    ];

    protected $casts = [
        'images' => 'array',
        'status' => 'boolean',
        'is_featured' => 'boolean',
        'has_sizes' => 'boolean',
        'mrp_price' => 'decimal:2',
        'selling_price' => 'decimal:2'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_sizes')
                    ->withPivot('mrp_price', 'selling_price', 'stock', 'image', 'weight')
                    ->withTimestamps();
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }
}
