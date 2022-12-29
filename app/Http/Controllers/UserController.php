<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;
use App\Http\Requests\UserDetailsUpdateRequest;
use App\Models\User;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    /**
     * List users
     */
    public function list(Request $request)
    {
        $users = User::all()->map(function($user) {
            $user['roles'] = $user->getRoleNames();
            return $user;
        });

        return Inertia::render('Users/List', [
            'userList' => $users
        ]);
    }

    public function add(Request $request)
    {
        return Inertia::render('Users/Add', [
            
        ]);
    }

    public function updateDetails(UserDetailsUpdateRequest $request)
    {
        dd(Role::all());
        $id = $request->id;
        $user = User::findOrFail($id);
        $user->fill($request->validated());
        $user->save();
    }

    public function updatePassword(Request $request)
    {

        $validated = $request->validate([
            'password' => ['required'],
        ]);

        dd("12345");

        $id = $request->id;
        $user = User::findOrFail($id);

        $user->update([
            'password' => Hash::make($validated['newPassword']),
        ]);
        $user->save();
    }
}
