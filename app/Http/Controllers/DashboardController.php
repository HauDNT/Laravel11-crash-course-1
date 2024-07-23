<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        // Áp dụng middleware 'auth' cho tất cả các phương thức trong controller
        $this->middleware('auth');
    }


    public function index() {
        return view("users.dashboard");
    }
}
