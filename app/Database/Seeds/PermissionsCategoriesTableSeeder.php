<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PermissionsCategoriesTableSeeder extends Seeder
{
    private $table = 'auth_permissions_categories';

    public function run()
    {
        $data = [
            [
                'id' => 1,
                'name' => 'Admin Permission',
                'description' => 'Permission for Admin feature.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 2,
                'name' => 'Users Permission',
                'description' => 'Permission for Users feature.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 3,
                'name' => 'Beta Permission',
                'description' => 'Permission for Beta feature.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 4,
                'name' => 'Book Permission',
                'description' => 'Permission for Book feature.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table($this->table)->insertBatch($data);
    }
}
