<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Kategori') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Error Messages --}}
            @if($errors->any())
            <x-alert type="error" class="mb-6">
                <p class="font-semibold mb-2">Terdapat kesalahan:</p>
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </x-alert>
            @endif

            <x-card title="Form Edit Kategori">
                <form method="POST" action="{{ route('kategori.update', $kategori->id_kategori) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    {{-- Nama Kategori --}}
                    <div>
                        <x-input-label for="nama_kategori" :value="__('Nama Kategori')" class="required" />
                        <x-text-input id="nama_kategori" name="nama_kategori" type="text" class="mt-1 block w-full"
                            :value="old('nama_kategori', $kategori->nama_kategori)" required autofocus
                            placeholder="Masukkan nama kategori" />
                        <x-input-error class="mt-2" :messages="$errors->get('nama_kategori')" />
                        <p class="mt-1 text-sm text-gray-500">Contoh: Elektronik, Furniture, Alat Tulis</p>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-200">
                        <a href="{{ route('kategori.index') }}">
                            <x-secondary-button type="button">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Batal
                            </x-secondary-button>
                        </a>
                        <x-primary-button type="submit">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Update
                        </x-primary-button>
                    </div>
                </form>
            </x-card>
        </div>
    </div>

    <style>
        .required::after {
            content: " *";
            color: #ef4444;
        }
    </style>
</x-app-layout>