@props([
    'size' => 'md',
    'type' => 'submit',
    'placement' => 'left',
    'classes' => '',
    'tooltipText' => ''
])

<div class="w-100 d-flex {{ $placement === 'left' ? 'justify-content-start' : ($placement === 'center' ? 'justify-content-center' : 'justify-content-end') }}">
    <button class="btn btn-warning btn-{{ $size }} {{ $classes }}" type="{{ $type }}" data-toggle="tooltip" data-placement="top" title="{{ __($tooltipText) }}">
        {{ $slot }}
    </button>
</div>