<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // we don't get admins
        $usersPaginated = User::where('role', '<>', 'admin')->paginate(40);
        $usersPaginated->onEachSide(2)->links();

        return Inertia::render('Users/IndexUser', [
            'usersPaginated' => $usersPaginated,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // admin can't see other admins
        if ($user->isAdmin()) {
            abort(Response::HTTP_UNAUTHORIZED, 'Unauthorized');
        } else {
            $sessions = $user->sessions()->where('difficulty', 'easy')->paginate(10);
            $sessions->onEachSide(2)->links();

            return Inertia::render('Users/ShowUser', [
                'user' => $user,
                'sessions' => $sessions,
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // admin can't see other admins
        if ($user->isAdmin()) {
            abort(Response::HTTP_UNAUTHORIZED, 'Unauthorized');
        } else {
            return Inertia::render('Users/EditUser', [
                'user' => $user,
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        // admin can't update other admins
        if ($user->isAdmin()) {
            abort(Response::HTTP_UNAUTHORIZED, 'Unauthorized');
        } else {
            $validated = $request->safe()->only(['first_name', 'last_name']);

            $user->update([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
            ]);

            return redirect()->route('users.show', $user['id']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // admin can't delete other admins
        if ($user->isAdmin()) {
            abort(Response::HTTP_UNAUTHORIZED, 'Unauthorized');
        } else {
            $user->delete();

            return redirect()->route('users.index');
        }
    }
}
