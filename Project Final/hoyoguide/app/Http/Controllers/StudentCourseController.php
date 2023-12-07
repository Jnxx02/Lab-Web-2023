<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use App\Models\ProgressRecord;
use App\Models\Student_Course;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StudentCourseController extends Controller {

    public function complete(Content $content) {
        $studentId = Auth::user()->id;

        $progressRecord = ProgressRecord::updateOrCreate(
            ['content_id' => $content->id, 'student__course_id' => $studentId],
            ['progress' => 100]
        );

        return redirect()->route('student.contents.index', ['courseId' => $content->course_id])
            ->with('success', 'Belajar selesai!');
    }
    public function studentCourses() {
        if(Auth::check() && Auth::user()->role == 'student') {
            $studentId = Auth::user()->id;

            $courses = DB::table('courses')
                ->leftJoin('student__courses', 'courses.id', '=', 'student__courses.course_id')
                ->join('users as teachers', 'courses.teacher_id', '=', 'teachers.id')
                ->join('users as students', 'student__courses.student_id', '=', 'students.id')
                ->where('student__courses.student_id', $studentId)
                ->orderBy('jumlah_peserta', 'desc')
                ->select(
                    'courses.id',
                    'courses.course_name',
                    'courses.deskripsi',
                    'courses.tanggal_mulai',
                    'courses.tanggal_selesai',
                    'courses.teacher_id',
                    'teachers.name as teacher_name',
                    DB::raw('
                    (SELECT COUNT(*) 
                    FROM student__courses 
                    WHERE student__courses.course_id = courses.id) as jumlah_peserta')
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


            if($courses->isEmpty()) {
                return view('dashboard.student.my-course', ['courses' => null, 'message' => 'Anda belum mengikuti kursus']);
            }

            return view('dashboard.student.my-course', compact('courses'));
        } else {
            abort(401);
        }
    }




    public function joinCourse($courseId) {
        if(Auth::check() && Auth::user()->role == 'student') {
            $userId = Auth::user()->id;

            $existingRecord = Student_Course::where('course_id', $courseId)
                ->where('student_id', $userId)
                ->first();

            if(!$existingRecord) {
                Student_Course::create([
                    'course_id' => $courseId,
                    'student_id' => $userId,
                ]);

                return redirect()->back()->with('success', 'Berhasil bergabung dengan course');
            } else {
                return redirect()->back()->with('error', 'Anda sudah bergabung dengan course ini');
            }
        } else {
            abort(401);
        }
    }
}
