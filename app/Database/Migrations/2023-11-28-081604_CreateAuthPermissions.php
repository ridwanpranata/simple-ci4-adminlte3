<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAuthPermissions extends Migration
{
    private $table = 'auth_permissions';

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
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable($this->table);
    }

    public function down()
    {
        $this->forge->dropTable($this->table);
    }
}
