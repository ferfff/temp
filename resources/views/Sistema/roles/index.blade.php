@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    {{ Breadcrumbs::render('roles.index') }}
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <x-layouts.header title="Roles" message="Agregar" route="roles" icon="fas fa-user-tag" />
                <div class="card-body">
                    @if ($roles->count())
                        <x-tables.table :headers="['ID', 'Rol', 'Acciones']">
                            @forelse ($roles as $rol)
                                <tr>
                                    <x-tables.td :key="true">{{ $rol->id }}</x-tables.td>
                                    <x-tables.td>{{ $rol->name }}</x-tables.td>
                                    @can('roles.update')
                                        <x-tables.td>
                                            <x-buttons.dropdown-eliminar :value="$rol" route="roles" :viewId="false" />
                                        </x-tables.td>
                                    @endcan
                                </tr>
                            @empty
                                <x-layouts.vacio />
                            @endforelse
                        </x-tables.table>
                    @else
                        <h1><strong>No hay registros</strong></h1>
                    @endif
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
@stop
