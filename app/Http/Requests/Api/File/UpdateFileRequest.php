<?php

namespace App\Http\Requests\Api\File;

use App\Http\Requests\Api\ApiRequest;
use App\Models\File;
use App\Rules\FileUnique;
use Illuminate\Contracts\Validation\ValidationRule;

class UpdateFileRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route()->parameter('file'));
    }

    /**
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        /**
         * @var File $file
         */
        $file = $this->route('file');

        $rules = [];

        if ($file->name !== $this->input('name')) {
            $rules['name'] = ['required', 'string', 'max:255', 'regex:/^[a-zA-Z0-9\s\p{Pd}_.]+$/', new FileUnique($file->folder)];
        }

        if ($file->content !== $this->input('content')) {
            $rules['content'] = 'nullable|string';
        }

        return $rules;
    }
}
