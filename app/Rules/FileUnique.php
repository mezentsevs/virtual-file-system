<?php

namespace App\Rules;

use App\Models\Folder;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class FileUnique implements ValidationRule
{
    public function __construct(protected Folder $parentFolder)
    {
    }

    /**
     * @param Closure(string, ?string=): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (in_array($value, $this->parentFolder->files()->pluck('name')->toArray(), true)) {
            $fail('The :attribute must be unique.');
        }
    }
}
