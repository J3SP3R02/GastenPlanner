<?php

namespace App\Http\Controllers;


use App\Exports\GuestlistExport;
use App\Models\Guest;
use App\Models\Guestlist;
use App\Models\UserInfo;
use App\Models\Wedding;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

/**
 * @mixin Builder
 */

class GuestController extends Controller
{
    //Show the guestlist corresponding with the
    public function index (string $unique_code) {

        return view('guestlist.index', [
            'guests' => Guest::where('guestlist_id', app('currentGuestlistId'))->get(),
            'welcome_role' => Guestlist::where('id', app('currentGuestlistId'))->get(),
            'unique_code' => $unique_code
        ]);
    }

    //Show the popup where new guest is created
    public function create () {
        return view('guestlist.create');
    }

    //New guest assigned by the guestlist of the current wedding
    public function store(Request $request) {

        //merges the current wedding's guestlist in the request
        $request->merge([
            'guestlist_id' => app('currentGuestlistId'),
        ]);

        $formField = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => ['required', 'email', Rule::unique('guests', 'email')],
            'phoneNumber' => 'required',
            'guestlist_id' => 'required',
        ], [
            //Email custom error messages
            'email.required' => 'Email is verplicht',
            'email.email' => 'Vul een geldig email account in',
            'email.unique' => 'Er is al een account geregristreerd op deze email'
        ]);

        \App\Models\Guest::create($formField);

        return back();
    }

    public function update (Request $request) {

        $formField = $request->validate([
            'id' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            //TODO: email unique??
            'email' => ['required'],
            'phoneNumber' => 'required',
            'dietary_wishes' => 'nullable',
            'allergies' => 'nullable',
        ]);

        Guest::find($formField['id'])->update($formField);

        return back();
    }

    public function destroy (Request $request) {

        $formField = $request->validate([
            'id' => 'required'
        ]);

        Guest::find($formField['id'])->delete();

        return back();
    }

    public function export () {
        return (new GuestlistExport(app('currentGuestlistId')))->download('gastenlijst.xlsx');
    }

    public function storeWelcome (Request $request) {

        $formField = $request->validate([
           'moment_welcome_1' => 'nullable',
           'moment_welcome_2' => 'nullable',
           'moment_welcome_3' => 'nullable',
           'moment_welcome_4' => 'nullable',
        ]);

        Guestlist::where('id', app('currentGuestlistId'))->update($formField);

        return back();
        //dd();
    }

    public function updateWelcome (Request $request) {

        $formField = $request->input('guests');

        //Checks if at least a single checkbox is checked
        if ($formField != null) {

            foreach ($formField as $guestId => $data) {
                $guest = Guest::find($guestId);
                $guest->moment_welcome_1 = isset($data['moment_welcome_1']);
                $guest->moment_welcome_2 = isset($data['moment_welcome_2']);
                $guest->moment_welcome_3 = isset($data['moment_welcome_3']);
                $guest->moment_welcome_4 = isset($data['moment_welcome_4']);
                $guest->save();
            }

            return back();
        }

        //Sets all fields to false when no checkbox is checked
        else {

            $arr = [
                  'moment_welcome_1' => false,
                  'moment_welcome_2' => false,
                  'moment_welcome_3' => false,
                  'moment_welcome_4' => false,
            ];

            Guest::where('guestlist_id', app('currentGuestlistId'))->update($arr);

            return back();
        }
    }

}

