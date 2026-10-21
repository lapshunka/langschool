@props(['title', 'url', 'badge' => null, 'image' => null])

<article {{ $attributes->merge(['class' => 'card']) }} style="padding: 20px;">
    <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 20px;">
        
        <!-- Левая часть: заголовок, бейдж и текст -->
        <div style="flex-grow: 1; min-width: 0;">
            <h3 style="margin: 0 0 10px 0;">
                <a href="{{ $url }}" style="text-decoration: none; color: #2b6cb0;">{{ $title }}</a>
            </h3>
            
            @if ($badge)
                <div style="margin-bottom: 10px;">
                    <x-badge>{{ $badge }}</x-badge>
                </div>
            @endif
            
            <div class="card-body">
                {{ $slot }}
            </div>
        </div>

        <!-- Правая часть: квадратная миниатюра картинки (100x100px) -->
        @if ($image)
            <div style="flex-shrink: 0; width: 100px; height: 100px;">
                <img src="{{ $image }}" alt="{{ $title }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px; border: 1px solid #e2e8f0;">
            </div>
        @endif

    </div>
</article>