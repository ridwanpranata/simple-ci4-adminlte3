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

        $user = $users->findById($users->getInsertID());
        $user->syncGroups('developer');
        $user->syncPermissions('users.create', 'beta.access');
        // ## ===========================================
        
        $user = new User([
            'username' => 'admin',
            'email'    => 'admin@example.com',
            'password' => '123456789',
        ]);
        $users->save($user);

        $user = $users->findById($users->getInsertID());
        $user->syncGroups('admin');
        // ## ===========================================
        
        $user = new User([
            'username' => 'user',
            'email'    => 'user@example.com',
            'password' => '123456789',
        ]);
        $users->save($user);

        $user = $users->findById($users->getInsertID());
        $user->syncGroups('user');
        // ## ===========================================

        
    }
}
