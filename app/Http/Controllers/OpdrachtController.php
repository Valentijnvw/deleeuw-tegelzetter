<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use App\Models\Opdracht;
use App\Models\User;
use App\Services\MoneybirdContactService;

class OpdrachtController extends Controller
{
    /*
        Alle opdrachten weergeven in lijst
    */
    public function list()
    {
        $opdrachten = Opdracht::all()->map(function($opdracht) {
            $opdracht['contact'] = $opdracht->moneybirdContact;
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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titel' => 'required',
            'klant_moneybird_id' => 'required',
            'start_datum' => 'date|required',
            'eind_datum' => 'date|required',
            'omschrijving' => '',
        ]);
        $validated["start_datum"] = \Carbon\Carbon::parse($validated["start_datum"])->format("Y-m-d");
        $validated["eind_datum"] = \Carbon\Carbon::parse($validated["eind_datum"])->format("Y-m-d");

        $moneybirdContactService = new MoneybirdContactService($validated["klant_moneybird_id"]);
        $moneybirdContactService->insertOrUpdateContact();

        $opdracht = new Opdracht();
        $opdracht->fill($validated);
        $opdracht->save();

        return Redirect::route('opdracht.list');
    }
}
