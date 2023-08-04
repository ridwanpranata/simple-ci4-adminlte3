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
            'title' => 'Book List',
            'page_title' => 'Book List',
            'books' => $this->BookModel->findAll()
        ];
        return view('books/index', $data);
    }
}
