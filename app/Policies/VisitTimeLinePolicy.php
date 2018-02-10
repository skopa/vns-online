<?php

namespace App\Policies;

use App\User;
use App\VisitTimeLine;
use Illuminate\Auth\Access\HandlesAuthorization;

class VisitTimeLinePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the visitTimeLine.
     *
     * @param  \App\User  $user
     * @param  \App\VisitTimeLine  $visitTimeLine
     * @return mixed
     */
    public function view(User $user, VisitTimeLine $visitTimeLine)
    {
        return $visitTimeLine->user_id == $user->id;
    }

    /**
     * Determine whether the user can create visitTimeLines.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the visitTimeLine.
     *
     * @param  \App\User  $user
     * @param  \App\VisitTimeLine  $visitTimeLine
     * @return mixed
     */
    public function update(User $user, VisitTimeLine $visitTimeLine)
    {
        return $visitTimeLine->user_id == $user->id;
    }

    /**
     * Determine whether the user can delete the visitTimeLine.
     *
     * @param  \App\User  $user
     * @param  \App\VisitTimeLine  $visitTimeLine
     * @return mixed
     */
    public function delete(User $user, VisitTimeLine $visitTimeLine)
    {
        return $visitTimeLine->user_id == $user->id;
    }
}
