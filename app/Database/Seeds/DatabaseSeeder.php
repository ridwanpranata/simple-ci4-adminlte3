<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('GroupsTableSeeder');
        $this->call('BooksTableSeeder');
        $this->call('UsersTableSeeder');
    }
}
