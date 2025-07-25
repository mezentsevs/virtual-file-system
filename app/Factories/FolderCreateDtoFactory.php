<?php

namespace App\Factories;

use App\Dtos\FolderCreateDto;
use App\Interfaces\DtoFromArrayFactory;

class FolderCreateDtoFactory implements DtoFromArrayFactory
{
    public static function fromArray(array $data): FolderCreateDto
    {
        $dto = new FolderCreateDto();

        $dto->userId = $data['user_id'];
        $dto->folderId = $data['folder_id'];
        $dto->name = $data['name'];

        return $dto;
    }
}
