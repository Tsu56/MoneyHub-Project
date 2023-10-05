
<x-guest-layout>
       
    <x-authentication-card>
        
        <x-slot name="logo">
        <img src="{{ asset('/img/Logo_MoneyHub.png') }}" class="qr" alt="คำอธิบายรูปภาพ">
        </x-slot>
        
        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif
            
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="login" value="{{ __('Email') }}" />
                <x-input id="login" class="block mt-1 w-full" type="email" name="login" :value="old('login')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
                
                <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 ml-4">
                    Register
                </a>
                <x-button class="ml-4">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
        
    </x-authentication-card>
</x-guest-layout>
