<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('GroupsTableSeeder');
        $this->call('PermissionsCategoriesTableSeeder');
        $this->call('PermissionsTableSeeder');
        $this->call('GroupsHasPermisssionsTableSeeder');
        $this->call('BooksTableSeeder');
        $this->call('UsersTableSeeder');
    }
}
