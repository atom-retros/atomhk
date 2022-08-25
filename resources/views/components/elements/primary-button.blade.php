@props([
    'size' => 'md',
    'type' => 'submit',
    'placement' => 'left',
    'classes' => ''
])

<div class="w-100 d-flex {{ $placement === 'left' ? 'justify-content-start' : ($placement === 'center' ? 'justify-content-center' : 'justify-content-end') }}">
    <button class="btn btn-primary btn-{{ $size }} {{ $classes }}" type="{{ $type }}">
        {{ $slot }}
    </button>
</div>