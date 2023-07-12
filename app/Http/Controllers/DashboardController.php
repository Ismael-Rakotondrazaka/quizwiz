<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function show()
    {
        $user = request()->user();

        $sessionsPaginated = $user->sessions()->paginate(20);
        $sessionsPaginated->onEachSide(2)->links();

        $easyCount = $user->sessions()->where("difficulty", "easy")->count();
        $mediumCount = $user->sessions()->where("difficulty", "medium")->count();
        $hardCount = $user->sessions()->where("difficulty", "hard")->count();

        return Inertia::render('Dashboard', [
            "user" => $user,
            "sessionsPaginated" => $sessionsPaginated,
            "easyCount" => $easyCount,
            "mediumCount" => $mediumCount,
            "hardCount" => $hardCount,
        ]);
    }
}
