<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1, 25) as $index) {
            DB::table('companies')->insert([
                'name'          => $faker->name,
                'email'         => $faker->email,
                'website'       => $faker->domainName,
                'created_at'    => $faker->dateTime($max = 'now'),
                'updated_at'    => $faker->dateTime($max = 'now'),
            ]);
        }
    }
}
