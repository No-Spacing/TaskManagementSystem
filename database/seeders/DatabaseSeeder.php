<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Department;
use App\Models\Status;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Status::create(['name' => 'in progress']);
        Status::create(['name' => 'finished']);
        Status::create(['name' => 'active']);
        Status::create(['name' => 'inactive']);
 
        Department::create(['name' => 'Information Technology']);
        Department::create(['name' => 'Graphic Artist']);
        Department::create(['name' => 'Regulatory']);

        User::create([
            'email' => 'admin@pmcgroup.com',
            'name' => "Web Developer",
            'password' => 'password',
            'department_id' => 1,
            'status_id' => 3
        ]);

        User::factory(5)->create();
    }
}
