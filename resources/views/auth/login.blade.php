<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
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
                <x-label for="name" value="{{ __('User') }}" />
                <div class="flex">
                    <input id="name" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                        type="text" name="name" :value="old('name')" required autofocus autocomplete="username" />
                    <span class="inline-flex mt-1 items-center ps-3 text-sm text-gray-900 rounded-md">
                        <div class="w-4 block" style="cursor: default">
                            <i class="fa-solid fa-user"></i>
                        </div>
                    </span>
                </div>
            </div>

            <div class="mt-4" x-data="{ show: false }">
                <x-label for="password" value="{{ __('Password') }}" />
                <div class="flex">
                    <input id="password" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                        :type="show ? 'text' : 'password'" name="password" required autocomplete="current-password" />
                    <span class="inline-flex mt-1 items-center ps-3 text-sm text-gray-900 rounded-md">
                        <div type="button" @click="show = !show" :class="{ 'w-4 hidden': !show, 'w-4 block': show }">
                            <i class="fa-solid fa-eye"></i>
                        </div>
                        <div type="button" @click="show = !show" :class="{ 'w-4 hidden': show, 'w-4 block': !show }">
                            <i class="fa-solid fa-eye-slash"></i>
                        </div>
                    </span>
                </div>
            </div>

            @if (Route::has('password.request'))
                <div class="mt-4 mb-4 flex items-center justify-between">
                    <label class="flex items-center">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    </label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="underline text-sm text-green-600">
                        {{ __('Register') }}
                    </a>
                @endif

                <x-button class="ms-4">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
