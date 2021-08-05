<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $test = Meeting::with('schedule')->get();
        return $test->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('meeting.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Do Server Validation Checks
        $validatedData = $this->validate($request, 
        // Meeting::validationRules(), Meeting::validationMessages());
        [
            'title' => 'required|string',
            'schedule.isRepeat' => 'boolean',
            'schedule.start' => 'required|date|after_or_equal:tomorrow',
            'schedule.duration' => 'required|numeric|min:1',
            'schedule.repDays' => 'nullable|required_if:schedule.isRepeat,true|numeric'
        ]);

        $test = Meeting::conflict($validatedData);

        // Insert the duration with the proper Time to use.        
        if(!is_null($test)){
            return response()->json(
                ['err' => $test]
            );
        } else {
            // Save and return
            // $meeting = Meeting::create($validatedData);  
            $meeting = new Meeting();
            $meeting->title = $validatedData['title'];
            $meeting->save();
            (new ScheduleController)->store($request);
            dd(response());
            return response()->json();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function show(Meeting $meeting)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function edit(Meeting $meeting)
    {
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Meeting $meeting)
    {
        return abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meeting $meeting)
    {
        //
    }
}
