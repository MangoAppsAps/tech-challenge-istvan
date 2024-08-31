<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * Validates the given phone number against the E.164 format.
 *
 * Because of the challenge says "it can contain a plus sign", I make it optional.
 *
 * @link https://www.twilio.com/docs/glossary/what-e164#regex-matching-for-e164
 */
class PhoneNumber implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (is_null($value)) {
            // Empty values are allowed.
            return true;
        }

        if (!is_string($value)) {
            return false;
        }

        // An optional plus sign followed by a sequence of digits and spaces.
        if (preg_match('/^\+?[\d ]+$/', $value) === 0) {
            return false;
        }

        $numberOfDigits = preg_match_all('/\d/', $value);

        return ($numberOfDigits >= 2 && $numberOfDigits <= 15);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be a valid phone number.';
    }
}
