<?php

namespace App\Factories;

use App\Dtos\FileCreateDto;
use App\Interfaces\DtoFromArrayFactoryInterface;

class FileCreateDtoFactory implements DtoFromArrayFactoryInterface
{
    public static function fromArray(array $data): FileCreateDto
    {
        $dto = new FileCreateDto;

        $dto->folderId = $data['folder_id'];
        $dto->name = $data['name'];
        $dto->content = $data['content'];

        return $dto;
    }
}
