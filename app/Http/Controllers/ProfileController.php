<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function home()
    {
        /** @var User $user */
        $user = Auth::user();
        return view('pages.home', [
            'visitTimeLines' => $user->visitTimeLines()->count(),
            'links' => $user->links()->count(),
            'clicks' => $user->links()->sum('visits_count'),
            'available_clicks' => $user->available_clicks,
            'time' => 100,
        ]);
    }

    public function show()
    {
        return view('pages.profile', [
            'user' => Auth::user()
        ]);
    }

    public function update(ProfileUpdateRequest $request)
    {
        /** @var User $user */
        $user = User::find(Auth::id());
        $user->is_enabled = $request->has('is_enabled');
        $user->update($request->all(['vns_email', 'vns_password']));
        return redirect()->route('profile.show')->with('status', 'Saved successful!');
    }
}
