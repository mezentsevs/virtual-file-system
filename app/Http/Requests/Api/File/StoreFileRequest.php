<?php

namespace App\Http\Requests\Api\File;

use App\Http\Requests\Api\ApiRequest;
use App\Models\File;
use App\Models\Folder;
use App\Rules\FileUnique;
use Illuminate\Contracts\Validation\ValidationRule;

class StoreFileRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', File::class);
    }

    /**
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $parentFolder = Folder::find($this->request->get('folder_id'));

        return [
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z0-9\s\p{Pd}_.]+$/', new FileUnique($parentFolder)],
            'content' => 'nullable|string|max:10000',
        ];
    }
}
