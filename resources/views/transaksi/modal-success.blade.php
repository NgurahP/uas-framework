<div class="fixed inset-0 bg-black/40 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg w-[420px] p-6 relative">

        <h2 class="text-center font-semibold text-lg mb-4">
            Pembayaran Berhasil
        </h2>

        <div class="flex justify-center mb-4">
            <div class="w-20 h-20 bg-green-600 rounded-full flex items-center justify-center">
                ✅
            </div>
        </div>

        <div class="space-y-3 text-sm">
            <div>
                <label>Total Belanja</label>
                <input class="w-full border rounded px-3 py-2" value="Rp {{ number_format($total, 0, ',', '.') }}"
                    disabled>
            </div>

            <div>
                <label>Jumlah Bayar</label>
                <input class="w-full border rounded px-3 py-2" value="Rp {{ number_format($bayar, 0, ',', '.') }}"
                    disabled>
            </div>

            <div>
                <label>Kembalian</label>
                <input class="w-full border rounded px-3 py-2 text-green-600 font-semibold"
                    value="Rp {{ number_format($kembalian, 0, ',', '.') }}" disabled>
            </div>
        </div>

        <div class="flex gap-2 mt-6">
            <a href="{{ route('transaksi.index') }}" class="flex-1 bg-blue-600 text-white py-2 rounded text-center">
                Transaksi Baru
            </a>

            <a href="{{ route('dashboard') }}" class="flex-1 border py-2 rounded text-center">
                Dashboard
            </a>
        </div>
    </div>
</div>