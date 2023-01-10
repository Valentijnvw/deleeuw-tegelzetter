<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SettingsController extends Controller
{
    public function setAppearance(Request $request) {
        $request->user()->update([
            'appearance' => $request->value,
        ]);
        return Redirect::back();
    }
}
