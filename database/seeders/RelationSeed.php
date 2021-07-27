<?php

namespace Database\Seeders;

use App\Models\Character;
use App\Models\Episode;
use App\Models\Quote;
use Illuminate\Database\Seeder;

class RelationSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $quotes = Quote::all();

        Character::all()->each(function ($character) use ($quotes) {
            $quotes = $quotes->random(rand(3, 7))->pluck('id')->toArray();
            $character->quotes()->attach($quotes);
        });

        $characters = Character::with('quotes:id')->get()->random(rand(5, 15));

        Episode::all()->each(function ($episode) use ($characters) {
            $characters->each(function ($character) use ($episode){
                $quotes = $character->quotes->pluck('id');
                $episode->quotes()->attach($quotes);
            });
            $characters = $characters->pluck('id')->toArray();
            $episode->characters()->attach($characters);
        });
    }
}
