<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Detail Kategori') }}
                </h2>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('kategori.edit', $kategori->id_kategori) }}">
                    <x-warning-button>
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit
                    </x-warning-button>
                </a>
                <form action="{{ route('kategori.destroy', $kategori->id_kategori) }}" method="POST" class="inline"
                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                    @csrf
                    @method('DELETE')
                    <x-danger-button type="submit">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Hapus
                    </x-danger-button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
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

            {{-- Detail Card --}}
            <x-card title="Informasi Kategori">
                <div class="space-y-6">
                    {{-- ID Kategori --}}
                    <div class="flex flex-col sm:flex-row sm:items-start border-b border-gray-200 pb-4">
                        <div class="w-full sm:w-1/3 font-medium text-gray-700 mb-1 sm:mb-0">
                            ID Kategori
                        </div>
                        <div class="w-full sm:w-2/3 text-gray-900">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                #{{ $kategori->id_kategori }}
                            </span>
                        </div>
                    </div>

                    {{-- Nama Kategori --}}
                    <div class="flex flex-col sm:flex-row sm:items-start">
                        <div class="w-full sm:w-1/3 font-medium text-gray-700 mb-1 sm:mb-0">
                            Nama Kategori
                        </div>
                        <div class="w-full sm:w-2/3 text-gray-900 text-lg font-semibold">
                            {{ $kategori->nama_kategori }}
                        </div>
                    </div>
                </div>
            </x-card>

            {{-- Action Buttons --}}
            <div class="mt-6 flex justify-between items-center">
                <a href="{{ route('kategori.index') }}">
                    <x-secondary-button>
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke Daftar
                    </x-secondary-button>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>