<?php

namespace App\Listeners;

use App\Events\UserCreatedEvent;
use App\Factories\FolderCreateDtoFactory;
use App\Services\FolderService;

class UserCreatedListener
{
    public function __construct(protected FolderService $folders) {}

    public function handle(UserCreatedEvent $event): void
    {
        $this->folders->create(FolderCreateDtoFactory::fromArray([
            'user_id' => $event->user->id,
            'folder_id' => null,
            'name' => 'Root',
        ]));
    }
}
