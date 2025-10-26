<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Barang') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
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

            <x-card title="Form Edit Barang">
                <form method="POST" action="{{ route('barang.update', $barang->id_barang) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    {{-- Nama Barang --}}
                    <div>
                        <x-input-label for="nama_barang" :value="__('Nama Barang')" class="required" />
                        <x-text-input
                            id="nama_barang"
                            name="nama_barang"
                            type="text"
                            class="mt-1 block w-full"
                            :value="old('nama_barang', $barang->nama_barang)"
                            required
                            autofocus
                            placeholder="Masukkan nama barang"
                        />
                        <x-input-error class="mt-2" :messages="$errors->get('nama_barang')" />
                    </div>

                    {{-- Kategori --}}
                    <div>
                        <x-input-label for="id_kategori" :value="__('Kategori')" class="required" />
                        <select
                            id="id_kategori"
                            name="id_kategori"
                            required
                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                        >
                            <option value="">Pilih Kategori</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id_kategori }}" {{ old('id_kategori', $barang->id_kategori) == $kategori->id_kategori ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('id_kategori')" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        {{-- Stok --}}
                        <div>
                            <x-input-label for="stok" :value="__('Stok')" class="required" />
                            <x-text-input
                                id="stok"
                                name="stok"
                                type="number"
                                min="0"
                                class="mt-1 block w-full"
                                :value="old('stok', $barang->stok)"
                                required
                                placeholder="0"
                            />
                            <x-input-error class="mt-2" :messages="$errors->get('stok')" />
                        </div>

                        {{-- Harga --}}
                        <div>
                            <x-input-label for="harga" :value="__('Harga (Rp)')" class="required" />
                            <x-text-input
                                id="harga"
                                name="harga"
                                type="number"
                                min="0"
                                step="0.01"
                                class="mt-1 block w-full"
                                :value="old('harga', $barang->harga)"
                                required
                                placeholder="0"
                            />
                            <x-input-error class="mt-2" :messages="$errors->get('harga')" />
                        </div>

                        {{-- Tanggal Masuk --}}
                        <div>
                            <x-input-label for="tanggal_masuk" :value="__('Tanggal Masuk')" class="required" />
                            <x-text-input
                                id="tanggal_masuk"
                                name="tanggal_masuk"
                                type="date"
                                class="mt-1 block w-full"
                                :value="old('tanggal_masuk', $barang->tanggal_masuk)"
                                required
                            />
                            <x-input-error class="mt-2" :messages="$errors->get('tanggal_masuk')" />
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-200">
                        <a href="{{ route('barang.index') }}">
                            <x-secondary-button type="button">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Batal
                            </x-secondary-button>
                        </a>
                        <x-primary-button type="submit">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
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