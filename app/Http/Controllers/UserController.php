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
        $this->authorize('view', $user);

        $sessions = $user->sessions()->paginate(20);
        $sessions->onEachSide(2)->links();

        return Inertia::render('Users/ShowUser', [
            'user' => $user,
            'sessionsPaginated' => $sessions,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);

        return Inertia::render('Users/EditUser', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $validated = $request->safe()->only(['first_name', 'last_name']);

        $user->update([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
        ]);

        return redirect()->route('users.show', $user['id']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->authorize('forceDelete', $user);

        $user->delete();

        return redirect()->route('users.index');
    }
}
