@extends('adminlte::page')

@section('plugins.Switch', true)
@section('plugins.iCheck', true)

@section('title', 'Definicion de Documentos')

@section('content_header')
    {{ Breadcrumbs::render('definicionDocumentos.index') }}
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <x-layouts.header title="Definicion de Documento" message="Agregar" route="definicion-documentos"
                    icon="fas fa-file-alt" />

                <div class="card-body">
                    <x-layouts.buscador route="definicion-documentos" :buscar="$buscar" :activo="$activo"
                        :show="true" />
                    <x-tables.table :headers="[
                        'Documento',
                        'Requerido en',
                        '¿Obligatorio?',
                        '¿Requiere Aprobacion?',
                        '¿Solicita Comentario?',
                        '¿Multiple?',
                        '¿Solicita Referencia?',
                        '¿Programa Seguimiento?',
                        '¿Permite aplazamiento?',
                        '¿Activo?',
                        'Acciones',
                    ]">
                        @forelse ($definicionDocumentos as $definicionDocumento)
                            <tr>
                                <x-tables.td :key="true">{{ $definicionDocumento->nombre }}</x-tables.td>
                                <x-tables.td>{{ $definicionDocumento->ciclo->nombre }}</x-tables.td>
                                <x-tables.td>
                                    <x-inputs.check :value="$definicionDocumento->obligatorio" :readonly="true" />
                                </x-tables.td>
                                <x-tables.td>
                                    <x-inputs.check :value="$definicionDocumento->solicita_aprobacion" :readonly="true" />
                                </x-tables.td>
                                <x-tables.td>
                                    <x-inputs.check :value="$definicionDocumento->solicita_comentario" :readonly="true" />
                                </x-tables.td>
                                <x-tables.td>
                                    <x-inputs.check :value="$definicionDocumento->multiple" :readonly="true" />
                                </x-tables.td>
                                <x-tables.td>
                                    <x-inputs.check :value="$definicionDocumento->referencia" :readonly="true" />
                                </x-tables.td>
                                <x-tables.td>
                                    <x-inputs.check :value="$definicionDocumento->seguimiento" :readonly="true" />
                                </x-tables.td>
                                <x-tables.td>
                                    <x-inputs.check :value="$definicionDocumento->aplazamiento" :readonly="true" />
                                </x-tables.td>
                                <x-tables.td>
                                    <x-inputs.check :value="$definicionDocumento->deleted_at == null" :readonly="true" />
                                </x-tables.td>

                                <x-tables.td>
                                    <x-buttons.dropdown-eliminar :value="$definicionDocumento" route="definicion-documentos" />
                                </x-tables.td>
                            </tr>
                        @empty
                            <x-layouts.vacio />
                        @endforelse
                    </x-tables.table>
                    {!! $definicionDocumentos->links() !!}
                </div>
            </div>
        </div>
    </div>
    <x-modals.modal-eliminar-restaurar type="delete" :value="$definicionDocumentos" route="definicion-documentos.destroy"
        method="DELETE" message="Desactivar" />
    <x-modals.modal-eliminar-restaurar type="restore" :value="$definicionDocumentos" route="definicion-documentos-restore"
        method="PUT" message="Restaurar" bgColor="primary" />
@stop

@section('css')
    <style>
        #table {
            display: block;
            overflow: auto;
        }
    </style>
@stop

@section('js')
    <script>
        $('#confirm-delete').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var slug = button.data('slug')
            var modal = $(this)
            modal.find('.modal-body #slugdelete').val(slug)
        })
        $('#confirm-restore').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var slug = button.data('slug')
            var modal = $(this)
            modal.find('.modal-body #slugrestore').val(slug)
        })
        $('input[type="checkbox"]').bootstrapSwitch({
            onText: "Si",
            offText: 'No'
        });
    </script>
@stop
