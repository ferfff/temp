@extends('adminlte::page')

@section('plugins.Switch', true)

@section('title', 'Obras Extras')

@section('content_header')
    {{ Breadcrumbs::render('obraExtra.show', $contrato) }}
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            <h2><i class="fas fa-file-signature"></i> Obras Extras
                                {{ $obrasExtras->first()->contratoCliente->razon_social ?? $cliente->razon_social }}
                            </h2>
                        </span>
                        <div class="float-right">
                            <button type="button" class="btn btn-primary btn-sm float-right" data-placement="left"
                                data-bs-toggle="modal" data-bs-target="#agregar-modal">
                                <i class="fas fa-plus"></i> Agregar
                            </button>
                        </div>

                    </div>
                </div>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                @include('layouts.error')
                <div class="card-body">
                    <form action="{{ route('obras-extras.show', $contrato) }}" method="GET" autocomplete="off">
                        @include('layouts.buscador')
                    </form>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>
                                        <center>ID</center>
                                    </th>

                                    <th>
                                        <center>Bitacora</center>
                                    </th>
                                    <th>
                                        <center>Contrato</center>
                                    </th>
                                    <th>
                                        <center>Aprobado</center>
                                    </th>
                                    <th>
                                        <center>Estado</center>
                                    </th>
                                    <th>
                                        <center>Acciones</center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($obrasExtras as $obrasExtra)
                                    <tr>
                                        <td>
                                            <center>{{ $obrasExtra->id }}</center>
                                        </td>

                                        <td>
                                            <center>{{ $obrasExtra->bitacora }}</center>
                                        </td>
                                        <td>
                                            <center>{{ $obrasExtra->contrato->folio }}</center>
                                        </td>
                                        <td>
                                            <center>
                                                <input type="checkbox" {{ $obrasExtra->aprobacion ? 'checked' : '' }}
                                                    class="form-check-input">
                                            </center>
                                        </td>
                                        <th>
                                            <center>
                                                <p>
                                                    @if ($obrasExtra->primera_firma == null or $obrasExtra->firmas_completas == null)
                                                        <span class="badge badge-pill badge-info">Faltan firmas</span>
                                                    @endif
                                                    @if ($obrasExtra->aprobacion == 0)
                                                        <span class="badge badge-pill badge-danger">No Aprobado</span>
                                                    @else
                                                        <span class="badge badge-pill badge-success">Aprobado</span>
                                                    @endif
                                                </p>
                                            </center>
                                        </th>
                                        <td>
                                            <center>
                                                <button class="btn btn-sm btn-warning dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-bs-toggle="dropdown">
                                                    Opciones
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <button class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#edit-modal" data-id="{{ $obrasExtra->id }}"
                                                        data-bitacora="{{ $obrasExtra->bitacora }}"
                                                        data-presupuesto="{{ $obrasExtra->presupuesto }}"
                                                        data-monto_original="{{ $obrasExtra->monto_original }}"
                                                        data-aprobacion={{ $obrasExtra->aprobacion }}
                                                        data-primera_firma={{ $obrasExtra->primera_firma }}
                                                        data-firmas_completas={{ $obrasExtra->firmas_completas }}>
                                                        <i class="fa fa-fw fa-eye"></i> Ver
                                                    </button>
                                                </div>
                                            </center>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {!! $obrasExtras->links() !!}
        </div>
    </div>
    <div class="modal fade" id="agregar-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('obras-extras.store') }}" method="post" enctype="multipart/form-data"
                    id="formulario" autocomplete="off">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modificar Estimacion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @include('Procesos.obras-extra.form')
                        <div class="form-group">
                            <div class="file-loading">
                                <input type="file" name="archivo[]" id="archivo" class="form-control"
                                    accept=".pdf, .docx, .doc" multiple>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary btn-sm mt-2" role="dialog" data-bs-toggle="modal"
                            data-bs-target="#confirm-agregar">
                            Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                @if ($obrasExtras->count())
                    <form action="{{ route('obras-extras.update', $obrasExtras->first()) }}" method="post"
                        enctype="multipart/form-data" id="formulario2" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modificar Estimacion</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @include('Procesos.obras-extra.form')
                            <div class="form-group">
                                <label for="tipo_id">Tipo documento</label>
                                <select name="tipo_id" id="tipo_id" class="form-control">
                                    @foreach ($tipos as $tipo)
                                        <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                                    @endforeach
                                </select>
                                <div class="file-loading">
                                    <input type="file" name="archivo[]" id="archivo2" class="form-control"
                                        accept=".pdf, .docx, .doc" multiple>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="aprobacion" class="form-check-label mr-4">Aprobado</label>
                                <input type="checkbox" name="aprobacion" id="aprobacion" class="form-check-input">
                            </div>
                            <div class="form-group">
                                <label for="primera_firma">Primera Firma</label>
                                <input type="date" name="primera_firma" id="primera_firma">
                            </div>
                            <div class="form-group">
                                <label for="firmas_completas">Firmas Completas</label>
                                <input type="date" name="firmas_completas" id="firmas_completas">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary btn-sm mt-2" role="dialog"
                                data-bs-toggle="modal" data-bs-target="#confirm-editar">
                                Guardar
                            </button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
    @include('layouts.confirm-agregar')
    <div class="modal fade" id="confirm-editar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"> Modificar </div>
                <div class="modal-body">
                    <label>¿Quieres Modificar el registro?</label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="button2">Agregar</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/css/fileinput.min.css" media="all"
        rel="stylesheet" type="text/css" />
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/fileinput.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/locales/es.js"></script>
    <script>
        $("#archivo").fileinput({
            language: "es",
            allowedFileExtensions: ['pdf', 'docx', 'doc'],
            'showUpload': false,
        });
        $("#archivo2").fileinput({
            language: "es",
            allowedFileExtensions: ['pdf', 'docx', 'doc'],
            'showUpload': false,
        });
        $('#edit-modal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var bitacora = button.data('bitacora')
            var presupuesto = button.data('presupuesto')
            var monto_original = button.data('monto_original')
            var aprobacion = button.data('aprobacion')
            var primera_firma = button.data('primera_firma')
            var firmas_completas = button.data('firmas_completas')
            var modal = $(this)
            modal.find('.modal-content #id').val(id)
            modal.find('.modal-content #bitacora').val(bitacora)
            modal.find('.modal-content #presupuesto').val(presupuesto)
            modal.find('.modal-content #monto_original').val(monto_original)
            modal.find('.modal-content #aprobacion').prop('checked', aprobacion)
            modal.find('.modal-content #primera_firma').val(primera_firma)
            modal.find('.modal-content #firmas_completas').val(firmas_completas)
        })

        document.addEventListener('DOMContentLoaded', e => {
            for (let checkbox of document.querySelectorAll('input[type=checkbox]')) {
                checkbox.value = checkbox.checked ? 1 : 0;
                checkbox.addEventListener('change', e => {
                    e.target.value = e.target.checked ? 1 : 0;
                });
            }
        });
        $('input[type="checkbox"]').bootstrapSwitch({
            onText: "Si",
            offText: 'No'
        });
        $('#formulario').validate({
            rules: {
                bitacora: {
                    required: true
                },
                presupuesto: {
                    required: true
                },
                monto_original: {
                    required: true
                },
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass("is-invalid").removeClass("is-valid");
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).addClass("is-valid").removeClass("is-invalid");
            }
        })
        $('#formulario2').validate({
            rules: {
                bitacora: {
                    required: true
                },
                presupuesto: {
                    required: true
                },
                monto_original: {
                    required: true
                },
                aprobacion: {
                    required: true
                },
                primera_firma: {
                    required: true
                },
                firmas_completas: {
                    required: true
                }
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass("is-invalid").removeClass("is-valid");
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).addClass("is-valid").removeClass("is-invalid");
            }
        })
    </script>
@stop
