<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BooksTableSeeder extends Seeder
{
     private $table = 'books';

    public function run()
    {
        $data = [
            [
                'id' => 1,
                'Name' => 'Harry Poter',
                'Description' => 'Harry Potter is a series of seven fantasy novels written by British author J. K. Rowling. The novels chronicle the lives of a young wizard, Harry Potter, and his friends Hermione Granger and Ron Weasley, all of whom are students at Hogwarts School of Witchcraft and Wizardry.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 2,
                'Name' => 'The Hobbit',
                'Description' => "The Hobbit, or There and Back Again is a children's fantasy novel by English author J. R. R. Tolkien. It was published in 1937 to wide critical acclaim, being nominated for the Carnegie Medal and awarded a prize from the New York Herald Tribune for best juvenile fiction",
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table($this->table)->insertBatch($data);
    }
}
