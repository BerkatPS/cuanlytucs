@extends('dashboard.layout')

@section('title', 'Overview')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <!-- Ringkasan Akun -->
        <div class="bg-gradient-to-r from-teal-500 to-cyan-600 text-white p-6 rounded-lg shadow-lg">
            <h3 class="text-2xl font-semibold mb-4">Ringkasan Akun</h3>
            @foreach($accounts as $account)
                <div class="flex justify-between items-center border-b border-white/50 py-3">
                    <span class="text-lg font-medium">{{ $account->name }}</span>
                    <span class="text-xl font-semibold">{{ $account->currency }} {{ number_format($account->balance, 2) }}</span>
                </div>
            @endforeach
            @if($accounts->isEmpty())
                <p class="text-center mt-4 text-white/70">Belum ada akun terdaftar.</p>
            @endif
        </div>

        <!-- Kategori Transaksi -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-2xl font-semibold text-teal-600 mb-4">Kategori Transaksi</h3>
            <div class="space-y-4">
                @foreach($categories as $category)
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-medium">{{ $category->name }}</span>
                        <span class="text-sm text-gray-500">Kategori</span>
                    </div>
                @endforeach
                @if($categories->isEmpty())
                    <p class="text-center mt-4 text-gray-500">Belum ada kategori terdaftar.</p>
                @endif
            </div>
        </div>

        <!-- Riwayat Transaksi -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-2xl font-semibold text-teal-600 mb-4">Riwayat Transaksi</h3>
            <div class="space-y-4">
                @foreach($transactions as $transaction)
                    <div class="flex justify-between items-center border-b border-gray-200 py-3">
                        <div>
                            <span class="block text-lg font-medium">{{ $transaction->description }}</span>
                            <span class="text-sm text-gray-500">
                                {{ $transaction->type == 0 ? 'Pengeluaran' : 'Pemasukan' }} | {{ $transaction->category->name }}
                            </span>
                        </div>
                        <span class="{{ $transaction->type == 0 ? 'text-red-500' : 'text-green-500' }} text-lg font-semibold">
                            {{ number_format($transaction->amount, 2) }} {{ $transaction->account->currency }}
                        </span>
                    </div>
                @endforeach
                @if($transactions->isEmpty())
                    <p class="text-center mt-4 text-gray-500">Belum ada transaksi tercatat.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Statistik dan Grafik Anggaran -->
    <div class="bg-white p-6 rounded-lg shadow-lg mt-6">
        <h3 class="text-2xl font-semibold text-teal-600 mb-4">Anggaran / Budgeting</h3>
        @foreach($budgets as $budget)
            <div class="mb-4">
                <!-- Nama Kategori -->
                <div class="flex justify-between items-center mb-2">
                    <span class="text-lg font-medium">{{ $budget->category->name }}</span>
                    <span class="text-sm text-gray-500">
                    {{ number_format($budget->totalSpent(), 2) }} / {{ number_format($budget->limit_amount, 2) }}
                </span>
                </div>
                <!-- Progress Bar -->
                <div class="w-full bg-gray-200 rounded-full h-4">
                    <div
                        class="bg-teal-500 h-4 rounded-full transition-all duration-300"
                        style="width: {{ min(100, ($budget->totalSpent() / $budget->limit_amount) * 100) }}%">
                    </div>
                </div>
                <!-- Status Anggaran -->
                <p class="mt-1 text-sm {{ $budget->totalSpent() > $budget->limit_amount ? 'text-red-500' : 'text-green-500' }}">
                    {{ $budget->totalSpent() > $budget->limit_amount ? 'Over Budget' : 'Dalam Batas' }}
                </p>
            </div>
        @endforeach
        @if($budgets->isEmpty())
            <p class="text-center mt-4 text-gray-500">Belum ada anggaran terdaftar.</p>
        @endif
    </div>


    <!-- Statistik dan Grafik -->
    <div class="bg-white p-6 rounded-lg shadow-lg mt-6">
        <h3 class="text-2xl font-semibold text-teal-600 mb-4">Statistik Keuangan</h3>
        <canvas id="budgetChart"></canvas>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Menampilkan data kategori dan anggaran untuk debugging
        console.log("Data Kategori: ", {!! json_encode($categories->pluck('name')) !!});

        // Memastikan anggaran tidak null atau kosong dengan menggunakan optional() dan menghindari error
        console.log("Data Anggaran: ", {!! json_encode($categories->map(fn($cat) => optional($cat->budgets)->sum('limit_amount') ?? 0)) !!});

        const ctx = document.getElementById('budgetChart').getContext('2d');
        const budgetChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($categories->pluck('name')) !!},
                datasets: [{
                    label: 'Anggaran (IDR)',
                    data: {!! json_encode($categories->map(fn($cat) => optional($cat->budgets)->sum('limit_amount') ?? 0)) !!},
                    backgroundColor: 'rgba(56, 178, 172, 0.8)',
                    borderColor: 'rgba(56, 178, 172, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return 'Rp. ' + tooltipItem.raw.toLocaleString();
                            }
                        }
                    }
                }
            }
        });
    </script>
@endpush

