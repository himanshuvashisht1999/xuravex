<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure categories exist
        $categories = ['Research Chemicals', 'Lab Supplies', 'Proteins', 'Peptides', 'Analytical Standards'];
        foreach ($categories as $catName) {
            Category::updateOrCreate(['name' => $catName], ['slug' => Str::slug($catName), 'status' => 1]);
        }

        // Ensure brands exist
        $brands = ['Xuravex Lab', 'Sigma-Aldrich', 'Thermo Fisher', 'Merck', 'Bio-Rad'];
        foreach ($brands as $brandName) {
            Brand::updateOrCreate(['name' => $brandName], ['status' => 1]);
        }

        $cats = Category::all();
        $brs = Brand::all();

        $productNames = [
            'D-Aspartic Acid (DAA) 99%',
            'BPC-157 Research Peptide',
            'TB-500 Recovery Solution',
            'Analytical Grade Ethanol 200 Proof',
            'Distilled Water Type I',
            'L-Glutathione Reduced',
            'Copper Peptide GHK-Cu',
            'Melanotan II Research Sample',
            'Sermorelin Acetate',
            'IGF-1 LR3 Recombinant',
            'CJC-1295 with DAC',
            'Snap-8 Anti-Aging Peptide',
            'Fragment 176-191',
            'AOD-9604 Fat Burner Research',
            'Ipamorelin 5mg Vial'
        ];

        $images = ['vial_sample.png', 'bottle_sample.png', 'kit_sample.png'];

        foreach ($productNames as $index => $name) {
            Product::create([
                'name' => $name,
                'slug' => Str::slug($name) . '-' . uniqid(),
                'description' => 'This is a high-purity research chemical intended for laboratory use only. Not for human consumption. This product ' . $name . ' is strictly for in-vitro laboratory research.',
                'mrp_price' => rand(1500, 5000),
                'selling_price' => rand(1000, 1400),
                'quantity' => rand(5, 50),
                'quantity_type' => rand(0, 1) ? 'Vial' : 'Bottle',
                'sku' => 'XUR-' . strtoupper(Str::random(6)),
                'barcode' => rand(1000000000, 9999999999),
                'hsn_code' => '3822',
                'stock' => rand(20, 100),
                'min_stock' => 10,
                'category_id' => $cats->random()->id,
                'brand_id' => $brs->random()->id,
                'status' => 1,
                'is_featured' => rand(0, 1),
                'batch_number' => 'BATCH-' . rand(100, 999),
                'purity' => '99.' . rand(1, 9) . '%',
                'verification_status' => 'Verified',
                'images' => [$images[rand(0, 2)]],
            ]);
        }
    }
}
