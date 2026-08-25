@props(['label' => '', 'name' => '', 'type' => 'text', 'required' => false, 'placeholder' => '', 'rows' => 3])
<div>
    @if ($label)<label for="{{ $name }}" class="form-label">{{ $label }}@if ($required) <span class="text-red-500">*</span>@endif</label>@endif
    @if ($type === 'textarea')
        <textarea id="{{ $name }}" name="{{ $name }}" rows="{{ $rows }}" placeholder="{{ $placeholder }}" {{ $attributes->class(['form-textarea']) }}>{{ $slot }}</textarea>
    @elseif ($type === 'select')
        <select id="{{ $name }}" name="{{ $name }}" {{ $attributes->class(['form-select']) }}>{{ $slot }}</select>
    @else
        <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" placeholder="{{ $placeholder }}" {{ $attributes->class(['form-input']) }}>
    @endif
    @error($name)<p class="form-error">{{ $message }}</p>@enderror
</div>
