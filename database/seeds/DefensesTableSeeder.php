<?php

use Illuminate\Database\Seeder;

class DefensesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Defense::class, 20)->create();
    }
}
