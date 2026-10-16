<div {{ $attributes->merge(['class' => 'alert alert-' . $type]) }}>
    <span class="alert-icon">{{ $icon() }}</span>
    <div class="alert-content">
        {{ $slot }}
    </div>
</div>