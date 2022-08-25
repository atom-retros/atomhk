@props([
    'name',
    'type' => 'text',
    'placeholder' => '',
    'value' => '',
    'classes' => '',
    'disabled' => false,
    'autofocus' => false,
    'required' => false,
])

<input
    id="{{ $name }}"
    class="form-control {{ $classes }}"
    type="{{ $type }}"
    name="{{ $name }}"
    value="{{ $value }}"
    placeholder="{{ $placeholder }}"
    @if($disabled) disabled @endif
    @if($autofocus) disabled @endif
    @if($required) required @endif
>