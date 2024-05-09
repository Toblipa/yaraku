<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        DB::table('books')->insert([
            'title' => 'This is a title',
            'author' => 'Great Author',
        ]);

        foreach (range(1, 17) as $index) {
            DB::table('books')->insert([
                'title' => $faker->sentence,
                'author' => $faker->name,
            ]);
        }
    }
}
