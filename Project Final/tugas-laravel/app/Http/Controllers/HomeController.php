<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                $users = User::all();
                return view('dashboard.admin.home', compact('users'));
            } elseif (Auth::user()->role == 'student') {
                return view('dashboard.student.home');
            } elseif (Auth::user()->role == 'teacher') {
                return view('dashboard.teacher.home');
            }
        } else {
            return view('welcome');
        }
    }
}
