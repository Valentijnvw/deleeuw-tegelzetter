<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\User;

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
}
