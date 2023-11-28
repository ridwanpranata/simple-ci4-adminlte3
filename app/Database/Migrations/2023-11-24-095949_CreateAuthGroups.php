<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAuthGroups extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'           => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name'         => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'title'         => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'description'  => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'created_at' => [
                'type' => 'datetime', 
                'null' => true
            ],
            'updated_at' => [
                'type' => 'datetime', 
                'null' => true
            ],
            'deleted_at' => [
                'type' => 'datetime', 
                'null' => true
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('auth_groups');
    }

    public function down()
    {
        $this->forge->dropTable('auth_groups');
    }
}
