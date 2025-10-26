<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Welcome Message --}}
            <div class="bg-gradient-to-r bg-gray-500 rounded-lg shadow-lg p-6 mb-6 text-white">
                <div class="flex items-center justify-betwee">
                    <div>
                        <h3 class="text-2xl font-bold mb-2">Halo, {{ Auth::user()->name }}! 👋</h3>
                        <p class="text-indigo-100">Selamat datang kembali</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>