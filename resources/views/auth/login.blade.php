<x-guest-layout>
    <div class="container mt-5">
        <h2 class="text-center font-bold text-white">{{ __('เข้าสู่ระบบ') }}</h2>
        @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold text-white">Error!</strong>
            @foreach ($errors->all() as $error)
            <span class="block sm:inline text-white">{{ $error }}</span>
            @endforeach
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <x-input-label for="username" :value="__('ชื่อผู้ใช้')" class="text-gray-700 font-semibold" />
                <x-text-input id="username" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200" type="text" name="username" required autofocus autocomplete="username" />
            </div>

            <div class="mb-4">
                <x-input-label for="password" :value="__('รหัสผ่าน')" class="text-gray-700 font-semibold" />
                <x-text-input id="password" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button>
                    {{ __('เข้าสู่ระบบ') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
