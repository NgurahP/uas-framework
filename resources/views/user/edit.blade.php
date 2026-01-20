<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow">

                <form action="{{ route('user.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Status User -->
                    <div class="mb-4">
                        <label class="block mb-1 font-semibold">Status User</label>
                        <select name="status" class="w-full border rounded px-3 py-2" required>
                            <option value="aktif" {{ old('status', $user->status) == 'aktif' ? 'selected' : '' }}>
                                Aktif
                            </option>
                            <option value="non-aktif" {{ old('status', $user->status) == 'non-aktif' ? 'selected' : '' }}>
                                Nonaktif
                            </option>
                        </select>

                        @error('status')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tombol -->
                    <div class="flex justify-end">
                        <a href="{{ route('user.index') }}" class="mr-2 px-4 py-2 bg-gray-500 text-white rounded">
                            Batal
                        </a>

                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                            Simpan
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>