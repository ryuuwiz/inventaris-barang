<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Laporan Barang') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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

            {{-- Filter & Export Card --}}
            <x-card class="mb-6">
                <form method="GET" action="{{ route('laporan.index') }}" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        {{-- Kategori --}}
                        <div>
                            <x-input-label for="kategori" :value="__('Kategori')" />
                            <select id="kategori" name="kategori"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">Semua Kategori</option>
                                @foreach($kategoris as $kat)
                                <option value="{{ $kat->id_kategori }}" {{ request('kategori')==$kat->id_kategori ?
                                    'selected' : '' }}>
                                    {{ $kat->nama_kategori }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Tanggal Masuk Awal --}}
                        <div>
                            <x-input-label for="tgl_awal" :value="__('Tanggal Masuk Awal')" />
                            <input type="date" id="tgl_awal" name="tgl_awal" value="{{ request('tgl_awal') }}"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        </div>

                        {{-- Tanggal Masuk Akhir --}}
                        <div>
                            <x-input-label for="tgl_akhir" :value="__('Tanggal Masuk Akhir')" />
                            <input type="date" id="tgl_akhir" name="tgl_akhir" value="{{ request('tgl_akhir') }}"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        </div>
                    </div>

                    <div class="flex flex-wrap items-center gap-2">
                        <button type="submit" name="action" value="export" formaction="{{ route('laporan.export') }}"
                            class="inline-flex items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-700 focus:bg-emerald-700 active:bg-emerald-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                            Tampilkan Laporan
                        </button>

                        @if(request()->hasAny(['kategori', 'tgl_awal', 'tgl_akhir']))
                        <a href="{{ route('laporan.index') }}">
                            <x-secondary-button type="button">
                                Reset
                            </x-secondary-button>
                        </a>
                        @endif
                    </div>
                </form>
            </x-card>
        </div>
    </div>

    <script>
        /**
         * exportPDF()
         * Mengarahkan Route export pdf pada controller laporan
         */
        function exportPDF() {
            const params = new URLSearchParams(window.location.search);
            params.set('export', 'pdf');
            window.location.href = '{{ route("laporan.export") }}?' + params.toString();
        }
    </script>
</x-app-layout>