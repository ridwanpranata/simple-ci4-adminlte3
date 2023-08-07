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
        return view('books/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Book Management',
            'page_title' => 'Create Book',
        ];

        return view('books/create', $data);
    }

    public function store()
    {
        dd($this->request->getPost());
        
        dd("store");
        
    }
}
