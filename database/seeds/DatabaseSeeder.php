<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(GroupsTableSeeder::class);
        $this->call(RegistrationTableSeeder::class);
        $this->call(CompaniesTableSeeder::class);
        $this->call(ManagersTableSeeder::class);
        $this->call(InternshipsTableSeeder::class);
        $this->call(DefensesTableSeeder::class);
        $this->call(MinutesTableSeeder::class);
    }
}
