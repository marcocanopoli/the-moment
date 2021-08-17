<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $products = [
            [
                // 'thumb' => 'https://w7.pngwing.com/pngs/29/367/png-transparent-white-crew-neck-t-shirt-t-shirt-leia-organa-hoodie-clothing-t-shirts-tshirt-white-bracelet.png',
                'name' => 'Classic T-shirt',
                'anime' => 'Tokyo Ghoul',
                'anime_id' => 3,
                'desc' => 'Round neck white t-shirt',
                'color' => 'White',
                // 'season' => 'FW21',
                'season_id' => 1,
                'gender' => 'Unisex',
                'price' => 19.99
            ],
            [
                // 'thumb' => 'https://e7.pngegg.com/pngimages/282/778/png-clipart-black-crew-neck-shirt-t-shirt-sleeve-top-clothing-dress-shirt-tshirt-active-shirt.png',
                'name' => 'Classic T-shirt',
                'anime' => 'Tokyo Ghoul',
                'anime_id' => 3,
                'desc' => 'Round neck black t-shirt',
                'color' => 'Black',
                // 'season' => 'FW21',
                'season_id' => 2,
                'gender' => 'Unisex',
                'price' => 19.99
            ],
            [
                // 'thumb' => 'https://mpng.subpng.com/20180330/ooq/kisspng-t-shirt-navy-blue-polo-shirt-sweater-tshirt-5abe6ffdbdbe81.1204996515224299497772.jpg',
                'name' => 'Classic T-shirt',
                'anime' => 'Tokyo Ghoul',
                'anime_id' => 3,
                'desc' => 'Round neck blue t-shirt',
                'color' => 'Blue',
                // 'season' => 'FW21',
                'season_id' => 3,
                'gender' => 'Unisex',
                'price' => 19.99
            ],
            [
                // 'thumb' => 'https://www.pikpng.com/pngl/m/85-856781_shirt-clothing-dress-cloth-tank-top-comments-tank.png',
                'name' => 'Classic tanktop',
                'anime' => 'Erased',
                'anime_id' => 4,
                'desc' => 'Black tanktop',
                'color' => 'Black',
                // 'season' => 'SS20',
                'season_id' => 4,
                'gender' => 'Woman',
                'price' => 12.99
            ],
            [
                // 'thumb' => 'https://w7.pngwing.com/pngs/782/307/png-transparent-gilets-undershirt-sleeveless-shirt-neck-white-tank-top-white-black-vest.png',
                'name' => 'Classic vest',
                'anime' => 'Inuyasha',
                'anime_id' => 2,
                'desc' => 'White vest',
                'color' => 'White',
                // 'season' => 'SS21',
                'season_id' => 5,
                'gender' => 'Man',
                'price' => 14.99
            ]
        ]; 

        foreach ($products as $product) {
            
            $fullName = $product['anime'] . ' ' . $product['name'] . ' ' . $product['color'];
            
            $newPost = new product();
            $newPost->thumb = $product['thumb'];
            $newPost->name = $product['name'];           
            $newPost->anime_id = $product['anime_id'];            
            $newPost->slug = Str::slug($fullName, '-');
            // $newPost->prod_group = Str::slug(product['anime'] . $product['name'] . ' ' . 'group', '-');
            $newPost->desc = $product['desc'];
            $newPost->color = $product['color'];
            $newPost->season_id = $product['season_id'];
            $newPost->gender = $product['gender'];
            $newPost->price = $product['price'];

            $newPost->save();
        };
    }
}
