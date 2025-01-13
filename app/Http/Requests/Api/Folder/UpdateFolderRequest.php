<?php

namespace App\Http\Requests\Api\Folder;

use App\Http\Requests\Api\ApiRequest;

class UpdateFolderRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route()->parameter('folder'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
        ];
    }
}
