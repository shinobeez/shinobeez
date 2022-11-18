<?php

namespace App\Actions\Fortify;
use Illuminate\Http\Request;
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
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'firstname' => ['required', 'string', 'max:255'],
            'middlename' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'age' => ['required', 'string', 'max:255'],

            'birthdate' => ['required', 'string', 'max:255'],
            // 'identification' => ['required', 'string', 'max:255'],
            'identificationtype' => ['required', 'string', 'max:255'],
            'contactnumber' => ['required', 'string', 'max:255'],

            'address' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        // $request->file('image')->getClientOriginalName();
        // $request->identification->store('images','public');
        // $imageName = time().'.'.$request->image->extension();  
        // $request->image->move(public_path('images'), $imageName);

        if (request()->hasFile('identification')){
            $identification = request()->file('identification')->getClientOriginalName();
            $identificationName = request()->file('identification')->store('images','public');
            // $file = request->file('identification');
            // $extention = $file->getClientOriginalExtension();
            // $filename = time().'.'.$extention;
            // $file->

        }

        // $request->file('identification')->getClientOriginalName();

        return User::create([
            'firstname' => $input['firstname'],
            'middlename' => $input['middlename'],
            'lastname' => $input['lastname'],
            'gender' => $input['gender'],
            'lastname' => $input['lastname'],
            'age' => $input['age'],
            'birthdate' => $input['birthdate'],
            'contactnumber' => $input['contactnumber'],
            'identification' => $identificationName,
         'identificationtype' => $input['identificationtype'],
            'address' => $input['address'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
