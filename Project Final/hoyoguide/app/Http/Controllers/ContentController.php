<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Content;
use Illuminate\Http\Request;
use App\Models\ProgressRecord;
use App\Models\Student_Course;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ContentController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index($courseId) {
        if(Auth::check() && Auth::user()->role == 'teacher') {
            $course = Course::findOrFail($courseId);

            $contents = DB::select('
                SELECT contents.id, contents.judul, contents.materi
                FROM courses
                JOIN contents ON courses.id = contents.course_id
                WHERE courses.id = :courseId
            ', ['courseId' => $course->id]);

            return view('dashboard.teacher.content.content-list', compact('contents', 'course'));

        } elseif(Auth::check() && Auth::user()->role == 'student') {
            $course = Course::findOrFail($courseId);

            $contents = DB::table('contents')
                ->leftJoin('progress_records', 'contents.id', '=', 'progress_records.content_id')
                ->select('contents.id', 'contents.course_id', 'contents.judul', 'contents.materi', 'progress_records.progress')
                ->where('contents.course_id', $course->id)
                ->get();

            return view('dashboard.student.content.content-list', compact('contents', 'course'));
        } elseif(Auth::check() && Auth::user()->role == 'admin') {
            $course = Course::findOrFail($courseId);

            $contents = DB::select('
                SELECT contents.id, contents.judul, contents.materi
                FROM courses
                JOIN contents ON courses.id = contents.course_id
                WHERE courses.id = :courseId
            ', ['courseId' => $course->id]);

            return view('dashboard.admin.content.content-list', compact('contents', 'course'));
        }


        return redirect()->route('home');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($courseId) {
        if(Auth::check() && Auth::user()->role == 'teacher') {
            $course = Course::findOrFail($courseId);
            return view('dashboard.teacher.content.create-content', compact('course'));
        } elseif(Auth::check() && Auth::user()->role == 'admin') {
            $course = Course::findOrFail($courseId);
            return view('dashboard.admin.content.create-content', compact('course'));
        } else {
            abort(401);
        }
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $courseId) {
        if(Auth::check() && Auth::user()->role == 'teacher') {
            $request->validate([
                'judul' => 'required|string',
                'materi' => 'required|string',
            ]);

            Content::create([
                'judul' => $request->judul,
                'materi' => $request->materi,
                'course_id' => $courseId,
            ]);

            return redirect()->route('teacher.contents.index', ['courseId' => $courseId])->with('success', 'Content added successfully');

        } elseif(Auth::check() && Auth::user()->role == 'admin') {
            $request->validate([
                'judul' => 'required|string',
                'materi' => 'required|string',
            ]);

            Content::create([
                'judul' => $request->judul,
                'materi' => $request->materi,
                'course_id' => $courseId,
            ]);

            return redirect()->route('admin.contents.index', ['courseId' => $courseId])->with('success', 'Content added successfully');
        } else {
            abort(401);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($contentId) {
        $content = Content::findOrFail($contentId);
        $studentId = Auth::user()->id;

        $progressRecord = ProgressRecord::updateOrCreate(
            ['content_id' => $content->id, 'student__course_id' => $studentId],
            ['progress' => 0]
        );

        return view('dashboard.student.content.content-show', compact('content', 'progressRecord'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Content $content) {
        if(Auth::check() && Auth::user()->role == 'teacher') {
            return view('dashboard.teacher.content.edit-content', compact('content'));
        } else if(Auth::check() && Auth::user()->role == 'admin') {
            return view('dashboard.admin.content.edit-content', compact('content'));
        } else {
            abort(401);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Content $content) {
        if(Auth::check() && Auth::user()->role == 'teacher') {
            $request->validate([
                'judul' => 'required|string',
                'materi' => 'required|string',
            ]);

            $content->update([
                'judul' => $request->judul,
                'materi' => $request->materi,
            ]);

            return redirect()->route('teacher.contents.index', ['courseId' => $content->course_id])->with('success', 'Content updated successfully');

        } elseif(Auth::check() && Auth::user()->role == 'admin') {
            $request->validate([
                'judul' => 'required|string',
                'materi' => 'required|string',
            ]);

            $content->update([
                'judul' => $request->judul,
                'materi' => $request->materi,
            ]);

            return redirect()->route('admin.contents.index', ['courseId' => $content->course_id])->with('success', 'Content updated successfully');

        } else {
            abort(401);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Content $content) {
        if(Auth::check() && Auth::user()->role == 'teacher') {
            $courseId = $content->course_id;
            $content->delete();

            return redirect()->route('teacher.contents.index', ['courseId' => $courseId])->with('success', 'Content deleted successfully');
        } elseif(Auth::check() && Auth::user()->role == 'admin') {
            $courseId = $content->course_id;
            $content->delete();

            return redirect()->route('admin.contents.index', ['courseId' => $courseId])->with('success', 'Content deleted successfully');
        } else {
            abort(401);
        }
    }
}
