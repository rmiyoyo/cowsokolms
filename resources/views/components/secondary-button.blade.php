<button {{ $attributes->merge(['type' => 'button', 'class' => 'lms-btn-secondary']) }}>
    {{ $slot }}
</button>