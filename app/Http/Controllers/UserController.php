<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
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
            'userList' => $users,
            'roleList' => Role::all(),
        ]);
    }

    public function add(Request $request)
    {
        return Inertia::render('Users/Add', [
            
        ]);
    }

    public function updateDetails(Request $request)
    {
        // Update details
        $validated = $request->validate([
            'email' => ['email', 'max:255'],
        ]);
        $id = $request->id;
        $user = User::findOrFail($id);
        $user->fill($validated);
        $user->save();

        // Update role
        $roleIds = Role::all()->map(function($role) { return $role->id; });
        $accountTypeValidated = $request->validate([
            'accountType' => Rule::in($roleIds),
        ]);
        $role = Role::findOrFail($accountTypeValidated["accountType"]);
        $user->syncRoles($role);
    }

    public function updatePassword(Request $request)
    {

        $validated = $request->validate([
            'newPassword' => ['required'],
        ]);

        $user = User::findOrFail($request->id);

        $user->update([
            'password' => Hash::make($validated['newPassword']),
        ]);
        $user->save();
    }
}
