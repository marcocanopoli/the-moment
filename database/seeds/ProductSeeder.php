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
                'thumb' => 'thumbnails/cEDaiPBZSpII2CC8LRA9qanwajvBYX7CMgf2FLZI.png',
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
                'thumb' => 'thumbnails/CS99UfV5GmBAYjrsAX9Y2VSj1NzQfbJY3NW4ZgdU.png',
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
                'thumb' => 'thumbnails/dhNRBR1d0jCBH8iLABwh7B3hdPojBLzW4dEQKXJl.png',
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
                'thumb' => 'thumbnails/Pne3TuDGrqgvwc0svEoH7g2RsilPuHvXTpDZsO2v.png',
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
                'thumb' => 'thumbnails/mFjCaEgpMqO94J1FVCYiaX9yq9PAE3opIuyFFZtm.png',
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
            $groupName = $product['anime'] . ' ' . $product['name'];

            $newPost = new product();
            $newPost->thumb = $product['thumb'];
            $newPost->name = $product['name'];           
            $newPost->anime_id = $product['anime_id'];            
            $newPost->slug = Str::slug($fullName, '-');
            $newPost->prod_group = Str::slug($groupName, '-');
            $newPost->desc = $product['desc'];
            $newPost->color = $product['color'];
            $newPost->season_id = $product['season_id'];
            $newPost->gender = $product['gender'];
            $newPost->price = $product['price'];

            $newPost->save();
        };
    }
}
