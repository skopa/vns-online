<?php

namespace App\Http\Controllers;

use App\Http\Requests\VisitTimeLineRequest;
use App\User;
use App\VisitTimeLine;
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
            'timetables' => $user->visitTimeLines
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param VisitTimeLineRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(VisitTimeLineRequest $request)
    {
        /** @var User $user */
        $user = Auth::user();
        $user->visitTimeLines()->create($request->all(['from', 'to', 'clicks_per_period']));
        return redirect()->route('visitTimeLines.index');
    }

    /**
     * Display the specified resource.
     *
     * @param VisitTimeLine $visitTimeLine
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(VisitTimeLine $visitTimeLine)
    {
        $this->authorize('view', $visitTimeLine);
        return view('pages.timetable-show', [
            'visitTimeLine' => $visitTimeLine
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param VisitTimeLineRequest $request
     * @param  \App\VisitTimeLine $visitTimeLine
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(VisitTimeLineRequest $request, VisitTimeLine $visitTimeLine)
    {
        $this->authorize('update', $visitTimeLine);
        $visitTimeLine->update($request->all(['from', 'to', 'clicks_per_period']));
        return redirect()->route('visitTimeLines.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VisitTimeLine $visitTimeLine
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(VisitTimeLine $visitTimeLine)
    {
        $this->authorize('delete', $visitTimeLine);
        $visitTimeLine->delete();
        return redirect()->route('visitTimeLines.index');
    }
}
