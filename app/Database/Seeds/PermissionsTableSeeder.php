<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    private $table = 'auth_permissions';

    public function run()
    {
        $data = [
            [
                'id' => 1,
                'name' => 'admin.access',
                'description' => 'Can access the sites admin area.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 2,
                'name' => 'admin.settings',
                'description' => 'Can access the main site settings.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 3,
                'name' => 'manage-admins',
                'description' => 'Can manage other admins.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 4,
                'name' => 'users.create',
                'description' => 'Can create new non-admin users.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 5,
                'name' => 'users.edit',
                'description' => 'Can edit existing non-admin users.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 6,
                'name' => 'users.delete',
                'description' => 'Can delete existing non-admin users.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 7,
                'name' => 'beta.access',
                'description' => 'Can access beta-level features.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 8,
                'name' => 'book.access',
                'description' => 'Can Can access book features.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 9,
                'name' => 'book.create',
                'description' => 'Can create new book.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 10,
                'name' => 'book.edit',
                'description' => 'Can edit new book.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 11,
                'name' => 'book.delete',
                'description' => 'Can delete new book.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table($this->table)->insertBatch($data);
    }
}
