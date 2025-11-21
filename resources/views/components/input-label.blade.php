@props(['value'])

<label {{ $attributes->merge(['class' => 'lms-form-label']) }}>
    {{ $value ?? $slot }}
</label>