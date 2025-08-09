<?php

namespace App\Http\Requests\Api\Folder;

use App\Http\Requests\Api\ApiRequest;
use App\Models\Folder;
use App\Rules\FolderUnique;
use Illuminate\Contracts\Validation\ValidationRule;

class UpdateFolderRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route()->parameter('folder'));
    }

    /**
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        /**
         * @var Folder $folder
         */
        $folder = $this->route('folder');

        return [
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z0-9\s\p{Pd}_.]+$/', new FolderUnique($folder?->folder)],
        ];
    }
}
