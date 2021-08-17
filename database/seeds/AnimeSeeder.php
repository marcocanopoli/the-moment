<?php

use Illuminate\Database\Seeder;
use App\Anime;

class AnimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $anime = [
            'Cowboy Bebop',
            'Inuyasha',
            'Tokyo Ghoul',
            'Erased',
            'Neon Genesis Evangelion'
        ]; 

        foreach ($anime as $index => $item) {
            $newAnime = new Anime();
            $newAnime->name = $item;
            $newAnime->save();
        };
    }
}
