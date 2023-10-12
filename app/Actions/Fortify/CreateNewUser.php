<?php

namespace App\Actions\Fortify;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'us_fname' => ['required', 'string', 'max:255'],
            'us_lname' => ['required', 'string', 'max:255'],
            'us_email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'us_datebirth' => ['required'],
            'gender_id' => ['required'],
            'career_id' => ['required'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $user = User::create([
            'us_fname' => $input['us_fname'],
            'us_lname' => $input['us_lname'],
            'us_email' => $input['us_email'],
            'password' => Hash::make($input['password']),
            'us_datebirth' => $input['us_datebirth'],
            'gender_id' => $input['gender_id'],
            'career_id' => $input['career_id']
        ]);

        $payment = new Payment();
        $payment->us_id = $user->id;
        $payment->save();

        return $user;
    }
}
