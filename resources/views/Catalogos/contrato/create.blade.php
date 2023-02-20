@extends('adminlte::page')

@section('plugins.Switch', true)
@section('plugins.Select2', true)
@section('plugins.UI', true)
@section('plugins.Numeral', true)
@section('plugins.TagEditor', true)
@section('plugins.fileinput', true)

@section('title', 'Contratos')

@section('content_header')
    {{ Breadcrumbs::render('contrato.store') }}
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Agregar Contrato</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('contratos.store') }}" role="form"
                            enctype="multipart/form-data" id="formulario-contrato" autocomplete="off"
                            onsubmit="return false;">
                            @csrf
                            <div class="box box-info padding-1">
                                <div class="box-body">
                                    @include('Catalogos.contrato.form')
                                    <div class="form-group position-relative">
                                        <label for="archivo">Contrato</label>
                                        <input type="file" name="archivo" id="archivo">
                                    </div>
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
    <x-modals.confirm text="Agregar" idButton="button-contrato" />
@stop

@section('js')
    <script>
        $("#archivo").fileinput({
            language: "es",
            'showUpload': false,
        });
        $("#button-contrato").click(function() {
            $("#button-contrato").prop('disabled', true);
            event.preventDefault();
            var formData = new FormData();
            formData.append('folio', $("#folio").val());
            formData.append('tipo', $("#tipo").bootstrapSwitch('state'));
            formData.append('cliente_id', $("#cliente_id").val());
            formData.append('concepto_adenda', $("#concepto_adenda").val());
            formData.append('descripcion_contrato', $("#descripcion_contrato").val());
            formData.append('licencia', $("#licencia").val());
            formData.append('fecha_firma', $("#fecha_firma").val());
            formData.append('fecha_inicio', $("#fecha_inicio").val());
            formData.append('fecha_termino', $("#fecha_termino").val());
            formData.append('fecha_cierre_siroc', $("#fecha_cierre_siroc").val());
            formData.append('importe_contratado', $("#importe_contratado").val());
            formData.append('suministros', $("#suministros").val());
            formData.append('total_contrato', $("#total_contrato").val());
            formData.append('monto_anticipo', $("#monto_anticipo").val());
            formData.append('porcentaje_amortizacion_anticipo', $("#porcentaje_amortizacion_anticipo").val());
            formData.append('porcentaje_retencion', $("#porcentaje_retencion").val());
            formData.append('permite_deductivas', $("#permite_deductivas").bootstrapSwitch('state'));
            formData.append('permite_aditivas', $("#permite_aditivas").bootstrapSwitch('state'));
            formData.append('estado_id', $("#estado_id").val());
            formData.append('municipio_id', $("#municipio_id").val());
            formData.append('localidad', $("#localidad").val());
            formData.append('codigo_postal', $("#codigo_postal").val());
            formData.append('colonia', $("#colonia").val());
            formData.append('calle', $("#calle").val());
            formData.append('no_ext', $("#no_ext").val());
            formData.append('no_int', $("#no_int").val());
            formData.append('referencia', $("#referencia").val());
            formData.append('base', $("#base").val());
            formData.append('folio_base', $("#folio_base").val());
            if ($('#archivo')[0].files.length) {
                formData.append('archivo', $("#archivo")[0].files[0]);
            }
            $.ajax({
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                type: "POST",
                url: "{{ route('contratos.store') }}",
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                success: function(event) {
                    toastr.success('Registro Agregado con exito.')
                    $("#confirm").modal("hide")
                    $("#button-contrato").prop('disabled', false);
                    window.location.href = "{{ route('contratos.index') }}"
                },
                error: function(event) {
                    if (event.status == 422) {
                        if (event.status == 419) {
                            window.parent.location.href = "{{ route('principal') }}"
                        }
                        $.each(event.responseJSON.errors, function(i, error) {
                            toastr.warning(error[0])
                        });
                    }
                    $("#button-contrato").prop('disabled', false);
                }
            });
        });
        $("#enviar-contrato").on("click", function(e) {
            if ($('#formulario-contrato').valid()) {
                $("#confirm").modal("show");
            }
        });
        $('#base').on('change', function() {
            $.get('/api/contrato-base/' + $(this).val(), function(data) {
                var html_select = '<option value="">Seleccione una base</option>';
                for (var i = 0; i < data.length; ++i)
                    html_select += '<option value="' + data[i].id + '">[' + data[i].folio + '] - ' + data[i]
                    .razon_social + '</option>';
                $('#folio_base').html(html_select);
            });
            if ($('#base').val() == 'PostVenta') {
                $('#folio').prop("readonly", false)
                $('#folio').val("")
                $('#cliente_id').prop("readonly", false)
                $('#cliente_id').val("")
                $('#fecha_firma').prop("readonly", false)
                $('#fecha_firma').val("")
                $('#fecha_cierre_siroc').prop("readonly", false)
                $('#fecha_cierre_siroc').val("")
                $('#div_folio_base').hide()
                $('#div_folio').show()
            } else {
                $('#div_folio_base').show()
                $('#div_folio').hide()
            }
        });
        $('#folio_base').on('change', function() {
            $.get('/api/contrato-datos/' + $('#base').val() + '/' + $(this).val(), function(data) {
                $('#folio').val(data.folio)
                $('#cliente_id').val(data.razon_social)
                $('#fecha_firma').val(data.fecha_firma)
                $('#fecha_cierre_siroc').val(data.fecha_cierre_siroc)
                var number = numeral(data.monto);
                numeral.defaultFormat('$0,0.00')
                $('#importe_contratado').val(number.format())
                $('#descripcion_contrato').val(data.descripcion)
                if ($('#base').val() != 'PostVenta') {
                    $('#folio').prop("readonly", true)
                    $('#cliente_id').prop("readonly", true)
                    if ($('#fecha_firma').val() != "") {
                        $('#fecha_firma').prop("readonly", true)
                    }
                    if ($('#fecha_cierre_siroc').val() != "") {
                        $('#fecha_cierre_siroc').prop("readonly", true)
                    }
                }
            });
        });
        $('.select-cliente').on('change', function() {
            $.ajax({
                url: "/api/contrato-presupuesto/",
                type: "GET",
                dataType: "json",
                data: $(this).serialize(),
            })
        })
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
            language: {
                noResults: function() {
                    return "No se encontraton resultados";
                }
            }
        });
        $('.select_municipio').select2({
            width: '100%',
            language: {
                noResults: function() {
                    return "No se encontraton resultados";
                }
            }
        });
        $('#folio_base').select2({
            width: '100%',
            language: {
                noResults: function() {
                    return "No se encontraton resultados";
                }
            }
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
                    html_select += '<option value="' + data[i].id + '">' + data[i].nombre + '</option>';
                $('.select_municipio').html(html_select);
                $('.select_municipio').attr('disabled', false)
            });
        });

        $('.select_estado').on('change', function() {
            var id_estado = $(this).val()
            $.get('/api/contratos-municipios/' + id_estado, function(data) {
                var html_select = '<option value="">Seleccione un municipio</option>';
                for (var i = 0; i < data.length; ++i)
                    html_select += '<option value="' + data[i].id + '">' + data[i].nombre + '</option>';
                $('.select_municipio').html(html_select);
                $('.select_municipio').attr('disabled', false)
            });
        });
        $.validator.addMethod("minFecha", function(value, element) {
                return Date.parse($('#fecha_firma').val()) < Date.parse($('#fecha_cierre_siroc').val())
            },
            function(value, element) {
                if (!Date.parse($('#fecha_firma').val()) < Date.parse($('#fecha_cierre_siroc').val())) {
                    return 'Este campo no puede ser menor a la fecha de firma'
                }
            });
        $.validator.addMethod("minValue", function(value, element) {
            var number = numeral(value);
            return number.value() >= 0
        }, function(value, element) {
            var number = numeral(value);
            if (!number.value() >= 0) {
                return 'Este campo no puede ser menor a cero'
            }
        });
        $.validator.addMethod("maxValue", function(value, element) {
            var number = numeral(value);
            return number.value() < 1
        }, function(value, element) {
            var number = numeral(value);
            if (!number.value() <= 1) {
                return 'Este campo no puede ser mayor o igual a cien'
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
                    required: function(element) {
                        return $("#base").val() != "Siroc"
                    }
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
                monto_anticipo: {
                    required: true,
                    maxMonto: true
                },
                importe_contratado: {
                    required: true,
                    minValue: true
                },
                suministros: {
                    required: true,
                },
                total_contrato: {
                    required: true,
                    minValue: true
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
                codigo_postal: {
                    required: true
                },
                porcentaje_retencion: {
                    required: true,
                    minValue: true,
                    maxValue: true
                },
                base: {
                    required: true
                },
                folio_base: {
                    required: function(element) {
                        return $("#base").val() != 'PostVenta'
                    }
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
