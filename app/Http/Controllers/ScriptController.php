<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Script;
use DateTime;
use Validator;
use Carbon\Carbon;

class ScriptController extends Controller
{
    public function index () {
        $scripts = Script::all();

        return view('script.index', compact('scripts'));
    }

    /*public function show(Request $request) {
        $scripts = Script::all();
    } */

    public function store(Request $request) {

        $date1 = new DateTime($request->starttime);
        $date2 = new DateTime($request->endtime);
        if (($date1 > $date2)) {
            /*$measurement = $date1->modify('+1 day');
            $interval = $measurement->diff($date2);
            $timespan = $interval->format('%h u %i m'); */
            $timespan = $date1->diff($date2)->format('%h u %i m');
        }
        else {
            $timespan = $date1->diff($date2)->format('%h u %i m');
        }
        $request->request->add(['timespan' => $timespan]);

        $formField  = $request->validate([
            'activity' => 'required',
            'starttime' => 'required',
            'endtime' => 'required',
            'timespan' => 'required',
            'location' => 'required',
            'attendees' => 'required',
        ]);

        Script::query()->create($formField);

        return redirect()->back();
    }

    public function destroy($id)
    {
        $script = Script::where('id', $id)->firstOrFail();

        $script->delete();

        return redirect()->back();
   }
}
