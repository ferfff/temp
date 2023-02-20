<div class="bs-stepper">
    <div class="bs-stepper-header" role="tablist">
        @foreach ($categorias as $categoria)
            <div class="step" data-target="#{{ Str::slug($categoria) }}-part">
                <button type="button" class="step-trigger" role="tab" aria-controls="{{ Str::slug($categoria) }}-part"
                    id="{{ Str::slug($categoria) }}-part-trigger">
                    <span class="bs-stepper-circle">{{ ++$i }}</span>
                    <span class="bs-stepper-label">{{ ucwords($categoria) }}</span>
                </button>
            </div>
            @if (!$loop->last)
                <div class="line"></div>
            @endif
        @endforeach
    </div>
    <div class="bs-stepper-content">
        {{ $slot }}
    </div>
</div>
