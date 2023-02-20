<div class="form-group position-relative">
    <label>Nombre</label>
    <input type="text" name="name" id="name" class="form-control" placeholder="Ingrese el nombre del rol"
        value="{{ $role->name }}" required>
</div>
<div class="row row-cols-1 row-cols-md-3">
    @foreach ($modulos as $modulo)
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">{{ $modulo->name }}</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach ($modulo->permisos as $permiso)
                            <label class="row col-md-12">
                                <div class="col-md-11">
                                    {!! Form::checkbox('permissions[]', $permiso->id, null, [
                                        'class' => 'mr-1 pr-1',
                                        'data-size' => 'mini',
                                        'id' => 'permissions',
                                    ]) !!}&nbsp; {{ $permiso->description }}
                                </div>
                                <a href="javascript:" data-toggle="popover" title="Ayuda" data-trigger="focus"
                                    data-content="{{ $permiso->help }}">
                                    <i class="fa fa-info-circle"></i>
                                </a>
                            </label>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endforeach
</div>
<div class="form-group">
    <button type="button" class="btn btn-sm btn-primary" id="enviar-rol">
        Guardar
    </button>
    <a href="{{ route('roles.index') }}" class="btn btn-sm btn-default">Cancelar</a>
</div>
