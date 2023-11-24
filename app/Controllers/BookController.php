<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BookModel;


class BookController extends BaseController
{
    protected $BookModel;

    public function __construct()
    {
        $this->BookModel = new BookModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Book Management',
            'page_title' => 'Book List',
            'books' => $this->BookModel->findAll()
        ];
        return view('book/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Book Management',
            'page_title' => 'Create Book',
        ];

        return view('book/create', $data);
    }

    public function store()
    {
        $name = $this->request->getPost('name');
        $description = $this->request->getPost('description');
        
        $new_book = [
            'name' => $name,
            'description' => $description,
        ];

        $insert_book = $this->BookModel->insert($new_book);
        return redirect()->to('book');
    }

    public function edit($book_id)
    {
        $data = [
            'title' => 'Book Management',
            'page_title' => 'Edit Book',
            'book' => $this->BookModel->find($book_id)
        ];
        return view('book/edit', $data);
    }

    public function update()
    {
        $book_id = $this->request->getPost('book_id');
        $name = $this->request->getPost('name');
        $description = $this->request->getPost('description');
        
        $edit_book = [
            'name' => $name,
            'description' => $description,
        ];

        $update_book = $this->BookModel->update($book_id, $edit_book);
        return redirect()->to('book');
    }
    
    public function delete($book_id)
    {
        $this->BookModel->delete($book_id);
        return redirect()->to('book');
    }
}
