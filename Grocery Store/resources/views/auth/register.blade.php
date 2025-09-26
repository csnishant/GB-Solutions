<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <x-input-label for="name" :value="__('Name')" />
        <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus />
        <x-input-error :messages="$errors->get('name')" />

        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" type="email" name="email" :value="old('email')" required />
        <x-input-error :messages="$errors->get('email')" />

        <x-input-label for="password" :value="__('Password')" />
        <x-text-input id="password" type="password" name="password" required />
        <x-input-error :messages="$errors->get('password')" />

        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
        <x-text-input id="password_confirmation" type="password" name="password_confirmation" required />
        <x-input-error :messages="$errors->get('password_confirmation')" />

        <x-input-label for="role" :value="__('Register As')" />
        <select id="role" name="role">
            <option value="customer" selected>Customer</option>
            <option value="admin">Admin</option>
        </select>
        <x-input-error :messages="$errors->get('role')" />

        <x-primary-button>{{ __('Register') }}</x-primary-button>
    </form>
</x-guest-layout>
