<?php

namespace App\Listeners;

use App\Events\RegisterdUser;
use App\Mail\SendMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendMailVerification
{

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(RegisterdUser $event)
    {
//        Log::info($event->message);
        Mail::to("jahani.m180@gmail.com")->send(new SendMail($event->message));
    }
}
