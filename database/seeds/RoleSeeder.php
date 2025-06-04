<?php

use Illuminate\Database\Seeder;
use Larapacks\Authorization\Role;

class RoleSeeder extends Seeder
{
    /**
     * The application roles.
     *
     * @var array
     */
    protected $roles = [
        [
             'name' => 'administrator',
             'label' => 'Administrator',
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->roles as $role) {
            $role = Role::firstOrCreate([
                'name' => $role['name'],
                'label' => $role['label'],
            ]);
        }
    }
}
