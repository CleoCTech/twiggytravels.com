<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TestController extends Controller
{
    public function __construct(){
        $this->middleware('gen-auth')->only('dashboard');
        $this->middleware('admin-auth')->only('dashboard');
    }
    public function index(){
        // dd('here');
        return Inertia::render('Admin/Pages/Tests/Index');
    }
}