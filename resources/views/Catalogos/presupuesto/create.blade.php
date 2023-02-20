@extends('adminlte::page')

@section('plugins.UI', true)
@section('plugins.Numeral', true)
@section('plugins.fileinput', true)

@section('title', 'Presupuestos')

@section('content_header')
    {{ Breadcrumbs::render('presupuesto.store') }}
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Agregar Presupuesto</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('presupuestos.store') }}" role="form"
                            id="formulario-presupuesto" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <div class="box box-info padding-1">
                                <div class="box-body">
                                    @include('catalogos.presupuesto.form')
                                </div>
                                <div class="box-footer mt20">
                                    <button type="button" class="btn btn-sm btn-primary"
                                        id="enviar-presupuesto">Guardar</button>
                                    <a href="{{ route('presupuestos.index') }}" class="btn btn-sm btn-default">Cancelar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <x-modals.confirm text="Agregar" idButton="button-presupuesto" />
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
                    <button type="button" class="btn btn-primary" id="button-vincular">Guardar</button>
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
            $.get('/api/presupuesto-datos/' + $("#folio").val(), function(data) {
                $('#folio').val(data.folio)
                $('#cliente_id').val(data.razon_social)
            });
            $('#modal-vincular').modal('hide');
        })
        $('#button-cancelar').click(function(event) {
            $("#folio").val('')
            $('#cliente_id').val('')
            $('#folio').prop("readonly", false)
            $('#cliente_id').prop("readonly", false)
        })
        $("#folio").focusout(function(event) {
            $.ajax({
                type: "GET",
                url: '/api/siroc-folio-presupuesto',
                data: {
                    term: event.target.value
                },
                success: function(data) {
                    if (Object.keys(data).length > 0) {
                        if (data[0].contrato == null && data[0].presupuesto == null) {
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
        $("#archivo").fileinput({
            language: "es",
            showUpload: false,
            allowedFileExtensions: ["pdf", "png", "jpeg", "xlsx", "docx", "pptx"],
            maxFileSize: 5000,
            required: true
        });
        $('#cliente_id').autocomplete({
            source: function(request, response) {
                minLength: 1,
                $.ajax({
                    url: "/api/presupuesto-clientes/",
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
        document.querySelector('#monto').addEventListener('change', (e) => {
            var number = numeral(e.target.value);
            numeral.defaultFormat('$0,0.00')
            e.target.value = number.format()
        })
        $("#button-presupuesto").click(function() {
            //$("#formulario-presupuesto").submit();
            $("#button-presupuesto").prop('disabled', true);
            event.preventDefault();
            var formData = new FormData();
            formData.append('folio', $("#folio").val());
            formData.append('cliente_id', $("#cliente_id").val());
            formData.append('fecha_recepcion', $("#fecha_recepcion").val());
            formData.append('monto', $("#monto").val());
            formData.append('descripcion', $("#descripcion").val());
            formData.append('archivo', $("#archivo")[0].files[0]);
            $.ajax({
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                type: "POST",
                url: "{{ route('presupuestos.store') }}",
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                success: function(event) {
                    toastr.success('Registro Agregado con exito.')
                    $("#confirm").modal("hide")
                    $("#button-presupuesto").prop('disabled', false);
                    window.location.href = "{{ route('presupuestos.index') }}"
                },
                error: function(event) {
                    if (event.status == 419) {
                        window.parent.location.href = "{{ route('principal') }}"
                    }
                    if (event.status == 422) {
                        $('#confirm').modal('toggle')
                        $.each(event.responseJSON.errors, function(i, error) {
                            toastr.warning(error[0])
                        });
                    }
                    $("#button-presupuesto").prop('disabled', false);
                }
            });
        });
        $("#enviar-presupuesto").on("click", function(e) {
            if ($('#archivo').fileinput('getFilesCount') == 0) {
                toastr.info('Suba un archivo')
            }
            if ($('#formulario-presupuesto').valid()) {
                $("#confirm").modal("show");
            }
        });
        $('#formulario-presupuesto').validate({
            rules: {
                folio: {
                    maxlength: 150,
                },
                descripcion: {
                    maxlength: 4000,
                },
                cliente_id: {
                    required: true,
                },
                monto: {
                    required: true,
                },
                fecha_recepcion: {
                    required: true,
                },
                archivo: {
                    required: true,
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
    </script>
@stop
