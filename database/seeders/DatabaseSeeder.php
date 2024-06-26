<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(AdminsTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
        $this->call(StaffTableSeeder::class);
        $this->call(ProjectsTableSeeder::class);
      //  $this->call(TasksTableSeeder::class);
    }
}
