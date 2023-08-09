<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Session;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminDashboardController extends Controller
{
    public function show()
    {
        $userCount = User::where('role', '<>', 'admin')->count();
        $questionCount = Question::count();
        $sessionCount = Session::count();

        return Inertia::render('Admin/Dashboard', [
            "userCount" => $userCount,
            "questionCount" => $questionCount,
            "sessionCount" => $sessionCount,
        ]);
    }
}
