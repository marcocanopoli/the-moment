<?php

use App\Variant;
use Illuminate\Database\Seeder;

class VariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $variants = [
            [
                'product_id' => 1,
                'size' => 'S',
                'sku' => 'TG-CT-S-WHI',
                'discount' => 0,
                'availability' => 50,
                'stock' => 50,
            ],
            [
                'product_id' => 1,
                'size' => 'M',
                'sku' => 'TG-CT-M-WHI',
                'discount' => 0,
                'availability' => 100,
                'stock' => 100,
            ],
            [
                'product_id' => 1,
                'size' => 'L',
                'sku' => 'TG-CT-L-WHI',
                'discount' => 0,
                'availability' => 30,
                'stock' => 30,
            ],
            [
                'product_id' => 2,
                'size' => 'XXS',
                'sku' => 'TG-CT-XXS-BLA',
                'discount' => 0,
                'availability' => 20,
                'stock' => 20,
            ],
            [
                'product_id' => 2,
                'size' => 'M',
                'sku' => 'TG-CT-M-BLA',
                'discount' => 0,
                'availability' => 90,
                'stock' => 90,
            ],
            [
                'product_id' => 2,
                'size' => 'XL',
                'sku' => 'TG-CT-XL-BLA',
                'discount' => 0,
                'availability' => 60,
                'stock' => 60,
            ],
            [
                'product_id' => 3,
                'size' => 'S',
                'sku' => 'TG-CT-S-ORA',
                'discount' => 0,
                'availability' => 40,
                'stock' => 40,
            ],
            [
                'product_id' => 3,
                'size' => 'L',
                'sku' => 'TG-CT-L-ORA',
                'discount' => 0,
                'availability' => 70,
                'stock' => 70,
            ],
            [
                'product_id' => 3,
                'size' => 'XXL',
                'sku' => 'TG-CT-XXL-ORA',
                'discount' => 0,
                'availability' => 20,
                'stock' => 20,
            ],
        ];

        foreach ($variants as $variant) {
            // Variant::create($variant);
            $newVariant = new Variant();
            $newVariant->fill($variant);
            $newVariant->save();
        }
    }
}
