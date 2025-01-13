<?php

namespace App\Http\Requests\Api\Folder;

use App\Http\Requests\Api\ApiRequest;
use App\Models\Folder;

class IndexFolderRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('view-any', Folder::class);
    }
}
