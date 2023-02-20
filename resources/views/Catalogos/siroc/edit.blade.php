@extends('adminlte::page')

@section('plugins.UI', true)
@section('plugins.fileinput', true)

@section('title', 'Siroc')

@section('content_header')
    {{ Breadcrumbs::render('siroc.update', $siroc) }}
@stop

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Editar Siroc</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('sirocs.update', $siroc) }}" role="form" id="formulario-siroc"
                            enctype="multipart/form-data">
                            <div class="box box-info padding-1">
                                <div class="box-body">
                                    {{ method_field('PATCH') }}
                                    @csrf
                                    @include('catalogos.siroc.form')
                                    <div class="form-group position-relative">
                                        <label for="comentario">Comentario</label>
                                        <textarea name="comentario" id="comentario-danger" class="form-control"></textarea>
                                    </div>
                                    <div class="box-footer mt20 mb-4">
                                        <button type="button" class="btn btn-sm btn-primary"
                                            id="enviar-siroc">Guardar</button>
                                        <a href="{{ route('sirocs.index') }}" class="btn btn-sm btn-default">Cancelar</a>
                                    </div>
                                    @if (count($siroc->bitacora) > 0)
                                        <x-tables.table :headers="['Usuario', 'Accion', 'Comentario']">
                                            @foreach ($siroc->bitacora as $bitacora)
                                                <tr>
                                                    <x-tables.td>{{ $bitacora->user }}</x-tables.td>
                                                    <x-tables.td>{{ $bitacora->accion }}</x-tables.td>
                                                    <x-tables.td>{{ $bitacora->comentario }}</x-tables.td>
                                                </tr>
                                            @endforeach
                                        </x-tables.table>
                                    @endif
                                </div>
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
    <x-modals.confirm text="Editar" idButton="button-siroc" />
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
            formData.append('comentario', $("#comentario-danger").val());
            formData.append("_method", "PUT");
            $.ajax({
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                type: "POST",
                url: "{{ route('sirocs.update', $siroc) }}",
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                success: function(event) {
                    toastr.success('Registro Modificado con exito.')
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
            if ($('#formulario-siroc').valid()) {
                $("#confirm").modal("show");
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
                fecha_firma: {
                    required: true
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
        $('#presupuesto').autocomplete({
            source: function(request, response) {
                minLength: 1,
                $.ajax({
                    url: '/api/presupuestos-siroc',
                    type: "GET",
                    dataType: "json",
                    data: {
                        term: request.term
                    },
                    success: function(data) {
                        response($.map(data, function(item) {
                            return {
                                label: item.folio,
                                value: item.folio
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
        WebViewer({
                path: "{{ asset('WebViewer/lib') }}",
                initialDoc: '{{ asset("$siroc->archivo") }}',
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
