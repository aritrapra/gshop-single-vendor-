<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;
class captcha implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($value,$name)
    {
        $this->value = $value;
        $this->name = $name;
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
        $c_cap = $this->value;
        $hash_value = hash('sha256',$value."M_sad");
        if($hash_value == $c_cap){
            $myuser = $this->name;
            $userdata = User::where(DB::raw('BINARY `name`'), $myuser)->first(['security']);
            if($userdata == null){
                return 1;
            }
            else if($userdata->security != $c_cap){
                User::where(DB::raw('BINARY `name`'), $myuser)->update([
                    'security' => $c_cap
                ]);
                return 1;
            }else{
                return 0;
            }

        }else{
            return 0;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Incorrect Captcha';
    }
}
