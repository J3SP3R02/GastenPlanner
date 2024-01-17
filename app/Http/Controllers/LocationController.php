<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index () {

        return view('location.index', [
            'locations' => Location::where('wedding_id', app('currentWeddingId'))->get(),
        ]);

    }

    public function store(Request $request) {

        $request->merge([
            'wedding_id' => app('currentWeddingId'),
        ]);

        $formField = $request->validate([
            'address_address' => 'required',
            'address_longitude' => 'required',
            'address_latitude' => 'required',
            'wedding_id' => 'required'
        ]);

        Location::create($formField);

        return back();
    }

}
