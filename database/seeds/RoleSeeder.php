<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'Admin',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Sales',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Sales Admin',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Finance',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Purchasing',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Warehouse',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Sales Manager',
                'guard_name' => 'web',
            ],
            [
                'name' => 'COO',
                'guard_name' => 'web',
            ],
            [
                'name' => 'QC',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Manager',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Technician',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Web Developer',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Dev Ops',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Surveyor',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Courier',
                'guard_name' => 'web'
            ]
        ];
        Role::insert($roles);
    }
}
