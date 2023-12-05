<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == 'teacher') {
            $teacherId = Auth::user()->id;

            $courses = DB::table('courses')
                ->join('users as teachers', 'courses.teacher_id', '=', 'teachers.id')
                ->leftJoin('users as students', 'courses.student_id', '=', 'students.id')
                ->where('teachers.role', 'teacher')
                ->where('courses.teacher_id', $teacherId)
                ->orderBy('courses.updated_at', 'desc')
                ->select(
                    'courses.id',
                    'courses.course_name',
                    'courses.deskripsi',
                    'courses.tanggal_mulai',
                    'courses.tanggal_selesai',
                    'courses.teacher_id',
                    'teachers.name as teacher_name'
                )
                ->groupBy(
                    'courses.id',
                    'teachers.name',
                    'courses.course_name',
                    'courses.deskripsi',
                    'courses.tanggal_mulai',
                    'courses.tanggal_selesai',
                    'courses.teacher_id'
                )
                ->get();

            return view('dashboard.teacher.course-list', compact('courses'));

        } elseif (Auth::user()->role == 'student') {
            $courses = DB::table('courses')
                ->join('users as teachers', 'courses.teacher_id', '=', 'teachers.id')
                ->leftJoin('users as students', 'courses.student_id', '=', 'students.id')
                ->orderBy('courses.tanggal_selesai', 'desc')
                ->select(
                    'courses.id',
                    'courses.course_name',
                    'courses.deskripsi',
                    'courses.tanggal_mulai',
                    'courses.tanggal_selesai',
                    'courses.teacher_id',
                    'teachers.name as teacher_name'
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

            return view('dashboard.student.course-list', compact('courses'));
        }
        abort(401);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::check() && Auth::user()->role == 'teacher') {
            return view('dashboard.teacher.create-course');
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::check() && Auth::user()->role == 'teacher') {
            $request->validate([
                'course_name' => 'required|string',
                'deskripsi' => 'required|string',
                'tanggal_mulai' => 'required|date',
                'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
                'teacher_id' => 'required|exists:users,id,role,teacher',
            ]);

            Course::create([
                'course_name' => $request->course_name,
                'deskripsi' => $request->deskripsi,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'teacher_id' => $request->teacher_id,
            ]);

            return redirect()->to('course')->with('success', 'Course added successfully');
        } else {
            abort(401);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $selectedCourse = $course;
        return view('dashboard.teacher.edit-course', compact('selectedCourse'));
    }

    /**
     * Update the specified resource in storage.
     */public function update(Request $request, Course $course)
    {
        if (Auth::check() && Auth::user()->role == 'teacher') {
            $request->validate([
                'course_name' => 'required',
                'deskripsi' => 'required',
                'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            ], [
                'course_name.required' => 'Nama Course harus diisi',
                'deskripsi.required' => 'Deskripsi harus diisi',
                'tanggal_selesai.required' => 'Tanggal Selesai harus diisi',
                'tanggal_selesai.date' => 'Tanggal Selesai harus berupa tanggal',
                'tanggal_selesai.after_or_equal' => 'Tanggal Selesai harus setelah atau sama dengan Tanggal Mulai',
            ]);

            $data = [
                'course_name' => $request->course_name,
                'deskripsi' => $request->deskripsi,
                'tanggal_selesai' => $request->tanggal_selesai,
            ];

            Course::where('id', $course->id)->update($data);
            return redirect()->to('course')->with('success', 'Data berhasil diubah');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        if (Auth::check() && Auth::user()->role == 'teacher') {
            $course->delete();
            return redirect()->to('course')->with('success', "Course `$course->course_name` berhasil dihapus");
        }
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $courses = DB::table('courses')
            ->join('users as teachers', 'courses.teacher_id', '=', 'teachers.id')
            ->leftJoin('users as students', 'courses.student_id', '=', 'students.id')
            ->where('teachers.role', 'teacher')
            ->where('courses.course_name', 'like', '%' . $query . '%')
            ->orderBy('courses.tanggal_selesai', 'desc')
            ->select(
                'courses.id',
                'courses.course_name',
                'courses.deskripsi',
                'courses.tanggal_mulai',
                'courses.tanggal_selesai',
                'courses.teacher_id',
                'teachers.name as teacher_name'
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
    }
}
