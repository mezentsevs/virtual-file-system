<?php

namespace App\Events;

use App\Models\User;

class UserCreatedEvent extends BaseEvent
{
    public function __construct(public User $user) {}
}
