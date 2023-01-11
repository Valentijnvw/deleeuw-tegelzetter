<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Casdr\Moneybird\MoneybirdFacade as Moneybird;

use Picqer\Financials\Moneybird\Entities\Contact;
use Picqer\Financials\Moneybird\Entities\ContactPeople;

class MoneybirdController extends Controller
{
    public function userSearch(Request $request) {
        $query = $request->query('q');
        $contacts = Moneybird::contact()->search($query);
        // dd($contacts);
        $contactList = collect($contacts)->map(function(Contact $contact) {
    
            $contactPeople = collect($contact->contact_people)->map(function(ContactPeople $contact) {
                return [
                    "first_name" => $contact->firstname,
                    "last_name" => $contact->lastname,
                ];
            });
            $contactPerson = null;
            if(count($contactPeople) > 0) {
                $contactPerson = $contactPeople[0];
            }
            return [
                "moneybird_id" => $contact->id,
                "first_name" => $contact->firstname,
                "last_name" => $contact->lastname,
                "company_name" => $contact->company_name,
                "email" => $contact->email,
                "phone" => $contact->phone,
                "city" => $contact->city,
                "contact_person" => $contactPerson,
            ];
        });
        // dd($contactList);
        return [
            "items" => $contactList,
        ];
    }
}
