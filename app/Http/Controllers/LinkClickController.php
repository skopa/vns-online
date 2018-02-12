<?php

namespace App\Http\Controllers;

use App\LinkClick;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LinkClickController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        /** @var User $user */
        $user = Auth::user();
        return view('pages.link-clicks', [
            'clicks' => LinkClick::whereIn('link_id', $user->links->pluck('id')),
            'events' => $user->logs,
        ]);
    }
}
