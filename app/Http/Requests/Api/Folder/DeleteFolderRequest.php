<?php

namespace App\Http\Requests\Api\Folder;

use App\Http\Requests\Api\ApiRequest;

class DeleteFolderRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('delete', $this->route()->parameter('folder'));
    }
}
