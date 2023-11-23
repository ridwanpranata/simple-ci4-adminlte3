<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    public function index(): string
    {
        $user_login = auth()->user();
        $data = [
            'title' => 'Home',
            'page_title' => 'Home',
            'user_login' => $user_login,
        ];
        
        return view('dashboard_home', $data);
    }
}