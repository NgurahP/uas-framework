@php
    $cart = session('cart', []);
    $total = collect($cart)->sum('subtotal');
@endphp

<!-- Overlay -->
<div id="paymentModal" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center z-50">

    <!-- Card -->
    <div class="bg-white w-full max-w-lg rounded-xl shadow-lg p-6 relative">

        <!-- Header -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">Pembayaran</h2>
            <button onclick="closePaymentModal()" class="text-gray-400 hover:text-gray-600">
                ✕
            </button>
        </div>

        <p class="text-sm text-gray-500 mb-4">
            Silakan pilih metode pembayaran dan masukkan jumlah yang dibayarkan
        </p>

        <!-- Total -->
        <div class="bg-blue-50 rounded-lg p-4 mb-4 flex justify-between items-center">
            <span class="text-sm text-gray-600">Total yang harus dibayar:</span>
            <span class="text-xl font-semibold text-blue-600">
                Rp {{ number_format($total, 0, ',', '.') }}
            </span>
        </div>

        <!-- Metode Pembayaran -->
        <div class="mb-4">
            <p class="text-sm font-medium mb-2">Metode pembayaran</p>

            <div class="flex gap-3">
                <button
                    class="flex-1 py-2 border rounded {{ session('metode_pembayaran') === 'cash' ? 'bg-blue-600 text-white border-blue-600' : '' }}">
                    💵 Tunai
                </button>

                <button
                    class="flex-1 py-2 border rounded {{ session('metode_pembayaran') === 'qris' ? 'bg-blue-600 text-white border-blue-600' : '' }}">
                    📱 QRIS
                </button>
            </div>
        </div>

        <form method="POST" action="{{ route('transaksi.bayar') }}">
    @csrf

    <!-- Jumlah Bayar -->
    <div class="mb-6">
        <label class="text-sm font-medium mb-1 block">Jumlah bayar</label>
        <input type="number" name="jumlah_bayar"
            class="w-full border rounded-lg px-4 py-2"
            required>
    </div>

    <div class="flex gap-3">
        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Simpan & Cetak Resi
        </button>

        <button name="cetak" value="0"
            class="bg-gray-600 text-white px-4 py-2 rounded">
            Simpan Tanpa Cetak
        </button>
    </div>
</form>
    </div>
</div>