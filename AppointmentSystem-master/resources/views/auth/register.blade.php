<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
</head>
<style>
.first-row{

}
.col{
    margin-bottom: 10px;
}

.second-row{

}
.reg-textlogo{
    font-size: 24px;
    text-align: center;
}
</style>
<body>
<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
            <div class="reg-textlogo">
               </div>
               <div class="text-center d-block mt-3">
            
                <h5> Dapitan Health Center</h5>
                
            </div> 
        </x-slot> 
    <x-jet-validation-errors class="mb-4" />
        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf
        <div class="container">
          <div class="row">
            <div class="col col-4 first-row">
                <x-jet-label for="firstname" value="{{ __('First Name') }}" />
                <x-jet-input id="firstname" class="block mt-1 w-full" type="text" name="firstname" :value="old('firstname')" required autofocus autocomplete="firstname" />
            </div>
                <div class="col-4 col">
                <x-jet-label for="middlename" value="{{ __('Middle Name') }}" />
                <x-jet-input id="middlename" class="block mt-1 w-full" type="text" name="middlename" :value="old('middlename')" required autofocus autocomplete="middlename" />
               </div>
                <div class="col-4 col">
                <x-jet-label for="lastname" value="{{ __('Last Name') }}" />
                <x-jet-input id="lastname" class="block mt-1 w-full" type="text" name="lastname" :value="old('lastname')" required autofocus autocomplete="lastname" />
                </div>
            </div>
          
        <div class="row">
            <div class="col col-lg-4 second-row">
                <x-jet-label for="age" value="{{ __('Age') }}" />
                <x-jet-input id="age" class="block mt-1 w-full" type="text" name="age" :value="old('age')" required autofocus autocomplete="age" />
            </div>
            <div class="col col-lg-4">
                <x-jet-label for="gender" value="{{ __('Gender') }}" />
                <select name="gender" id="gender" class ="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <div class="col col-lg-4">
                <x-jet-label for="birthdate" value="{{ __('Birthdate') }}" />

                <input type="date" id="birthdate" name="birthdate" :value="old('birthdate')" required autofocus autocomplete="birthdate" class ="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
            </div>
                <!-- <x-jet-input id="birthdate" class="block mt-1 w-full" type="text" name="birthdate" :value="old('birthdate')" required autofocus autocomplete="birthdate" /> -->
            </div>

            <div class="row">
            <div class="col col-5">
                <x-jet-label for="contactnumber" value="{{ __('Contact Number') }}" />
                <x-jet-input id="contactnumber" class="block mt-1 w-full" type="text" name="contactnumber" :value="old('contactnumber')" required autofocus autocomplete="contactnumber" />
            </div>
            <div class="col">
                <x-jet-label for="address" value="{{ __('Address') }}" />
                <x-jet-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required autofocus autocomplete="address" />
            </div>
        </div>

            <div class="col">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>
            <div class="row">
            <div class="col">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>
        </div>
            <div class="row">
            <div class="col">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>
        </div>
            <div class="row">
            <div class="col">
                <x-jet-label for="identificationtype" value="{{ __('Identification Type') }}" />
    
                <x-jet-input id="identificationtype" class="block mt-1 w-full" type="text" name="identificationtype" :value="old('identificationtype')" required autofocus autocomplete="identificationtype" />
            </div>
            <div class="row">
                <div class="col mt-2">
                <input type="file" id="identification" name="identification" class="">

                </div>
                {{-- <x-jet-label for="identification" value="{{ __('Identification') }}" />
                <!-- <x-jet-input id="identification" class="block mt-1 w-full" type="text" name="identification" :value="old('identification')" required /> --> --}}
            </div>
        </div>
 

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
</body>
</html>