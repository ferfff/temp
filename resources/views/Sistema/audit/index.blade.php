@extends('adminlte::page')

@section('title', 'Auditorias')

@section('content_header')
    {{ Breadcrumbs::render('auditorias.index') }}
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span id="card_title">
                            {{ __('Audit') }}
                        </span>
                    </div>
                </div>

                <div class="card-body">
                    <x-tables.table :headers="['ID', 'Usuario', 'Evento', 'Url', 'Ip', 'Acciones']">
                        @forelse ($audits as $audit)
                            <tr>
                                <x-tables.td :key="true">{{ $audit->id }}</x-tables.td>

                                <x-tables.td>{{ $audit->user->name }}</x-tables.td>
                                <x-tables.td>
                                    @if ($audit->event == 'created')
                                        Creado
                                    @elseif ($audit->event == 'updated')
                                        Editado
                                    @elseif ($audit->event == 'deleted')
                                        Eliminado
                                    @elseif($audit->event == 'restored')
                                        Restaurado
                                    @endif
                                </x-tables.td>
                                <x-tables.td>{{ $audit->url }}</x-tables.td>
                                <x-tables.td>{{ $audit->ip_address }}</x-tables.td>
                                <x-tables.td>
                                    <a class="btn btn-sm btn-primary" href="{{ route('auditorias.show', $audit->id) }}">
                                        <i class="fa fa-fw fa-eye"></i> Ver
                                    </a>
                                </x-tables.td>
                            </tr>
                        @empty
                            <x-layouts.vacio />
                        @endforelse
                    </x-tables.table>
                </div>
            </div>
            {!! $audits->links() !!}
        </div>
    </div>
@stop
