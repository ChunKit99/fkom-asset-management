<?php

namespace App\Rules;

use App\Models\Maintenances;
use Illuminate\Contracts\Validation\Rule;

class MaintenanceRecordExists implements Rule
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
        $record = Maintenances::where('serial_number', $value)
        ->where('status', '!=', 'completed')
        ->first();

        return !$record;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "Maintenance request for this asset already exists and is not completed.";
    }
}
