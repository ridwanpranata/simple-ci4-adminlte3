<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBooksTable extends Migration
{
    private $table = 'books';

    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'int',
                'unsigned' => true, 
                'auto_increment' => true
            ],
            'name' => [
                'type' => 'varchar', 
                'constraint' => 255
            ],
            'description' => [
                'type' => 'TEXT', 
                'null' => true
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
        $this->forge->addKey('id',true);
        $this->forge->createTable($this->table);
    }

    public function down()
    {
        $this->forge->dropTable($this->table);
    }
}
