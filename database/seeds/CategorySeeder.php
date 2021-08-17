<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'T-Shirt',
                'desc' => 'Cotton t-shirts in a variety of colors and prints',
                'thumb' => 'https://e7.pngegg.com/pngimages/892/665/png-clipart-clothes-line-clothes-horse-clothes-hanger-towel-rakuten-t-shirt-icon-angle-text.png',
            ],
            [
                'name' => 'Pants',
                'desc' => 'Pants in a variety of colors and prints',
                'thumb' => 'https://w7.pngwing.com/pngs/627/271/png-transparent-pants-computer-icons-shorts-pants-icon-angle-text-trademark.png',
            ],
            [
                'name' => 'Socks',
                'desc' => 'Cotton socks in a variety of colors and prints',
                'thumb' => 'https://www.clipartmax.com/png/middle/172-1724718_socks-icon-sock.png',
            ],
        ]; 

        foreach ($categories as $category) {
            $newCategory = new Category();
            $newCategory->thumb = $category['thumb'];
            $newCategory->name = $category['name'];
            $newCategory->slug = Str::slug('cat' . ' ' . $category['name'], '-');
            $newCategory->desc = $category['desc'];
            $newCategory->save();
        };
    }
}
