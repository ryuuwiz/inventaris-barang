@props(['message' => 'Memuat data...'])

<div {{ $attributes->merge(['class' => 'flex flex-col items-center justify-center py-12 px-4']) }}>
    <div class="relative">
        <div class="w-16 h-16 border-4 border-blue-200 border-t-blue-600 rounded-full animate-spin"></div>
    </div>
    <p class="text-gray-600 text-base font-medium mt-4">{{ $message }}</p>
</div>