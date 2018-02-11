<?php

namespace App\Http\Controllers;

use App\Http\Requests\LinkRequest;
use App\Link;
use App\User;
use App\VisitTimeLine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LinkController extends Controller
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
        return view('pages.link', [
            'links' => $user->links,
            'visitTimeLines' => $user->visitTimeLines
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param LinkRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(LinkRequest $request)
    {
        /** @var VisitTimeLine $visitTimeLine */
        $visitTimeLine = VisitTimeLine::find($request->get('visit_time_line_id'));
        $this->authorize('view', $visitTimeLine);
        /** @var Link $link */
        $link = $visitTimeLine->links()->create($request->all('link', 'comment'));
        $link->is_enabled = $request->has('is_enabled');
        $link->save();
        return redirect()->route('links.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Link $link
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Link $link)
    {
        /** @var User $user */
        $user = Auth::user();
        $this->authorize('view', $link);
        return view('pages.link-show', [
            'link' => $link,
            'visitTimeLines' => $user->visitTimeLines
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param LinkRequest $request
     * @param  \App\Link $link
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(LinkRequest $request, Link $link)
    {
        $visitTimeLine = VisitTimeLine::find($request->get('visit_time_line_id'));
        $this->authorize('view', $visitTimeLine);
        /** @var Link $link */
        $link->update($request->all('link', 'comment', 'visit_time_line_id'));
        $link->is_enabled = $request->has('is_enabled');
        $link->save();
        return redirect()->route('links.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Link $link
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     */
    public function destroy(Link $link)
    {
        $this->authorize('delete', $link);
        $link->delete();
        return redirect()->route('links.index');
    }

    /**
     * @param $request
     */
    public function preview($request)
    {

    }
}
