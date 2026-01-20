<x-app-layout>

    <div class="p-6 space-y-6">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-xl font-semibold">Manajemen User</h2>
                <p class="text-sm text-gray-500">Lumpia Beef Twins</p>
            </div>

            <div class="text-sm text-gray-600 text-right">
                <p>Waktu</p>
                <p class="font-semibold">{{ now()->format('d/m/Y H:i:s') }}</p>
            </div>
        </div>

        <!-- ACTION BAR -->
        <div class="flex justify-end items-center">

            <!-- Search -->
            <form method="GET" action="{{ route('user.index') }}" class="relative">
                <input type="text" name="search" placeholder="Cari nama user..." value="{{ request('search') }}"
                    class="pl-10 pr-4 py-2 border rounded-lg text-sm focus:ring focus:ring-blue-200">
                <span class="absolute left-3 top-2.5 text-gray-400 text-sm">
                    🔍
                </span>
            </form>

        </div>

        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- TABLE PRODUK -->
        <div class="bg-white rounded shadow">
            <table class="w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left">Nama User</th>
                        <th class="px-4 py-3">E-mail</th>
                        <th class="px-4 py-3">Level</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach ($users as $user)
                        <tr>
                            <td class="px-4 py-3">{{ $user->name }}</td>
                            <td class="px-4 py-3 text-center">{{ $user->email }}</td>
                            <td class="px-4 py-3 text-center">{{ $user->level }}</td>
                            <td class="px-4 py-3 text-center">{{ $user->status }}</td>
                            <td class="px-4 py-3 text-center space-x-2">
                                <a href="{{ route('user.edit', $user->id) }}"
                                    class="px-3 py-1 bg-yellow-400 rounded text-xs">Edit</a>
                                <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded text-xs">
                                        Hapus
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>