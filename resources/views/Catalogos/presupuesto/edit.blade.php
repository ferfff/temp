@extends('adminlte::page')

@section('plugins.UI', true)
@section('plugins.Numeral', true)
@section('plugins.fileinput', true)

@section('title', 'Presupuestos')

@section('content_header')
    {{ Breadcrumbs::render('presupuesto.update', $presupuesto) }}
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Editar Presupuesto</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('presupuestos.update', $presupuesto) }}" role="form"
                            id="formulario-presupuesto" enctype="multipart/form-data" autocomplete="off">
                            {{ method_field('PATCH') }}
                            @csrf
                            <div class="box box-info padding-1">
                                <div class="box-body">
                                    @include('catalogos.presupuesto.form')
                                    <div class="form-group position-relative">
                                        <label for="comentario">Comentario</label>
                                        <textarea name="comentario" id="comentario-danger" class="form-control"></textarea>
                                    </div>
                                    <div class="box-footer mt20 mb-4">
                                        <button type="button" class="btn btn-sm btn-primary"
                                            id="enviar-presupuesto">Guardar</button>
                                        <a href="{{ route('presupuestos.index') }}"
                                            class="btn btn-sm btn-default">Cancelar</a>
                                    </div>
                                </div>
                                @if (count($presupuesto->bitacora) > 0)
                                    <x-tables.table :headers="['Usuario', 'Accion', 'Comentario']">
                                        @foreach ($presupuesto->bitacora as $bitacora)
                                            <tr>
                                                <x-tables.td>{{ $bitacora->user }}</x-tables.td>
                                                <x-tables.td>{{ $bitacora->accion }}</x-tables.td>
                                                <x-tables.td>{{ $bitacora->comentario }}</x-tables.td>
                                            </tr>
                                        @endforeach
                                    </x-tables.table>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 h-auto d-inline-block">
            <div id='viewer' style='width: 1024px; height: 600px; margin: 0 auto;'></div>
        </div>
    </section>
    <x-modals.confirm text="Editar" idButton="button-presupuesto" />
@stop

@section('js')
    <script src="{{ asset('webviewer/lib/webviewer.min.js') }}"></script>
    <script>
        $('#archivo').on('fileloaded', function(event, file, index, reader) {
            $('.file-error-message').hide()
            $('.file-caption-name').removeClass("is-invalid").addClass("is-valid");
        });
        $("#archivo").fileinput({
            language: "es",
            showUpload: false,
            allowedFileExtensions: ["pdf", "png", "jpeg", "xlsx", "docx", "pptx"],
            maxFileSize: 5000,
            required: true
        });
        $(document).ready(function() {
            var _number = numeral($('#monto').val());
            numeral.defaultFormat('$0,0.00')
            $('#monto').val(_number.format())
        });
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
            formData.append('comentario', $("#comentario-danger").val());
            formData.append("_method", "PUT");
            $.ajax({
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                type: "POST",
                url: "{{ route('presupuestos.update', $presupuesto) }}",
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                success: function(event) {
                    toastr.success('Registro Modificado con exito.')
                    $("#confirm").modal("hide")
                    $("#button-presupuesto").prop('disabled', false);
                    window.location.href = "{{ route('presupuestos.index') }}"
                },
                error: function(event) {
                    if (event.status == 419) {
                        window.parent.location.href = "{{ route('principal') }}"
                    }
                    if (event.status == 422) {
                        $.each(event.responseJSON.errors, function(i, error) {
                            toastr.warning(error[0])
                        });
                        $('#confirm').modal('toggle')
                    }
                    $("#button-presupuesto").prop('disabled', false);
                }
            });
        });
        $("#enviar-presupuesto").on("click", function(e) {
            if ($('#formulario-presupuesto').valid()) {
                $("#confirm").modal("show");
            }
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
                comentario: {
                    required: true
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
        WebViewer({
                path: "{{ asset('WebViewer/lib') }}",
                initialDoc: '{{ asset("$presupuesto->archivo") }}',
            }, document.getElementById('viewer'))
            .then(instance => {
                const {
                    documentViewer,
                    annotationManager
                } = instance.Core;

                documentViewer.addEventListener('documentLoaded', () => {

                });
            });
    </script>
@stop
