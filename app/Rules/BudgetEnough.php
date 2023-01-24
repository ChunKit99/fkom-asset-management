<?php

namespace App\Rules;

use App\Models\Asset;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Psy\Readline\Hoa\Console;

class BudgetEnough implements Rule
{
    private $request;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    
    public function __construct(Request $request)
    {
        $this->request = $request;
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
        $budget = Asset::where('serial_number', $serial_number)->value('budget');
        //not found serial number(should not happend)
        if($budget == null) {
            return false;
        }
        //not enough
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
