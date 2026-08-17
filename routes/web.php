<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

// Route::get('/students', [StudentController::class, 'index'])
//     ->name('students.index');


// Route::get('/students/create', [StudentController::class, 'create'])
//     ->name('students.create');


// Route::post('/students', [StudentController::class, 'store'])
//     ->name('students.store');


// Route::get('/students/{student}', [StudentController::class, 'show'])
//     ->name('students.show');


// Route::get('/students/{student}/edit', [StudentController::class, 'edit'])
//     ->name('students.edit');


// Route::put('/students/{student}', [StudentController::class, 'update'])
//     ->name('students.update');



// Route::delete('/students/{student}', [StudentController::class, 'destroy'])
//     ->name('students.destroy');


// me 7 ma karanna ekak thiye eka me 7 ma karano but controller eketh ara gaththa function name ma ganna oni
// naththan laravel valata hoya ganna bari veno

Route::resource('students', StudentController::class);

Route::post('/students/{student}/subjects', [StudentController::class, 'enrollSubject'])
    ->name('students.subjects.enroll');


Route::delete('/students/{student}/subjects/{subject}', [StudentController::class, 'removeSubject'])
    ->name('students.subjects.remove');


Route::put('/students/{student}/subjects/{subject}', [StudentController::class, 'updateSubject'])
    ->name('students.subjects.update');
