<?php

namespace App\Factories;

use App\Dtos\FileUpdateDto;
use App\Interfaces\DtoFromArrayFactory;

class FileUpdateDtoFactory implements DtoFromArrayFactory
{
    public static function fromArray(array $data): FileUpdateDto
    {
        $dto = new FileUpdateDto();

        $dto->file = $data['file'];
        $dto->name = $data['name'];
        $dto->content = $data['content'];

        return $dto;
    }
}
