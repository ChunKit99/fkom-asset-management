<?php

namespace App\Rules;

use App\Models\Asset;
use Illuminate\Contracts\Validation\Rule;

class UniqueSerialNumber implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $serial_number = $value;
        $asset = Asset::where('serial_number', $serial_number)->first();
        return !$asset;
}

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This serial number already exists';
    }
}
