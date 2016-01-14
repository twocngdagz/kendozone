<?php

use App\Category;
use App\Tournament;
use App\TournamentCategory;
use App\TournamentCategoryUser;
use App\TournamentLevel;
use App\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TournamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $users = User::all()->pluck('id')->toArray();
        $levels = TournamentLevel::all()->pluck('id')->toArray();

        // Tournament creation
        Tournament::truncate();

        Tournament::create([
            'user_id' => 31,
            'name' => "Fake Tournoi",
            'date' => "2016-02-23",
            'registerDateLimit' => "2016-02-23",
            'cost' => 100,
            'sport' => 1,
            'type' => 0,
            'mustPay' => 1,
            'venue' => "CDOM",


        ]);
        foreach (range(1, 5) as $index) {
            Tournament::create([
                'user_id' => $faker->randomElement($users),
                'name' => $faker->title,
                'date' => "2016-02-23",
                'registerDateLimit' => "2016-02-23",
                'cost' => $faker->numberBetween(10,500),
                'sport' => 1,
                'type' => $faker->boolean(),
                'mustPay' => $faker->boolean(),
                'venue' => $faker->address,
                'latitude' => $faker->latitude,
                'longitude' => $faker->longitude,
                'level_id' => $faker->randomElement($levels),

            ]);

        }
        $tournaments = Tournament::all()->pluck('id')->toArray();
        $categories = Category::all()->pluck('id')->toArray();
        // Tournament categories creation
        TournamentCategory::truncate();
        foreach (range(1, 30) as $index) {
            TournamentCategory::create([
                'tournament_id' => $faker->randomElement($tournaments),
                'category_id' => $faker->randomElement($categories),
            ]);
        }


        // Tournament categories users

        TournamentCategoryUser::truncate();
        $tcs = TournamentCategory::all()->pluck('id')->toArray();
        foreach (range(2, 50) as $index) {
            TournamentCategoryUser::create([
                'category_tournament_id' => $faker->randomElement($tcs),
                'user_id' => $faker->randomElement($users),
                'confirmed' => $faker->numberBetween(0, 1),
            ]);
        }


    }
}