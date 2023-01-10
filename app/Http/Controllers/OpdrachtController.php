<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Opdracht;
use App\Models\User;

class OpdrachtController extends Controller
{
    /*
        Alle opdrachten weergeven in lijst
    */
    public function list()
    {
        $opdrachten = Opdracht::all()->map(function($opdracht) {
            $opdracht['user'] = $opdracht->user;
            return $opdracht;
        });
        return Inertia::render('Opdrachten/List', [
            'opdrachtenList' => $opdrachten,
        ]);
    }

    public function add()
    {
        return Inertia::render('Opdrachten/Add');
    }
}
