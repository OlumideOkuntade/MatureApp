<?php

namespace App\Listeners;

use App\Events\ResetUserPassword;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SetPasswordToLastName
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\ResetUserPassword  $event
     * @return void
     */
    //the $event has the data from the event
    public function handle(ResetUserPassword $event)
    {
        $user = $event->user;
        $user->update([
            'password' => bcrypt($user->customer->last_name),
            'verified_at'=> 'null'
        ]);
    }
}
