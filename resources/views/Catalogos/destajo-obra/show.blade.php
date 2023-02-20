@extends('adminlte::page')

@section('plugins.UI', true)
@section('plugins.Numeral', true)
@section('plugins.Dropzone', true)
@section('plugins.Datatables', true)
@section('plugins.iCheck', true)

@section('title', 'Destajo de Obra')

@section('content_header')
    {{ Breadcrumbs::render('destajo-de-obras.show', $contrato) }}
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">
                                Destajo de Obra a: {{ $contrato->folio }} /
                                <small> {{ $contrato->cliente->razon_social }}</small>
                            </span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-secondary" href="{{ route('control-de-obras.index') }}"> Regresar</a>
                        </div>
                    </div>
                </div>
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-three-destajo-tab" data-toggle="pill"
                                    href="#custom-tabs-three-destajo" role="tab"
                                    aria-controls="custom-tabs-three-destajo" aria-selected="true">
                                    <i class="fas fa-pen"></i> Destajo
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-three-descargar-tab" data-toggle="pill"
                                    href="#custom-tabs-three-descargar" role="tab"
                                    aria-controls="custom-tabs-three-descargar" aria-selected="false">
                                    <i class="fas fa-download"></i> Descargar
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-three-tabContent">
                            <div class="tab-pane fade active show" id="custom-tabs-three-destajo" role="tabpanel"
                                aria-labelledby="custom-tabs-three-destajo-tab">
                                <form action="{{ route('destajo-de-obras.store') }}" method="post" class="col-md-12">
                                    @csrf
                                    <div id="accordion">
                                        @php
                                            $subtotal = 0;
                                            $total = 0;
                                        @endphp
                                        @for ($i = 0; $i < count($keys); $i++)
                                            <div class="card card-primary card-outline">
                                                <a class="d-block w-100{{ $i != 0 ? ' collapsed' : '' }}"
                                                    data-toggle="collapse" href="#collapse-{{ Str::slug($keys[$i]) }}"
                                                    aria-expanded="true">
                                                    <div class="card-header">
                                                        <h4 class="card-title w-100">
                                                            {{ $codigos[$i] . ' ' . $keys[$i] }}
                                                        </h4>
                                                    </div>
                                                </a>
                                                <div id="collapse-{{ Str::slug($keys[$i]) }}" data-parent="#accordion"
                                                    class="collapse{{ $i == 0 ? ' show' : '' }}">
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-bordered table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th colspan="6" style="background: #15bf81">
                                                                            <center>Definido</center>
                                                                        </th>
                                                                        <th colspan="2" style="background: #BF5B02"
                                                                            class="text-white">
                                                                            <center>Estimacion </center>
                                                                        </th>
                                                                        <th colspan="2" style="background: #BF2862"
                                                                            class="text-white">
                                                                            <center>Acumulado</center>
                                                                        </th>
                                                                        <th rowspan="2" style="background:#1FA1BF"
                                                                            class="align-middle text-white">
                                                                            <center>Evidencias</center>
                                                                        </th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="col" style="background: #15bf81">
                                                                            Clave</th>
                                                                        <th scope="col" style="background: #15bf81">
                                                                            Partida</th>
                                                                        <th scope="col" style="background: #15bf81">
                                                                            Unidad</th>
                                                                        <th scope="col" style="background: #15bf81">
                                                                            Cantidad</th>
                                                                        <th scope="col" style="background: #15bf81">
                                                                            Precio Unitario
                                                                        </th>
                                                                        <th scope="col" style="background: #15bf81">
                                                                            Importe
                                                                        </th>
                                                                        <th scope="col" style="background: #BF5B02"
                                                                            class="text-white">
                                                                            Cantidad</th>
                                                                        <th scope="col" style="background: #BF5B02"
                                                                            class="text-white">
                                                                            Importe</th>
                                                                        <th scope="col" class="text-white"
                                                                            style="background: #BF2862">Cantidad</th>
                                                                        <th scope="col" class="text-white"
                                                                            style="background: #BF2862">Importe</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($contrato->control->where('grupo', $keys[$i]) as $control)
                                                                        @php
                                                                            $cantidad_acumulada = 0;
                                                                            $importe_acumulada = 0;
                                                                            $id = null;
                                                                            $j = 0;
                                                                            foreach ($control->definiciones as $key => $definicion) {
                                                                                $cantidad_acumulada += floatval($definicion->cantidad_acumulada);
                                                                                $importe_acumulada += floatval($definicion->importe_acumulado);
                                                                                if ($j == 0) {
                                                                                    $id = $definicion->uuid;
                                                                                }
                                                                                $j++;
                                                                            }
                                                                            $subtotal += $importe_acumulada;
                                                                        @endphp
                                                                        <tr>
                                                                            <input type="hidden" name="id"
                                                                                id="lbl-id" value="{{ $control->id }}">
                                                                            <td scope="row">
                                                                                {{ $control->clave }}
                                                                            </td>
                                                                            <td>{{ $control->partida }}</td>
                                                                            <td>{{ $control->unidad }}</td>
                                                                            <td style="text-align: right">
                                                                                {{ number_format($control->cantidad, 2, '.', ',') }}
                                                                            </td>
                                                                            <td style="text-align: right">
                                                                                {{ "$" . number_format($control->precio_unitario, 2, '.', ',') }}
                                                                            </td>
                                                                            <td style="text-align: right">
                                                                                {{ "$" . number_format($control->importe, 2, '.', ',') }}
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" name="cantidad"
                                                                                    id="lbl-cantidad" class="form-control"
                                                                                    style="text-align: right"
                                                                                    {{ $importe_acumulada >= $control->importe ? 'readonly' : '' }} />
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" name="importe"
                                                                                    id="lbl-importe" class="form-control"
                                                                                    style="text-align: right" readonly />
                                                                            </td>
                                                                            <td style="text-align: right">
                                                                                {{ number_format($cantidad_acumulada, 2, '.', ',') }}
                                                                            </td>
                                                                            <td style="text-align: right">
                                                                                {{ "$" . number_format($importe_acumulada, 2, '.', ',') }}
                                                                            </td>
                                                                            <td>
                                                                                @if ($estimacion > 1)
                                                                                    <button type="button"
                                                                                        class="btn btn-info"
                                                                                        data-bs-toggle="modal"
                                                                                        data-bs-target="#modalEvidencias"
                                                                                        data-bs-target="#staticBackdrop"
                                                                                        data-control_id="{{ $control->id }}"
                                                                                        data-definiciones="{{ $id }}">
                                                                                        <i class="fas fa-camera"></i>
                                                                                        Evidencias
                                                                                    </button>
                                                                                    <button type="button"
                                                                                        class="btn btn-success"
                                                                                        data-bs-toggle="modal"
                                                                                        data-bs-target="#modalVer"
                                                                                        data-bs-target="#staticBackdrop"
                                                                                        data-definiciones="{{ $id }}">
                                                                                        <i class="far fa-eye"></i>
                                                                                        Ver
                                                                                    </button>
                                                                                @endif
                                                                            </td>
                                                                        </tr>
                                                                        @if ($loop->last)
                                                                            <tr>
                                                                                <td colspan="9"
                                                                                    style="text-align: right">
                                                                                </td>
                                                                                <td>{{ "$" . number_format($subtotal, 2, '.', ',') }}
                                                                                </td>
                                                                            </tr>
                                                                            @php
                                                                                $total += $subtotal;
                                                                                $subtotal = 0;
                                                                            @endphp
                                                                        @endif
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endfor
                                        <table class="table table-sm table-hover">
                                            <tbody>
                                                <tr class="table-primary">
                                                    @php
                                                        $iva_total = $total * $iva;
                                                    @endphp
                                                    <td class="w-75" style="text-align: right">
                                                        <b>Subtotal:</b>
                                                    </td>
                                                    <td>
                                                        {{ "$" . number_format($total, 2, '.', ',') }}
                                                    </td>
                                                </tr>
                                                <tr class="table-warning">
                                                    <td class="w-75" style="text-align: right">
                                                        <b>Iva:</b>
                                                    </td>
                                                    <td>
                                                        {{ "$" . number_format($iva_total, 2, '.', ',') }}
                                                    </td>
                                                </tr>
                                                <tr class="table-success">
                                                    <td class="w-75" style="text-align: right">
                                                        <b>Total:</b>
                                                    </td>
                                                    <td>
                                                        {{ "$" . number_format($total + $iva_total, 2, '.', ',') }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#confirm" id="enviar-destajo">Guardar</button>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-three-descargar" role="tabpanel"
                                aria-labelledby="custom-tabs-three-descargar-tab">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <form action="{{ route('exportar-control_obra', $contrato->uid) }}"
                                            method="get" class="col-md-6">
                                            <fieldset>
                                                <legend>
                                                    <center>Seleccione rango</center>
                                                </legend>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="form-check ml-2">
                                                            <div class="icheck-primary">
                                                                <input class="form-check-input" type="radio"
                                                                    name="rango" id="exampleRadios1" value="0"
                                                                    onclick="handleClick(this);" required>
                                                                <label class="form-check-label"
                                                                    for="exampleRadios1">Todas</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-check ml-2">
                                                            <div class="icheck-primary">
                                                                <input class="form-check-input" type="radio"
                                                                    name="rango" id="exampleRadios2" value="1"
                                                                    onclick="handleClick(this);" required>
                                                                <label class="form-check-label"
                                                                    for="exampleRadios2">Ultima</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-check ml-2">
                                                            <div class="icheck-primary">
                                                                <input class="form-check-input" type="radio"
                                                                    name="rango" id="exampleRadios3" value="2"
                                                                    onclick="handleClick(this);" required>
                                                                <label class="form-check-label"
                                                                    for="exampleRadios3">Seleccionar rango</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="campos">
                                                        <div class="row">
                                                            <label for="menor">Entre</label>
                                                            <select name="menor" id="menor" class="form-control">
                                                                <option value=""></option>
                                                                @for ($z = 1; $z < $estimacion; $z++)
                                                                    <option value="{{ $z }}">
                                                                        {{ $z }}
                                                                    </option>
                                                                @endfor
                                                            </select>
                                                            <label for="mayor">y</label>
                                                            <select name="mayor" id="mayor" class="form-control">
                                                                <option value=""></option>
                                                                @for ($z = 1; $z < $estimacion; $z++)
                                                                    <option value="{{ $z }}">
                                                                        {{ $z }}
                                                                    </option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="float-right">
                                                    <button type="submit" class="btn btn-link">
                                                        <i class="fas fa-file-export"></i> Exportar
                                                    </button>
                                                </div>
                                            </fieldset>
                                        </form>
                                        <div class="col-md-3"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <x-modals.confirm text="Agregar" idButton="button-destajo" />
    <div class="modal fade" id="modalEvidencias" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Evidencias</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <textarea name="comentario" id="comentario" cols="30" rows="10" class="form-control"
                        placeholder="Comentario"></textarea>
                    <input type="hidden" name="control_id" id="control_id">
                    <form action="{{ route('evidencia-control') }}" class="dropzone container" id="evidencias"
                        method="POST">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalVer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Evidencias</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="tabla_evidencia" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Imagen</th>
                                <th>Comentario</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('#campos').hide()

        function handleClick(radio) {
            if (radio.value == 2) {
                $('#campos').show()
            } else {
                $('#campos').hide()
            }
        }
        $("#button-destajo").click(function() {
            $("#button-destajo").prop('disabled', true);
            event.preventDefault();
            var lbl_id = document.querySelectorAll('input[id=lbl-id]')
            var lbl_cantidad = document.querySelectorAll('input[id=lbl-cantidad]')
            var lbl_importe = document.querySelectorAll('input[id=lbl-importe]')
            var formData = new FormData();
            lbl_id.forEach(element => {
                formData.append('control_id[]', element.value);
            });
            lbl_cantidad.forEach(element => {
                formData.append('cantidad[]', element.value);
            });
            lbl_importe.forEach(element => {
                formData.append('importe[]', element.value);
            });
            formData.append('contrato', "{{ $contrato->uid }}")
            $.ajax({
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                type: "POST",
                url: "{{ route('destajo-de-obras.store') }}",
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                success: function(event) {
                    toastr.success('Registro Agregado con exito.')
                    $("#confirm").modal("hide")
                    $("#button-destajo").prop('disabled', false);
                    window.location.href = "{{ route('control-de-obras.index') }}"
                },
                error: function(event) {
                    if (event.status == 419) {
                        window.parent.location.href = "{{ route('principal') }}"
                    }
                    if (event.status == 422) {
                        $.each(event.responseJSON.errors, function(i, error) {
                            toastr.warning(error[0])
                        });
                    }
                    $("#button-destajo").prop('disabled', false);
                }
            });
        });
        $(document).on('change', '#lbl-cantidad', function() {
            var acumulado = numeral($(this).closest('tr')[0].cells[8].innerHTML).value() +
                numeral($(this).closest('tr')[0].cells[6].children.cantidad.value).value()
            if (acumulado <= numeral($(this).closest('tr')[0].cells[3].innerHTML).value()) {
                $("#enviar-destajo").prop('disabled', false)
                var total = numeral($(this).closest('tr')[0].cells[4].innerHTML).value() *
                    numeral($(this).closest('tr')[0].cells[6].children.cantidad.value).value()
                $(this).closest('tr')[0].cells[7].children.importe.value = numeral(total).format('$0,0.00')
            } else {
                toastr.warning('La cantidad solicitada es mayor a la cantidad contratada')
                $("#enviar-destajo").prop('disabled', true)
            }
            if (numeral($(this).closest('tr')[0].cells[6].children.cantidad.value).value() != null) {
                $(this).css('color', 'red')
                $(this).closest('tr').css('color', 'red')
            } else {
                $(this).closest('tr').css('color', 'black')
                $(this).css('color', 'black')
            }
        });
        $('#modalEvidencias').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var modal = $(this)
            modal.find('.modal-content #control_id').val(button.data('control_id'))
        })
        var ver
        $('#modalVer').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var modal = $(this)
            ver = $('#tabla_evidencia').DataTable({
                ajax: {
                    type: 'GET',
                    url: '/api/definiciones/',
                    data: {
                        id: button.data('definiciones')
                    },
                },
                columns: [{
                        data: 'foto',
                        render: function(imagen) {
                            return '<img src="' + imagen + '" width="400px" />'
                        },
                        orderable: false,
                        searching: false
                    },
                    {
                        data: 'comentario'
                    },
                    {
                        data: 'created_at'
                    },
                ],
                language: {
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "Nada encontrado disculpa",
                    "info": "Mostrando la página _PAGE_ de _PAGES_",
                    "infoEmpty": "No records available",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)",
                    'search': 'Buscar:',
                    'paginate': {
                        'next': 'Siguiente',
                        'previous': 'Anterior'
                    }
                }
            })
        })
        $('#modalVer').on('hidden.bs.modal', function(event) {
            ver.destroy();
        });
        Dropzone.autoDiscover = false;
        $("#archivos").dropzone({
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            dictDefaultMessage: "Arrastre un archivo al recuadro para subirlo",
            acceptedFiles: "application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
            resizeHeight: 2048,
            maxFiles: 1,
            dictRemoveFile: "Remover Archivo",
            dictMaxFilesExceeded: "No puede Exceder de 10 archivos",
            dictFallbackMessage: "Tu explorador parece desactualizado, no soporta las funcionalidad, intenta con una versión mas actual",
            dictInvalidFileType: "Este tipo de Archivo no esta permitido",
            dictFileTooBig: "Este Archivo es muy grande, máximo permitido: 10 mb por archivo",
            maxFilesize: 10,
        });
        $("#evidencias").dropzone({
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            dictDefaultMessage: "Arrastre un archivo al recuadro para subirlo",
            acceptedFiles: "image/jpg,image/jpeg,image/png",
            resizeHeight: 2048,
            maxFiles: 10,
            dictRemoveFile: "Remover Archivo",
            dictMaxFilesExceeded: "No puede Exceder de 10 archivos",
            dictFallbackMessage: "Tu explorador parece desactualizado, no soporta las funcionalidad, intenta con una versión mas actual",
            dictInvalidFileType: "Este tipo de Archivo no esta permitido",
            dictFileTooBig: "Este Archivo es muy grande, máximo permitido: 10 mb por archivo",
            maxFilesize: 10,
            init: function() {
                var formData = new FormData();
                this.on("sending", function(file, xhr, formData) {
                    formData.append("comentario", $('#comentario').val());
                    formData.append("control_id", $('#control_id').val());
                });
            },
            error: function(file, message, xhr) {
                $(file.previewElement).remove();
            },
        });
    </script>
@stop
