<?php

namespace App\Factories;

use App\Dtos\FolderUpdateDto;
use App\Interfaces\DtoFromArrayFactory;

class FolderUpdateDtoFactory implements DtoFromArrayFactory
{
    public static function fromArray(array $data): FolderUpdateDto
    {
        $dto = new FolderUpdateDto();

        $dto->folder = $data['folder'];
        $dto->name = $data['name'];

        return $dto;
    }
}
