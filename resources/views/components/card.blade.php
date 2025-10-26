@props(['title' => null, 'padding' => true])

<div {{ $attributes->merge(['class' => 'bg-white overflow-hidden shadow-md sm:rounded-lg border border-gray-200']) }}>
    @if($title)
    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
        <h3 class="text-lg font-semibold text-gray-800">{{ $title }}</h3>
    </div>
    @endif
    
    <div @class(['p-6' => $padding])>
        {{ $slot }}
    </div>
</div>