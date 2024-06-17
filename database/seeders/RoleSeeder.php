<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            'chairman',
            'secretary',
            'treasurer',
            'head of media',
            'head of activities',
            'media team member',
            'activities committee member',
            'paid member',
            'board member',
        ];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }
    }
}
