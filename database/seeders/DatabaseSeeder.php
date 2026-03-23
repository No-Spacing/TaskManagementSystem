<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Department;
use App\Models\Status;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
    }
}
