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
            'chairman' => 'chairman@hz.nl',
            'activities committee member' => 'george123@hz.nl',
            'board member' => 'boardmember@hz.nl',
            'head of activities' => 'head_of_activities@hz.nl',
            'head of media' => 'head_of_media@hz.nl',
            'media team member' => 'media_team_member@hz.nl',
            'secretary' => 'secretary@hz.nl',
            'treasurer' => 'treasurer@hz.nl',
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
