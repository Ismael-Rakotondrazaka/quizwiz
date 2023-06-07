<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SessionController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('/sessions')->middleware('auth')->group(function () {
    Route::name('sessions.')->group(function () {
        Route::controller(SessionController::class)->group(
            function () {
                Route::get('/create', 'create')->name('create');
                Route::post('/create', 'start')->name('start');
                Route::post('/store', 'store')->name('store');
            }
        );
    });
});

Route::prefix('/admin')->middleware('admin')->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Admin/Dashboard');
    })->name('admin.dashboard');

    Route::prefix('/questions')->group(function () {
        Route::name('questions.')->group(function () {
            Route::controller(QuestionController::class)->group(
                function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/create', 'create')->name('create');
                    Route::post('/store', 'store')->name('store');

                    Route::prefix('/{question}')->group(
                        function () {
                            Route::get('/', 'show')->name('show');
                            Route::get('/edit', 'edit')->name('edit');
                            Route::put('/update', 'update')->name('update');
                            Route::get('/delete', 'delete')->name('delete');
                            Route::delete('/destroy', 'destroy')->name('destroy');
                        }
                    );
                }
            );
        });

        Route::prefix('/{question}/answers')->group(function () {
            Route::name('answers.')->group(function () {
                Route::controller(AnswerController::class)->group(
                    function () {
                        Route::get('/create', 'create')->name('create');
                        Route::post('/store', 'store')->name('store');

                        Route::prefix('/{answer}')->group(
                            function () {
                                Route::get('/edit', 'edit')->name('edit');
                                Route::put('/update', 'update')->name('update');
                                Route::get('/delete', 'delete')->name('delete');
                                Route::delete('/destroy', 'destroy')->name('destroy');
                            }
                        );
                    }
                );
            });
        });
    });
});

require __DIR__ . '/auth.php';
