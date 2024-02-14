<?php

namespace App\Rules\Admin;

use App\Helper\formatData;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class FlileCategoriesRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!empty(pathinfo($value)['extension'])) {
            $exFile = pathinfo($value)['extension'];

            $extensionVideo = formatData::dataVideo();
            $extensionImage = formatData::dataImage();

            if (!in_array($exFile, $extensionVideo) && !in_array($exFile, $extensionImage)) {
                // Xử lý cho video
                $fail("Định dạng file không hợp lệ: " . implode(',', $extensionVideo) . ',' . implode(',', $extensionImage));
            }
        }
    }
}
