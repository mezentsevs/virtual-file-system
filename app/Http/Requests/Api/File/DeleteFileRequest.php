<?php

namespace App\Http\Requests\Api\File;

use App\Http\Requests\Api\ApiRequest;

class DeleteFileRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('delete', $this->route()->parameter('file'));
    }
}
