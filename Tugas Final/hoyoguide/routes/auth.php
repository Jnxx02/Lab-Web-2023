<?php

use App\Http\Controllers\StudentCourseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    Route::middleware('admin')->group(function () {
        Route::resource('user', UsersController::class)->names([
            'index' => 'user',
            'create' => 'user.create',
            'store' => 'user.store',
            'show' => 'user.show',
            'edit' => 'user.edit',
            'update' => 'user.update',
            'destroy' => 'user.destroy',
        ]);

        Route::resource('admin/courses', CourseController::class)->names([
            'index' => 'admin.courses.index',
            'create' => 'admin.courses.create',
            'store' => 'admin.courses.store',
            'show' => 'admin.courses.show',
            'edit' => 'admin.courses.edit',
            'update' => 'admin.courses.update',
            'destroy' => 'admin.courses.destroy',
        ]);

        Route::get('/admin/courses/{courseId}/contents', [ContentController::class, 'index'])
            ->name('admin.contents.index');

        Route::get('/admin/contents/create/{courseId}', [ContentController::class, 'create'])
            ->name('admin.contents.create');

        Route::post('/admin/contents/store/{courseId}', [ContentController::class, 'store'])
            ->name('admin.contents.store');

        Route::prefix('admin/contents')->group(function () {
            Route::get('{content}/edit', [ContentController::class, 'edit'])->name('admin.contents.edit');
            Route::put('{content}', [ContentController::class, 'update'])->name('admin.contents.update');
            Route::delete('{content}', [ContentController::class, 'destroy'])->name('admin.contents.destroy');
        });
    });

    Route::middleware('teacher')->group(function () {
        Route::resource('teacher/courses', CourseController::class)->names([
            'index' => 'teacher.courses.index',
            'create' => 'teacher.courses.create',
            'store' => 'teacher.courses.store',
            'show' => 'teacher.courses.show',
            'edit' => 'teacher.courses.edit',
            'update' => 'teacher.courses.update',
            'destroy' => 'teacher.courses.destroy',
        ]);

        Route::get('/teacher/courses/{courseId}/contents', [ContentController::class, 'index'])
            ->name('teacher.contents.index');

        Route::get('/teacher/contents/create/{courseId}', [ContentController::class, 'create'])
            ->name('teacher.contents.create');

        Route::post('/teacher/contents/store/{courseId}', [ContentController::class, 'store'])
            ->name('teacher.contents.store');

        Route::prefix('teacher/contents')->group(function () {
            Route::get('{content}/edit', [ContentController::class, 'edit'])->name('teacher.contents.edit');
            Route::put('{content}', [ContentController::class, 'update'])->name('teacher.contents.update');
            Route::delete('{content}', [ContentController::class, 'destroy'])->name('teacher.contents.destroy');
        });


    });

    Route::middleware('student')->group(function () {
        Route::get('/course', [CourseController::class, 'index'])->middleware(['auth', 'verified'])->name('course-list');
        Route::get('/courses/search', [CourseController::class, 'search'])->middleware(['auth', 'verified'])->name('courses.search');
        Route::post('/join-course/{courseId}', [StudentCourseController::class, 'joinCourse'])->name('join-course');
        Route::get('/my-courses', [StudentCourseController::class, 'studentCourses'])->name('my-courses');

        Route::get('/student/courses/{courseId}/contents', [ContentController::class, 'index'])
            ->name('student.contents.index');

        Route::get('/student/contents/{content}', [ContentController::class, 'show'])
            ->name('student.contents.show');

        Route::post('/student/contents/{content}/complete', [StudentCourseController::class, 'complete'])->name('student.contents.complete');

    });
});
