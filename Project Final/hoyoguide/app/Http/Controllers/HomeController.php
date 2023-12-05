<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
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
                $courses = DB::table('courses')
                    ->join('users as teachers', 'courses.teacher_id', '=', 'teachers.id')
                    ->leftJoin('users as students', 'courses.student_id', '=', 'students.id')
                    ->inRandomOrder()
                    ->limit(5)
                    ->select(
                        'courses.id',
                        'courses.course_name',
                        'courses.deskripsi',
                        'courses.tanggal_mulai',
                        'courses.tanggal_selesai',
                        'courses.teacher_id',
                        'teachers.name as teacher_name',
                    )
                    ->groupBy(
                        'courses.id',
                        'courses.course_name',
                        'courses.deskripsi',
                        'courses.tanggal_mulai',
                        'courses.tanggal_selesai',
                        'courses.teacher_id',
                        'teachers.name'
                    )
                    ->get();
            
                return view('dashboard.student.home-student', compact('courses'));
            } elseif (Auth::user()->role == 'teacher') {
                $courses = DB::table('courses')
                    ->join('users as teachers', 'courses.teacher_id', '=', 'teachers.id')
                    ->leftJoin('users as students', 'courses.student_id', '=', 'students.id')
                    ->where('teachers.role', 'teacher')
                    ->orderBy('courses.updated_at', 'desc')
                    ->select(
                        'courses.course_name',
                        'courses.deskripsi',
                        'courses.teacher_id',
                        'teachers.name as teacher_name'
                    )
                    ->groupBy('courses.id', 'teachers.name', 'courses.course_name', 'courses.deskripsi', 'courses.teacher_id')
                    ->get();

                return view('dashboard.teacher.home', compact('courses'));
            }
        } else {
            return view('welcome');
        }
    }
}
