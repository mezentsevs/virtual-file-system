<?php

namespace App\Listeners;

use App\Events\UserCreatedEvent;

class UserCreatedListener
{
    public function __construct()
    {
        //
    }

    public function handle(UserCreatedEvent $event): void
    {
        //
    }
}
