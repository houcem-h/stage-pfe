<?php

use Illuminate\Database\Seeder;

class MinutesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Minute::class, 20)->create();
    }
}
