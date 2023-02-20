<div class="dropdown">
    <button class="btn btn-sm btn-warning dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown">
        Opciones
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        @can("$route.update")
            @if ($editar == true)
                <a class="dropdown-item" href="{{ route("$route.edit", $value) }}">
                    <i class="fa fa-fw fa-edit"></i> {{ $text }}
                </a>
            @endif
        @endcan
        {{ $slot }}
    </div>
</div>
