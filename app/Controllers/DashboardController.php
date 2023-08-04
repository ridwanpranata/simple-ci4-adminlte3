<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Home',
            'page_title' => 'Home',
        ];
        
        return view('dashboard_home', $data);
    }
}
