<?php

namespace App\Http\Controllers;

use App\User;
use App\VisitTimeLine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitTimeLineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();
        return view('pages.timetable', [
            'timetable' => $user->visitTimeLines
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VisitTimeLine  $visitTimeLine
     * @return \Illuminate\Http\Response
     */
    public function show(VisitTimeLine $visitTimeLine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VisitTimeLine  $visitTimeLine
     * @return \Illuminate\Http\Response
     */
    public function edit(VisitTimeLine $visitTimeLine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VisitTimeLine  $visitTimeLine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VisitTimeLine $visitTimeLine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VisitTimeLine  $visitTimeLine
     * @return \Illuminate\Http\Response
     */
    public function destroy(VisitTimeLine $visitTimeLine)
    {
        //
    }
}
