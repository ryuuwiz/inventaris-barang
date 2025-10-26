<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Barang') }}
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('barang.edit', $barang->id_barang) }}">
                    <x-warning-button>
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit
                    </x-warning-button>
                </a>
                <form action="{{ route('barang.destroy', $barang->id_barang) }}" 
                      method="POST" 
                      class="inline"
                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?')">
                    @csrf
                    @method('DELETE')
                    <x-danger-button type="submit">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Hapus
                    </x-danger-button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Alert Messages --}}
            @if(session('success'))
                <x-alert type="success" class="mb-6">
                    {{ session('success') }}
                </x-alert>
            @endif

            @if(session('error'))
                <x-alert type="error" class="mb-6">
                    {{ session('error') }}
                </x-alert>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Main Information --}}
                <div class="lg:col-span-2">
                    <x-card title="Informasi Barang">
                        <div class="space-y-6">
                            {{-- ID Barang --}}
                            <div class="pb-4 border-b border-gray-200">
                                <div class="text-sm font-medium text-gray-500 mb-1">ID Barang</div>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                    #{{ $barang->id_barang }}
                                </span>
                            </div>

                            {{-- Nama Barang --}}
                            <div class="border-b border-gray-200 pb-4">
                                <div class="text-sm font-medium text-gray-500 mb-2">Nama Barang</div>
                                <div class="text-2xl font-bold text-gray-900">
                                    {{ $barang->nama_barang }}
                                </div>
                            </div>

                            {{-- Kategori --}}
                            <div class="border-b border-gray-200 pb-4">
                                <div class="text-sm font-medium text-gray-500 mb-2">Kategori</div>
                                <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-sm font-medium bg-indigo-100 text-indigo-800">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                    {{ $barang->kategori->nama_kategori ?? '-' }}
                                </span>
                            </div>

                            {{-- Tanggal Masuk --}}
                            <div>
                                <div class="text-sm font-medium text-gray-500 mb-2">Tanggal Masuk</div>
                                <div class="flex items-center text-gray-900">
                                    <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    {{ \Carbon\Carbon::parse($barang->tanggal_masuk)->format('d M Y') }}
                                </div>
                            </div>
                        </div>
                    </x-card>
                </div>

                {{-- Sidebar Info --}}
                <div class="space-y-6">
                    {{-- Stock & Price Card --}}
                    <x-card title="Stok & Harga">
                        <div class="space-y-4">
                            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-lg p-4 border border-blue-200">
                                <div class="text-sm font-medium text-blue-600 mb-1">Stok Tersedia</div>
                                <div class="text-3xl font-bold text-blue-900">
                                    {{ number_format($barang->stok, 0, ',', '.') }}
                                </div>
                                @if($barang->stok <= 10)
                                <div class="mt-2 flex items-center text-red-600 text-sm">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    Stok Rendah
                                </div>
                                @endif
                            </div>

                            <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-lg p-4 border border-green-200">
                                <div class="text-sm font-medium text-green-600 mb-1">Harga</div>
                                <div class="text-2xl font-bold text-green-900">
                                    Rp {{ number_format($barang->harga, 0, ',', '.') }}
                                </div>
                            </div>

                            <div class="bg-gray-50 rounded-lg p-3">
                                <div class="text-xs font-medium text-gray-500 mb-1">Total Nilai Stok</div>
                                <div class="text-lg font-bold text-gray-900">
                                    Rp {{ number_format($barang->stok * $barang->harga, 0, ',', '.') }}
                                </div>
                            </div>
                        </div>
                    </x-card>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="mt-6 flex justify-between items-center">
                <a href="{{ route('barang.index') }}">
                    <x-secondary-button>
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali ke Daftar
                    </x-secondary-button>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>