<x-app-layout>
    <div class="p-6">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-xl font-semibold">Kasir</h2>
                <p class="text-sm text-gray-500">Lumpia Beef Twins</p>
            </div>

            <div class="text-sm text-gray-600 text-right">
                <p>Waktu</p>
                <p class="font-semibold">{{ now()->format('d/m/Y H:i:s') }}</p>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-6">

            <!-- ================= PRODUK ================= -->
            <div class="col-span-8">

                <!-- Search -->
                <form method="GET" action="{{ route('transaksi.index') }}" class="mb-4">
                    @if (request('kategori'))
                        <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                    @endif

                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk"
                        class="w-full px-4 py-2 rounded border">
                </form>

                <!-- Kategori -->
                <div class="flex gap-2 mb-4 flex-wrap">
                    <a href="{{ route('transaksi.index') }}"
                        class="px-3 py-1 rounded text-sm {{ request('kategori') ? 'bg-gray-200' : 'bg-blue-600 text-white' }}">
                        Semua
                    </a>

                    @foreach ($kategoris as $kategori)
                        <a href="{{ route('transaksi.index', ['kategori' => $kategori->id]) }}"
                            class="px-3 py-1 rounded text-sm {{ request('kategori') == $kategori->id ? 'bg-blue-600 text-white' : 'bg-gray-200' }}">
                            {{ $kategori->nama_kategori }}
                        </a>
                    @endforeach
                </div>

                <!-- List Produk -->
                <div class="grid grid-cols-3 gap-4">
                    @foreach ($products as $product)
                        <div class="bg-white p-4 rounded shadow-sm">
                            <h3 class="font-medium text-sm">
                                {{ $product->nama_produk }}
                            </h3>

                            <p class="text-blue-600 font-semibold mt-2">
                                Rp {{ number_format($product->harga, 0, ',', '.') }}
                            </p>

                            <form method="POST" action="{{ route('cart.add', $product->id) }}">
                                @csrf
                                <button type="submit"
                                    class="mt-3 w-full bg-blue-600 text-white rounded py-1 hover:bg-blue-700">
                                    +
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>

                @if ($products->isEmpty())
                    <div class="text-center text-gray-500 mt-4">
                        Produk tidak ditemukan
                    </div>
                @endif
            </div>

            <!-- ================= RINGKASAN ================= -->
            <div class="col-span-4">
                <div class="bg-white p-4 rounded shadow-sm">
                    <h3 class="font-semibold mb-4">Ringkasan Pembayaran</h3>

                    @php
                        $cart = session('cart', []);
                    @endphp

                    @if (empty($cart))
                        <div class="text-center text-gray-400 py-10 border rounded mb-4">
                            🛒 Keranjang masih kosong
                        </div>
                    @else
                        <div class="space-y-3 mb-4">
                            @foreach ($cart as $id => $item)
                                <div class="flex justify-between items-center text-sm border-b pb-2">
                                    <div>
                                        <p class="font-medium">{{ $item['nama'] }}</p>

                                        <p class="text-gray-500">
                                            {{ $item['qty'] }} x Rp {{ number_format($item['harga'], 0, ',', '.') }}
                                        </p>

                                        <!-- Tombol Qty -->
                                        <div class="flex gap-2 mt-1">
                                            <!-- Kurangi -->
                                            <form method="POST" action="{{ route('cart.decrease', $id) }}">
                                                @csrf
                                                <button type="submit" class="px-2 bg-red-500 text-white rounded text-xs">
                                                    −
                                                </button>
                                            </form>

                                            <!-- Tambah -->
                                            <form method="POST" action="{{ route('cart.add', $id) }}">
                                                @csrf
                                                <button type="submit" class="px-2 bg-blue-600 text-white rounded text-xs">
                                                    +
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                    <span class="font-semibold">
                                        Rp {{ number_format($item['subtotal'], 0, ',', '.') }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- Total -->
                    @php
                        $total = collect($cart)->sum('subtotal');
                    @endphp

                    <div class="flex justify-between font-semibold text-blue-600 text-sm mb-4">
                        <span>Total pembayaran</span>
                        <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <!-- Metode Pembayaran -->
                    @php
                        $metode = session('metode_pembayaran');
                    @endphp

                    <div class="mt-4">
                        <p class="text-sm mb-2">Metode pembayaran:</p>

                        <div class="flex gap-2">
                            <form method="POST" action="{{ route('cart.setPaymentMethod') }}" class="w-full">
                                @csrf
                                <input type="hidden" name="metode_pembayaran" value="cash">
                                <button
                                    class="flex-1 w-full border rounded py-2 text-sm {{ $metode === 'cash' ? 'bg-blue-600 text-white' : '' }}">
                                    💵 Tunai
                                </button>
                            </form>
                            <form method="POST" action="{{ route('cart.setPaymentMethod') }}" class="w-full">
                                @csrf
                                <input type="hidden" name="metode_pembayaran" value="qris">
                                <button
                                    class="flex-1 w-full border rounded py-2 text-sm {{ $metode === 'qris' ? 'bg-blue-600 text-white' : '' }}">
                                    📱 QRIS
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Action -->
                    @php
                        $cart = session('cart', []);
                        $paymentMethod = session('metode_pembayaran');
                        $canPay = !empty($cart) && $paymentMethod;
                    @endphp
                    <button {{ $canPay ? 'onclick=openPaymentModal()' : 'disabled' }}
                        class="mt-4 w-full py-2 rounded {{ $canPay ? 'bg-blue-600 text-white hover:bg-blue-700' : 'bg-gray-300 text-gray-500 cursor-not-allowed' }}">
                        Bayar
                    </button>


                    <form method="POST" action="{{ route('cart.clear') }}">
                        @csrf
                        <button class="mt-2 w-full border py-2 rounded text-sm text-gray-600">
                            🗑 Hapus keranjang
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
    @include('transaksi._payment-modal')
    @if (session('success_transaksi'))
        @include('transaksi.modal-success', session('success_transaksi'))
    @endif
    <script>
        function openPaymentModal() {
            document.getElementById('paymentModal').classList.remove('hidden');
            document.getElementById('paymentModal').classList.add('flex');
        }

        function closePaymentModal() {
            document.getElementById('paymentModal').classList.add('hidden');
            document.getElementById('paymentModal').classList.remove('flex');
        }
    </script>

</x-app-layout>