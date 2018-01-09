<?php

use Illuminate\Database\Seeder;

class InternshipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Internship::class, 20)->create();
    }
}
