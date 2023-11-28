<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\Shield\Entities\User;


class UsersTableSeeder extends Seeder
{
    private $table = 'auth_groups';

    public function run()
    {
        $users = model(setting('Auth.userProvider'));

        $user = new User([
            'username' => 'developer',
            'email'    => 'developer@example.com',
            'password' => '123456789',
        ]);

        $users->save($user);

        // To get the complete user object with ID, we need to get from the database
        $user = $users->findById($users->getInsertID());

        // Add to developer group
        $user->syncGroups('developer');
    }
}
