<div class="card-header">
    <div style="display: flex; justify-content: space-between; align-items: center;">

        <h3 class="card_title"><i class="{{ $icon }}"></i> {{ $title }}</h3>

        <div class="float-right">
            @can("$route.store")
                @if ($type == 'redirect')
                    @if ($agregar)
                        <a href="{{ route("$route.create") }}" class="btn btn-primary btn-sm float-right"
                            data-placement="left">
                            <i class="fas fa-plus"></i> {{ $message }}
                        </a>
                    @endif
                    @if ($excel)
                        <button type="button" class="btn btn-sm btn-secondary mr-1" data-toggle="modal"
                            data-target="#modal-excel">Excel</button>
                    @endif
                @else
                    <button type="button" class="btn btn-sm btn-primary float-right" data-placement="left"
                        data-toggle="modal" data-target="#modal-{{ $modalName }}">
                        <i class="fas fa-plus"></i> {{ $message }}
                    </button>
                @endif
            @endcan
        </div>
    </div>
</div>
