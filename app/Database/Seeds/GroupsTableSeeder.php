<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
     private $table = 'auth_groups';

    public function run()
    {
        $data = [
            [
                'id' => 1,
                'name' => 'developer',
                'title' => 'Developer',
                'description' => 'Site programmers.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 2,
                'name' => 'superadmin',
                'title' => 'Super Admin',
                'description' => 'Complete control of the site.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 3,
                'name' => 'admin',
                'title' => 'Admin',
                'description' => 'Day to day administrators of the site.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 4,
                'name' => 'user',
                'title' => 'User',
                'description' => 'General users of the site.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table($this->table)->insertBatch($data);
    }
}
