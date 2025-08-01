<?php

namespace App\Rules;

use App\Models\Folder;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class FolderUnique implements ValidationRule
{
    public function __construct(protected ?Folder $parentFolder)
    {
    }

    /**
     * @param Closure(string, ?string=): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->parentFolder && in_array($value, $this->parentFolder->folders()->pluck('name')->toArray(), true)) {
            $fail('The :attribute must be unique.');
        }
    }
}
