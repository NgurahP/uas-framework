@php
    $role = auth()->user()->level;
@endphp

<aside class="w-64 min-h-screen bg-white border-r flex flex-col justify-between">

    <!-- Logo -->
    <div>
        <div class="p-4 flex items-center gap-2 border-b">
            <div class="w-10 h-10 bg-blue-600 text-white rounded flex items-center justify-center">
                🛒
            </div>
            <div>
                <h1 class="font-semibold text-gray-800">Pos System</h1>
                <p class="text-xs text-gray-500">Sistem kasir</p>
            </div>
        </div>

        <!-- Menu -->
        <nav class="p-4 space-y-2">

            @if ($role === 'admin')
                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700 font-medium' : 'text-gray-600 hover:bg-gray-100' }}">
                    📊 Dashboard
                </a>

                <a href="{{ route('laporan.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded {{ request()->routeIs('laporan.*') ? 'bg-blue-50 text-blue-700 font-medium' : 'text-gray-600 hover:bg-gray-100' }}">
                    📊 Laporan
                </a>

                <a href="{{ route('produk.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded {{ request()->routeIs('produk.*') ? 'bg-blue-50 text-blue-700 font-medium' : 'text-gray-600 hover:bg-gray-100' }}">
                    📦 Manajemen Produk
                </a>

                <a href="{{ route('kategori.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded {{ request()->routeIs('kategori.*') ? 'bg-blue-50 text-blue-700 font-medium' : 'text-gray-600 hover:bg-gray-100' }}">
                    🗂 Manajemen Kategori
                </a>

                <a href="{{ route('user.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded {{ request()->routeIs('users.*') ? 'bg-blue-50 text-blue-700 font-medium' : 'text-gray-600 hover:bg-gray-100' }}">
                    👥 Manajemen User
                </a>
            @endif

            <!-- KASIR -->
            <a href="{{ route('transaksi.index') }}"
                class="flex items-center gap-3 px-3 py-2 rounded {{ request()->routeIs('transaksi.index') ? 'bg-blue-50 text-blue-700 font-medium' : 'text-gray-600 hover:bg-gray-100' }}">
                🧾 Kasir
            </a>

            <!-- RIWAYAT -->
            <a href="{{ route('transaksi.riwayat') }}"
                class="flex items-center gap-3 px-3 py-2 rounded {{ request()->routeIs('transaksi.riwayat') ? 'bg-blue-50 text-blue-700 font-medium' : 'text-gray-600 hover:bg-gray-100' }}">
                📜 Riwayat Transaksi
            </a>

        </nav>
    </div>

    <!-- Logout -->
    <div class="p-4 border-t">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="w-full flex items-center gap-2 text-red-600 hover:bg-red-50 px-3 py-2 rounded">
                ⏻ Keluar
            </button>
        </form>
    </div>
</aside>