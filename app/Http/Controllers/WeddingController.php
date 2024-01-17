<?php

namespace App\Http\Controllers;

use App\Models\Guestlist;
use App\Models\Wedding;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Supports\Payment;

/**
 * Post
 *
 * @mixin Builder
 * @mixin Model
 */

class WeddingController extends Controller
{
    use Payment;

    //Shows the homepage of the application
    public function index () {
        return view('homepage.index');
    }

    //Stores a new wedding to the database
    public function store () {

        $userId = Auth::id();

        $random = Str::random(8);

        //Makes a wedding if the unique_code doesn't already exist
        if (!Wedding::query()->where('unique_code', $random)->exists()) {

            //create a new guestlist that is linked to the wedding
            $guestlist = Guestlist::query()->create();

            $formField = [
                'user_id' => $userId,
                'unique_code' => $random,
                'title' => "",
                'date' => "",
                'guestlist_id' => $guestlist->id,
            ];

            Wedding::query()->create($formField);
        }

        //TODO: rerun random if code already exists
        //TODO: css is fucked when there are no guests

        //Get the last made wedding / that is the wedding the user just made
        $wedding = Wedding::query()->findOrFail(\DB::getPdo()->lastInsertId());

        return redirect('/bruiloft/'.$wedding->getAttribute('unique_code').'/gastenlijst');
    }

    public function store_pay(Request $request)
    {

        $request->validate([
            'title' => ['required'],
            'description' => ['required'],
        ]);

        $userId = Auth::id();

        $random = Str::random(8);

        $request->only('title', 'description');

        //Makes a wedding if the unique_code doesn't already exist
        if (!Wedding::query()->where('unique_code', $random)->exists()) {

            //create a new guestlist that is linked to the wedding
            $guestlist = Guestlist::query()->create();

            $formField = [
                'user_id' => $userId,
                'unique_code' => $random,
                'guestlist_id' => $guestlist->id,
                'title' => $request->title,
                'date' => "",
                'description' => $request->description,
            ];

            Wedding::query()->create($formField);
        }

        //TODO: rerun random if code already exists
        //TODO: css is fucked when there are no guests

        //Get the last made wedding / that is the wedding the user just made
        $wedding = Wedding::query()->findOrFail(\DB::getPdo()->lastInsertId());

        $description = $request->description;

        //return redirect('/bruiloft/'.$wedding->getAttribute('unique_code').'/gastenlijst');

        return self::createPayment($wedding, $description);
    }

    public function destroy (Request $request) {

        $formField = $request->validate([
            'id' => 'required'
        ]);

        Wedding::find($formField['id'])->delete();

        return back();
    }
}




