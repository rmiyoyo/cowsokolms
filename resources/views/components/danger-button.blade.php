<button {{ $attributes->merge(['type' => 'submit', 'class' => 'lms-btn-danger']) }}>
    {{ $slot }}
</button>