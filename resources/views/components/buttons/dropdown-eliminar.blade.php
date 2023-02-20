<div class="dropdown">
    <button class="btn btn-sm btn-warning dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        Opciones
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        @if ($value->deleted_at == null)
            {{ $slot }}
            @if ($methodShow)
                <a class="dropdown-item" href="{{ route("$route.show", $value->uid) }}">
                    <i class="fa fa-fw fa-eye"></i> Ver
                </a>
            @endif
            @can($permiso != null ? "$permiso.update" : "$route.update")
                <a class="dropdown-item" href="{{ route("$route.edit", $value) }}">
                    <i class="fa fa-fw fa-edit"></i> Editar
                </a>
            @endcan
            @if (Auth::user()->id != $value->id or $viewId)
                @can($permiso != null ? "$permiso.destroy" : "$route.destroy")
                    <a type="submit" class="dropdown-item" data-toggle="modal" data-target="#confirm-delete"
                        data-slug="{{ $value->slug }}">
                        <i class="fa fa-fw fa-trash"></i> Desactivar
                    </a>
                @endcan
            @endif
        @else
            <a type="submit" class="dropdown-item" data-toggle="modal" data-target="#confirm-restore"
                data-slug="{{ $value->slug }}">
                <i class="fas fa-trash-restore"></i> Activar
            </a>
        @endif
    </div>
</div>
