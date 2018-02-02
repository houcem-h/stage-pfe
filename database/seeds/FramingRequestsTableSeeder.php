<?php

use Illuminate\Database\Seeder;

class FramingRequestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\FramingRequest::class, 200)->create();
    }
}
