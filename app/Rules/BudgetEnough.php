<?php

namespace App\Rules;

use App\Models\Asset;
use Illuminate\Contracts\Validation\Rule;

class BudgetEnough implements Rule
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
        $cost = $value;
        $serial_number = $this->request->get('serial_number');
        $asset = Asset::find($serial_number);
        $budget = $asset->budget;
        if($budget>=$cost)
            return true;
        else
            return false;
    }
    //at controller to deduct budget
    // $validator = Validator::make($request->all(), [
    //     'cost' => [new BudgetEnough($request)],
    // ]);
    
    // if ($validator->fails()) {
    //     return redirect()->back()->withErrors($validator);
    // }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The budget is not enought for this maintenance cost.';
    }
}
