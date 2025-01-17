<?php

namespace App\Listeners;

use App\Events\UserCreatedEvent;
use App\Factories\FolderCreateDtoFactory;
use App\Services\FolderService;

class UserCreatedListener
{
    protected FolderService $folders;

    public function __construct()
    {
        $this->folders = app(FolderService::class);
    }

    public function handle(UserCreatedEvent $event): void
    {
        $this->folders->create(FolderCreateDtoFactory::fromArray([
            'user_id' => $event->user->id,
            'folder_id' => null,
            'name' => 'Root',
        ]));
    }
}
