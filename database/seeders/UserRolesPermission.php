<?php
namespace Database\Seeders;


// database/seeders/RoleAssignmentSeeder.php

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserRolesPermission extends Seeder
{
    public function run()
    {
        // Get existing users by email
        $users = [
            'chairman' => 'mura0005@hz.nl',
            'activities committee member' => 'george123@hz.nl',
            'board member' => 'boardmember@hz.nl',
            'head of activities' => 'erk0002@hz.nl',
            'head of media' => 'mart0143@hz.nl',
            'media team member' => 'media_team_member@hz.nl',
            'secretary' => 'alex0031@hz.nl',
            'treasurer' => 'grig0009@hz.nl',
            'paid member' => 'paid_member@hz.nl',
        ];

        foreach ($users as $role => $email) {
            $user = User::where('email', $email)->first();

            if ($user) {
                $user->assignRole($role);
            }
        }
    }
}
