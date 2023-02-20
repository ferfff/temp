@extends('adminlte::page')

@section('plugins.Switch', true)
@section('plugins.Select2', true)
@section('plugins.UI', true)
@section('plugins.Numeral', true)
@section('plugins.TagEditor', true)

@section('title', 'Contratos')

@section('content_header')
    {{ Breadcrumbs::render('contrato.update', $contrato) }}
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Editar Contrato</span>
                        <div class="float-right">
                            <label>Estado del Expediente</label>
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                data-target="#exampleModal">
                                <i class="fa fa-info-circle"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('contratos.update', $contrato) }}" role="form"
                            enctype="multipart/form-data" id="formulario-contrato" autocomplete="off"
                            onsubmit="return false;">
                            {{ method_field('PATCH') }}
                            <div class="box box-info padding-1">
                                <div class="box-body">
                                    @csrf
                                    @include('Catalogos.contrato.form')
                                </div>
                                <div class="box-footer mt20">
                                    <button type="button" class="btn btn-sm btn-primary" id="enviar-contrato">
                                        Guardar
                                    </button>
                                    <a href="{{ route('contratos.index') }}" class="btn btn-sm btn-default">Cancelar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <x-modals.confirm text="Editar" idButton="button-contrato" />
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Estado del expediente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <x-tables.table :headers="['Documento', 'Estado']">
                        @foreach ($documentos as $documento)
                            <x-tables.tr>
                                <x-tables.td>{{ $documento->nombre }}</x-tables.td>
                                <x-tables.td>
                                    @php
                                        $estado_expediente = in_array($documento->nombre, ['Presupuesto', 'Alta Siroc']) ? true : false;
                                        foreach ($expedientes->where('documento', $documento->id) as $value) {
                                            $estado_expediente = $value->condicion == 1 ? true : false;
                                        }
                                    @endphp
                                    @if ($estado_expediente || (!$documento->obligatorio && !$documento->solicita_aprobacion))
                                        <i class="fas fa-check text-success"></i>
                                    @else
                                        <i class="fas fa-times-circle text-danger"></i>
                                    @endif
                                </x-tables.td>
                            </x-tables.tr>
                        @endforeach
                    </x-tables.table>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('expedientes.show', $contrato) }}">Ver expediente</a>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $("#button-contrato").click(function() {
            $("#button-contrato").prop('disabled', true);
            event.preventDefault();
            $.ajax({
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                type: "PUT",
                url: "{{ route('contratos.update', $contrato) }}",
                dataType: 'json',
                data: {
                    folio: $("#folio").val(),
                    tipo: $("#tipo").bootstrapSwitch('state'),
                    cliente_id: $("#cliente_id").val(),
                    concepto_adenda: $("#concepto_adenda").val(),
                    descripcion_contrato: $("#descripcion_contrato").val(),
                    licencia: $("#licencia").val(),
                    fecha_firma: $("#fecha_firma").val(),
                    fecha_inicio: $("#fecha_inicio").val(),
                    fecha_termino: $("#fecha_termino").val(),
                    fecha_cierre_siroc: $("#fecha_cierre_siroc").val(),
                    importe_contratado: $("#importe_contratado").val(),
                    suministros: $("#suministros").val(),
                    total_contrato: $("#total_contrato").val(),
                    monto_anticipo: $("#monto_anticipo").val(),
                    porcentaje_amortizacion_anticipo: $("#porcentaje_amortizacion_anticipo").val(),
                    porcentaje_retencion: $("#porcentaje_retencion").val(),
                    permite_deductivas: $("#permite_deductivas").bootstrapSwitch('state'),
                    permite_aditivas: $("#permite_aditivas").bootstrapSwitch('state'),
                    estado_id: $("#estado_id").val(),
                    municipio_id: $("#municipio_id").val(),
                    localidad: $("#localidad").val(),
                    codigo_postal: $("#codigo_postal").val(),
                    colonia: $("#colonia").val(),
                    calle: $("#calle").val(),
                    no_ext: $("#no_ext").val(),
                    no_int: $("#no_int").val(),
                    referencia: $("#referencia").val(),
                },
                success: function(event) {
                    toastr.success('Registro Modificado con exito.')
                    $("#confirm").modal("hide")
                    $("#button-cliente").prop('disabled', false);
                    window.location.href = "{{ route('contratos.index') }}"
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
                    $("#button-cliente").prop('disabled', false);
                }
            });
        });
        $("#enviar-contrato").on("click", function(e) {
            if ($('#formulario-contrato').valid()) {
                $("#confirm").modal("show");
            }
        });
        $(document).ready(function() {
            var porcentaje = numeral($('#porcentaje_retencion').val() / 100);
            numeral.defaultFormat('0.0%')
            $('#porcentaje_retencion').val(porcentaje.format())
            porcentaje = numeral($('#porcentaje_amortizacion_anticipo').val() / 100);
            $('#porcentaje_amortizacion_anticipo').val(porcentaje.format())

            var numero = numeral($('#importe_contratado').val())
            numeral.defaultFormat('$0,0.00')
            $('#importe_contratado').val(numero.format())
            numero = numeral($('#suministros').val())
            $('#suministros').val(numero.format())
            numero = numeral($('#total_contrato').val())
            $('#total_contrato').val(numero.format())
            numero = numeral($('#monto_anticipo').val())
            $('#monto_anticipo').val(numero.format())
            $.ajax({
                url: "/api/contrato-presupuesto/",
                type: "GET",
                dataType: "json",
                data: $('.select-cliente').serialize(),
            })
        });
        document.querySelector('#porcentaje_retencion').addEventListener('change', (e) => {
            var number = numeral(e.target.value / 100);
            numeral.defaultFormat('0.0%')
            e.target.value = number.format()
        })
        document.querySelector('#porcentaje_amortizacion_anticipo').addEventListener('change', (e) => {
            var number = numeral(e.target.value / 100);
            numeral.defaultFormat('0.0%')
            e.target.value = number.format()
        })
        document.querySelector('#importe_contratado').addEventListener('change', (e) => {
            var number = numeral(e.target.value);
            numeral.defaultFormat('$0,0.00')
            e.target.value = number.format()


            var total = numeral(parseFloat(number.value()) -
                parseFloat(numeral($('#suministros').val()).value())).format('$0,0.00')
            $('#total_contrato').val(total)
        })
        document.querySelector('#suministros').addEventListener('change', (e) => {
            var number = numeral(e.target.value);
            numeral.defaultFormat('$0,0.00')
            e.target.value = number.format()

            var total = numeral(parseFloat(numeral($('#importe_contratado').val()).value()) -
                parseFloat(number.value())).format('$0,0.00')
            $('#total_contrato').val(total)
        })
        document.querySelector('#monto_anticipo').addEventListener('change', (e) => {
            var number = numeral(e.target.value);
            numeral.defaultFormat('$0,0.00')
            e.target.value = number.format()
        })

        document.addEventListener('DOMContentLoaded', e => {
            for (let checkbox of document.querySelectorAll('input[type=checkbox]')) {
                checkbox.value = checkbox.checked ? 1 : 0;
                checkbox.addEventListener('change', e => {
                    e.target.value = e.target.checked ? 1 : 0;
                });
            }
        });
        $('#permite_deductivas').bootstrapSwitch({
            onText: "Si",
            offText: 'No'
        });
        $('#permite_aditivas').bootstrapSwitch({
            onText: "Si",
            offText: 'No'
        });
        $('#tipo').bootstrapSwitch({
            onText: "Urbanizacion",
            offText: 'Edificacion'
        });
        $('.select-cliente').autocomplete({
            source: function(request, response) {
                minLength: 1,
                $.ajax({
                    url: "/api/contratos-clientes/",
                    type: "GET",
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function(data) {
                        response($.map(data, function(value, key) {
                            return {
                                label: value,
                                value: value
                            }
                        }))
                    }
                })
            },
            change: function(e, ui) {
                //console.log("ui", ui)
                if (!ui.item) {
                    $(this).val("");
                }
            }
        });
        $('.select_estado').select2({
            width: '100%',
        });
        $('.select_municipio').select2({
            width: '100%',
        });
        $('.select_cp').autocomplete({
            source: function(request, response) {
                minLength: 1,
                $.ajax({
                    url: "/api/contratos-cp/",
                    type: "GET",
                    dataType: "json",
                    data: {
                        search: request.term,
                        municipio: $('#municipio_id').val()
                    },
                    success: function(data) {
                        response($.map(data, function(value, key) {
                            return {
                                label: value,
                                value: value
                            }
                        }))
                    }
                })
            },
            change: function(e, ui) {
                //console.log("ui", ui)
                if (!ui.item) {
                    $(this).val("");
                }
            }
        });
        $('.select_colonia').autocomplete({
            source: function(request, response) {
                minLength: 1,
                $.ajax({
                    url: "/api/contratos-colonias/",
                    type: "GET",
                    dataType: "json",
                    data: {
                        search: request.term,
                        municipio: $('#municipio_id').val(),
                        cp: $('#codigo_postal').val()
                    },
                    success: function(data) {
                        response($.map(data, function(value, key) {
                            return {
                                label: value,
                                value: value
                            }
                        }))
                    }
                })
            },
            change: function(e, ui) {
                //console.log("ui", ui)
                if (!ui.item) {
                    $(this).val("");
                }
            }
        });
        $(document).ready(function() {
            var id_estado = $('.select_estado').val()
            $.get('/api/contratos-municipios/' + id_estado, function(data) {
                var html_select = '<option value="">Seleccione un municipio</option>';
                for (var i = 0; i < data.length; ++i)
                    html_select += '<option value="' + data[i].id + '">' + data[i].nombre +
                    '</option>';
                $('.select_municipio').html(html_select);
                $(".select_municipio").val({{ $contrato->municipio_id }})
            });
        });

        $('.select_estado').on('change', function() {
            var id_estado = $(this).val()
            $.get('/api/contratos-municipios/' + id_estado, function(data) {
                var html_select = '<option value="">Seleccione un municipio</option>';
                for (var i = 0; i < data.length; ++i)
                    html_select += '<option value="' + data[i].id + '">' + data[i].nombre +
                    '</option>';
                $('.select_municipio').html(html_select);
            });
        });
        $.validator.addMethod("minValue", function(value, element) {
            var number = numeral(value);
            return number.value() >= 0
        }, function(value, element) {
            var number = numeral(value);
            if (!number.value() > 0) {
                return 'Este campo no puede ser menor'
            }
        });
        $.validator.addMethod("maxValue", function(value, element) {
            var number = numeral(value);
            return number.value() < 1
        }, function(value, element) {
            var number = numeral(value);
            if (!number.value() < 1) {
                return 'Este campo no puede ser mayor o igual a cien'
            }
        });
        $.validator.addMethod("minFecha", function(value, element) {
                return Date.parse($('#fecha_firma').val()) < Date.parse($('#fecha_cierre_siroc').val())
            },
            function(value, element) {
                if (!Date.parse($('#fecha_firma').val()) < Date.parse($('#fecha_cierre_siroc').val())) {
                    return 'Este campo no puede ser menor a la fecha de firma'
                }
            });
        $.validator.addMethod("maxMonto", function(value, element) {
            var number = numeral(value);
            total = numeral($('#total_contrato').val()).value() - number.value()
            return total >= 0 ? 1 : 0
        }, function(value, element) {
            var number = numeral(value);
            total = numeral($('#total_contrato').val()).value() - number.value()
            if (!total >= 0) {
                return 'Este campo no puede igual o mayor al total del contrato'
            }
        });
        $('#formulario-contrato').validate({
            rules: {
                folio: {
                    required: true,
                    maxlength: 50,
                },
                cliente_id: {
                    required: true
                },
                fecha_firma: {
                    required: true
                },
                fecha_inicio: {
                    required: true
                },
                fecha_cierre_siroc: {
                    minFecha: true
                },
                fecha_termino: {
                    required: true
                },
                importe_contratado: {
                    required: true,
                },
                suministros: {
                    required: true,
                },
                total_contrato: {
                    required: true,
                    minValue: true
                },
                monto_anticipo: {
                    required: true,
                    maxMonto: true
                },
                porcentaje_amortizacion_anticipo: {
                    required: true,
                    minValue: true,
                    maxValue: true
                },
                concepto_adenda: {
                    required: true,
                    maxlength: 500,
                },
                descripcion_contrato: {
                    required: true,
                    maxlength: 10000,
                },
                licencia: {
                    required: true,
                    maxlength: 50,
                },
                calle: {
                    required: true,
                    maxlength: 50,
                },
                no_ext: {
                    required: true,
                    maxlength: 6,
                },
                no_int: {
                    maxlength: 6,
                },
                colonia: {
                    required: true,
                    maxlength: 50,
                },
                localidad: {
                    required: true,
                    maxlength: 50,
                },
                referencia: {
                    maxlength: 200,
                },
                municipio_id: {
                    required: true
                },
                estado_id: {
                    required: true
                },
                codigo_postal_id: {
                    required: true
                },
                porcentaje_retencion: {
                    required: true,
                    minValue: true,
                    maxValue: true
                },
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass("is-invalid").removeClass("is-valid");
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).addClass("is-valid").removeClass("is-invalid");
            },
            invalidHandler: function(event, validator) {
                if (validator.numberOfInvalids()) {
                    ion.sound.play("error");
                }
            },
            errorClass: "invalid-tooltip"
        })
    </script>
@stop
