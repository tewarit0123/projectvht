<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- ชื่อ -->
        <div>
            <x-input-label for="name" :value="__('ชื่อ')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        
        <div class="mt-4">
            <x-input-label for="username" :value="__('ชื่อผู้ใช้')" />
            <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- รหัสผ่าน -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('รหัสผ่าน')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- ยืนยันรหัสผ่าน -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('ยืนยันรหัสผ่าน')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('กลับไปหน้าเข้าสู่ระบบ?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('ลงทะเบียน') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
