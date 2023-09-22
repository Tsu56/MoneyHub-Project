<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="mt-4"> 
                    <x-label for="us_fname" value="{{ __('First name') }}" />
                    <x-input id="us_fname" class="block mt-1 w-full" type="text" name="us_fname" :value="old('us_fname')" required autofocus autocomplete="us_fname" />
                </div>
                
                <div class="mt-4">
                    <x-label for="us_lname" value="{{ __('Last name') }}" />
                    <x-input id="us_lname" class="block mt-1 w-full" type="text" name="us_lname" :value="old('us_lname')" required autocomplete="us_lname" />
                </div>
                
                <div class="mt-4">
                    <x-label for="us_email" value="{{ __('Email') }}" />
                    <x-input id="us_email" class="block mt-1 w-full" type="email" name="us_email" :value="old('us_email')" required />
                </div>
                
                <div class="mt-4">
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                </div>
                
                <div class="mt-4">
                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>

                <div class="mt-4">
                    <x-label for="us_datebirth" value="{{ __('Birthday') }}" />
                    <x-input id="us_datebirth" class="block mt-1 w-full" type="date" name="us_datebirth" :value="old('us_datebirth')" required />
                </div>
                
                <div class="mt-4">
                    <x-label for="gender_id" value="{{ __('Male') }}" />
                    <x-input id="gender_id" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" type="radio" name="gender_id" value=1 required />
                </div>
                
                <div class="mt-4">
                    <x-label for="gender_id" value="{{ __('Female') }}" />
                    <x-input id="gender_id" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" type="radio" name="gender_id" value=2 required />
                </div>

                <div class="mt-4">
                    <x-label for="career_id" value="{{ __('Career') }}" />
                    <select id="career_id" name="career_id" autocomplete="career-id" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                        <option value=1>Students</option>
                        <option value=2>Bussiness Owner</option>
                    </select>
                </div>
            </div>
                
            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
                <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 ml-4">
                    Login
                </a>
                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
