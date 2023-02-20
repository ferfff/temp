@extends('adminlte::page')

@section('plugins.UI', true)
@section('plugins.fileinput', true)

@section('title', 'Siroc')

@section('content_header')
    {{ Breadcrumbs::render('siroc.store') }}
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Agregar Siroc</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('sirocs.store') }}" role="form" id="formulario-siroc"
                            enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <div class="box box-info padding-1">
                                <div class="box-body">
                                    <div class="row col-md 12">
                                        @include('catalogos.siroc.form')
                                    </div>
                                    <div class="box-footer mt20">
                                        <button type="button" class="btn btn-sm btn-primary"
                                            id="enviar-siroc">Guardar</button>
                                        <a href="{{ route('sirocs.index') }}" class="btn btn-sm btn-default">Cancelar</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <x-modals.confirm text="Agregar" idButton="button-siroc" />
    <div class="modal fade" id="modal-presupuesto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Presupuesto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label>Este folio ya esta registrado y el presupuesto ya esta asociado a un siroc/contrato</label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-vincular" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Vincular</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label>¿Quieres vincular el registro?</label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"
                        id="button-cancelar">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="button-vincular">Vincular</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $('#archivo').on('fileloaded', function(event, file, index, reader) {
            $('.file-error-message').hide()
            $('.file-caption-name').removeClass("is-invalid").addClass("is-valid");
        });
        $('#button-vincular').click(function(event) {
            $.get('/api/siroc-datos/' + $('#folio').val(), function(data) {
                $('#folio').val(data.folio)
                $('#cliente_id').val(data.razon_social)
            }).done(function() {
                $('#folio').prop("readonly", true)
                $('#cliente_id').prop("readonly", true)
                $('#modal-vincular').modal('hide');
            });
        })
        $('#button-cancelar').click(function(event) {
            $("#folio").val('')
            $('#cliente_id').val('')
            $('#folio').prop("readonly", false)
            $('#cliente_id').prop("readonly", false)
        })
        $("#archivo").fileinput({
            language: "es",
            showUpload: false,
            allowedFileExtensions: ["pdf", "png", "jpeg", "xlsx", "docx", "pptx"],
            maxFileSize: 5000,
            required: true
        });
        $("#button-siroc").click(function() {
            //$("#formulario-siroc").submit();
            $("#button-siroc").prop('disabled', true);
            event.preventDefault();
            var formData = new FormData();
            formData.append('folio', $("#folio").val());
            formData.append('cliente_id', $("#cliente_id").val());
            formData.append('presupuesto_id', $("#presupuesto").val());
            formData.append('imss', $("#imss").val());
            formData.append('descripcion', $("#descripcion").val());
            formData.append('archivo', $("#archivo")[0].files[0]);
            formData.append('fecha_firma', $("#fecha_firma").val());
            formData.append('fecha_cierre_siroc', $("#fecha_cierre_siroc").val());
            $.ajax({
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                type: "POST",
                url: "{{ route('sirocs.store') }}",
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                success: function(event) {
                    toastr.success('Registro Agregado con exito.')
                    $("#confirm").modal("hide")
                    $("#button-siroc").prop('disabled', false);
                    window.location.href = "{{ route('sirocs.index') }}"
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
                    $("#button-siroc").prop('disabled', false);
                }
            });
        });
        $("#enviar-siroc").on("click", function(e) {
            if ($('#archivo').fileinput('getFilesCount') == 0) {
                toastr.info('Suba un archivo')
            }
            if ($('#formulario-siroc').valid()) {
                $("#confirm").modal("show");
            }
        });
        $('#cliente_id').autocomplete({
            source: function(request, response) {
                minLength: 1,
                $.ajax({
                    url: "/api/siroc-clientes/",
                    type: "GET",
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function(data) {
                        response($.map(data, function(item) {
                            return {
                                label: item.razon_social,
                                value: item.razon_social
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
        $.validator.addMethod("minFecha", function(value, element) {
                return Date.parse($('#fecha_firma').val()) < Date.parse($('#fecha_cierre_siroc').val())
            },
            function(value, element) {
                if (!(Date.parse($('#fecha_firma').val()) < Date.parse($('#fecha_cierre_siroc').val()))) {
                    return 'Este campo no puede ser menor o igual a la fecha de firma'
                }
            });
        $('#formulario-siroc').validate({
            rules: {
                folio: {
                    maxlength: 150,
                    required: function(element) {
                        return $("#presupuesto").val() != "";
                    }
                },
                descripcion: {
                    maxlength: 4000,
                },
                cliente_id: {
                    required: function(element) {
                        return $("#presupuesto").val() != "";
                    },
                },
                monto: {
                    required: true,
                },
                imss: {
                    required: true,
                },
                archivo: {
                    required: true
                },
                fecha_firma: {
                    required: true
                },
                fecha_cierre_siroc: {
                    minFecha: true
                }
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
        $("#folio").focusout(function(event) {
            $.ajax({
                type: "GET",
                url: '/api/presupuestos-siroc',
                data: {
                    term: event.target.value
                },
                success: function(data) {
                    if (Object.keys(data).length > 0) {
                        if (data[0].contrato == null && data[0].siroc == null) {
                            $('#enviar-siroc').prop('disabled', false);
                            $('#modal-vincular').modal('show')
                        } else {
                            $("#folio").val('')
                            $('#cliente_id').val('')
                            $('#folio').prop("readonly", false)
                            $('#cliente_id').prop("readonly", false)
                            $('#modal-presupuesto').modal('show')
                        }
                    }
                }
            });
        })
    </script>
@stop
