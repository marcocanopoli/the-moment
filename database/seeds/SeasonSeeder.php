<?php

use Illuminate\Database\Seeder;
use App\Season;

class SeasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seasons = [
            'SS20',
            'FW20',
            'SS21',
            'FW21',
            'SS22'
        ]; 

        foreach ($seasons as $index => $season) {
            $newSeason = new Season();
            $newSeason->name = $season;
            $newSeason->save();
        };
    }
}
