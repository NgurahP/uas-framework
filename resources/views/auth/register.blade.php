<x-guest-layout>
    <!-- Content -->
    <div class="relative w-full max-w-sm text-white text-center">

        <!-- Icon -->
        <div class="flex justify-center mb-8">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.5 6h13 M10 21a1 1 0 100-2 M18 21a1 1 0 100-2" />
            </svg>
        </div>
        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <!-- Nama -->
            <div class="relative">
                <input type="text" name="name" placeholder="Nama" value="{{ old('name') }}" required autofocus
                    class="w-full pl-10 pr-4 py-3 bg-transparent border border-white/60 rounded-md text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-white">
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-200" />

            <!-- Email -->
            <div class="relative">
                <input type="email" name="email" placeholder="E-mail" value="{{ old('email') }}" required autofocus
                    class="w-full pl-10 pr-4 py-3 bg-transparent border border-white/60 rounded-md text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-white">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-200" />

            <!-- Password -->
            <div class="relative">
                <input type="password" name="password" placeholder="Password" required
                    class="w-full pl-10 pr-4 py-3 bg-transparent border border-white/60 rounded-md text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-white">
            </div>

            <div class="relative">
                <x-text-input id="password_confirmation" placeholder="Konfirmasi Password"
                    class="w-full pl-10 pr-4 py-3 bg-transparent border border-white/60 rounded-md text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-white"
                    type="password" name="password_confirmation" required />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Button -->
            <div class="flex justify-center">
                <button type="submit"
                    class="w-48 bg-white text-blue-700 font-semibold py-3 rounded-md hover:bg-gray-100 transition">
                    Daftar
                </button>
            </div>
        </form>

        <!-- Register -->
        <div class="mt-6 text-sm">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="underline font-semibold">
                Masuk
            </a>
        </div>

    </div>
</x-guest-layout>