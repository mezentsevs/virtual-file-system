<?php

namespace App\Http\Requests\Api\Folder;

use App\Http\Requests\Api\ApiRequest;
use App\Models\Folder;
use App\Rules\FolderUnique;
use Illuminate\Contracts\Validation\ValidationRule;

class StoreFolderRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', Folder::class);
    }

    /**
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $parentFolder = Folder::find($this->request->get('folder_id'));

        return [
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z0-9\s\p{Pd}_.]+$/', new FolderUnique($parentFolder)],
        ];
    }
}
