@extends('adminlte::page')

@section('plugins.UI', true)
@section('plugins.Numeral', true)
@section('plugins.Dropzone', true)
@section('plugins.Switch', true)
@section('plugins.Datatables', true)

@section('title', 'Control de Obra')

@section('content_header')
    {{ Breadcrumbs::render('control-de-obras.show', $contrato) }}
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">
                                Agregar Control de Obra a: {{ $contrato->folio }} /
                                <small> {{ $contrato->cliente->razon_social }}</small>
                            </span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-secondary" href="{{ route('contratos.index') }}"> Regresar</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-three-tabContent">
                            <div class="tab-pane fade active show" id="custom-tabs-three-Partidas" role="tabpanel"
                                aria-labelledby="custom-tabs-three-Partidas-tab">
                                <table class="table table-striped table-bordered table-hover" id="table">
                                    <thead>
                                        <th></th>
                                        <th>Codigo</th>
                                        <th>Grupo</th>
                                        <th>Clave</th>
                                        <th>Partida</th>
                                        <th>Unidad</th>
                                        <th>Cantidad</th>
                                        <th>Precio Unitario</th>
                                        <th>Importe</th>
                                        <th>Evidencias</th>
                                    </thead>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-three-Importar" role="tabpanel"
                                aria-labelledby="custom-tabs-three-Importar-tab">
                                <div class="row">
                                    <div class="col-md-1">
                                        <form action="{{ route('definicion-control-obra', $contrato->uid) }}"
                                            method="get">
                                            @csrf
                                            <button type="submit" class="btn btn-link">Descargar Plantilla</button>
                                        </form>
                                    </div>
                                    <div class="col-md-11">
                                        <form action="{{ route('importar-control_obra') }}" class="dropzone container"
                                            id="dropzone" method="POST" enctype="multipart/form-data">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <x-modals.confirm text="Agregar" idButton="button-partida" />
    <div class="modal fade" id="modal-eliminar-partida" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('control-de-obras.destroy', 1) }}" method="post"></form>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Eliminar</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label>¿Quieres eliminar el registro?</label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="button-eliminar-partida">Guardar</button>
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
    @if (count((array) $contrato->control) > 0)
        <script>
            var partida_id
            $('#modal-eliminar-partida').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var modal = $(this)
                partida_id = button.data('id')
            })
            $('#button-eliminar-partida').click(function() {
                $("#button-eliminar-partida").prop('disabled', true);
                event.preventDefault();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': "{{ csrf_token() }}"
                    },
                    url: "/admin/control-de-obras/" + partida_id,
                    type: "DELETE",
                    dataType: "json",
                    data: {
                        id: partida_id
                    },
                    success: function(event) {
                        toastr.success('Registro Agregado con exito.')
                        $("#modal-eliminar-partida").modal("hide")
                        $("#button-eliminar-partida").prop('disabled', false);
                        eliminar.remove()
                        //window.location.href = "{{ route('control-de-obras.show', $contrato->uid) }}"
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
                        $("#button-eliminar-partida").prop('disabled', false);
                    }
                })
            })
        </script>
    @endif
    <script>
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
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
        var eliminar
        $(document).on('click', '.list_cancel', function() {
            eliminar = $(this).closest('tr');
        });
        $("#importe").on('keypress', save);
        $("#precio_unitario").on('keypress', save);
        $("#cantidad").on('keypress', save);

        function save(event) {
            if (event.keyCode == 13) {
                if (numeral($('#grupo').val()).value() != 0 && $('#grupo').val() != '' && $('#clave').val() != '' &&
                    $(
                        '#partida').val() != '' && $('#unidad').val() != '' && $('#cantidad').val() != '' &&
                    $('#precio_unitario').val() != '') {
                    event.preventDefault();
                    var formData = new FormData();
                    formData.append('contrato_id', "{{ $contrato->uid }}");
                    formData.append('codigo_grupo[]', $('#codigo').val());
                    formData.append('grupo[]', $('#grupo').val());
                    formData.append('clave[]', $('#clave').val());
                    formData.append('partida[]', $('#partida').val());
                    formData.append('unidad[]', $('#unidad').val());
                    formData.append('precio_unitario[]', $('#precio_unitario').val());
                    formData.append('cantidad[]', $('#cantidad').val());
                    formData.append('importe[]', $('#importe').val());
                    $.ajax({
                        headers: {
                            'X-CSRF-Token': "{{ csrf_token() }}"
                        },
                        type: "POST",
                        url: "{{ route('control-de-obras.store') }}",
                        dataType: 'json',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(event) {
                            toastr.success('Registro Agregado con exito.')
                            definiciones.row.add({
                                id: event.id,
                                codigo_grupo: event.codigo_grupo,
                                grupo: event.grupo,
                                clave: event.clave,
                                partida: event.partida,
                                unidad: event.unidad,
                                cantidad: event.cantidad,
                                precio_unitario: event.precio_unitario,
                                importe: event.importe,
                                uuid: event.uuid
                            }).draw()
                            //definiciones.ajax.reload();
                            //window.location.href = "{{ route('control-de-obras.index') }}"
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
                            $("#button-partida").prop('disabled', false);
                        }
                    }).done(function() {
                        //$('#grupo').val('')
                        $('#clave').val('')
                        $('#partida').val('')
                        $('#unidad').val('')
                        $('#cantidad').val('')
                        $('#precio_unitario').val('')
                        $('#importe').val('')
                    });
                } else {
                    toastr.warning('Agrega Informacion')
                }
            }
        }
        $('#unidad').autocomplete({
            source: function(request, response) {
                minLength: 1,
                $.ajax({
                    url: "/api/unidad-de-medida/",
                    type: "GET",
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function(data) {
                        response($.map(data, function(item) {
                            return {
                                label: item.unidad,
                                value: item.clave
                            }
                        }))
                    }
                })
            },
        });
        $("#enviar-partida-2").on("click", function(e) {
            $("#confirm").modal("show");
        });
        $("#enviar-partida").on("click", function(e) {
            $("#confirm").modal("show");
        });
        $("#button-partida").click(function() {
            $("#button-partida").prop('disabled', true);
            event.preventDefault();
            var lbl_codigo = document.querySelectorAll('label[id=lbl-codigo]')
            var lbl_grupo = document.querySelectorAll('label[id=lbl-grupo]')
            var lbl_clave = document.querySelectorAll('label[id=lbl-clave]')
            var lbl_partida = document.querySelectorAll('label[id=lbl-partida]')
            var lbl_unidad = document.querySelectorAll('label[id=lbl-unidad]')
            var lbl_precio_unitario = document.querySelectorAll('input[id=lbl-precio_unitario]')
            var lbl_cantidad = document.querySelectorAll('input[id=lbl-cantidad]')
            var lbl_importe = document.querySelectorAll('label[id=lbl-importe]')
            var formData = new FormData();
            formData.append('contrato_id', "{{ $contrato->uid }}");
            lbl_codigo.forEach(element => {
                formData.append('codigo_grupo[]', element.innerHTML);
            });
            lbl_grupo.forEach(element => {
                formData.append('grupo[]', element.innerHTML);
            });
            lbl_clave.forEach(element => {
                formData.append('clave[]', element.innerHTML);
            });
            lbl_partida.forEach(element => {
                formData.append('partida[]', element.innerHTML);
            });
            lbl_unidad.forEach(element => {
                formData.append('unidad[]', element.innerHTML);
            });
            lbl_precio_unitario.forEach(element => {
                formData.append('precio_unitario[]', element.value);
            });
            lbl_cantidad.forEach(element => {
                formData.append('cantidad[]', element.value);
            });
            lbl_importe.forEach(element => {
                formData.append('importe[]', element.innerHTML);
            });
            $.ajax({
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                type: "POST",
                url: "{{ route('control-de-obras.store') }}",
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                success: function(event) {
                    toastr.success('Registro Agregado con exito.')
                    $("#confirm").modal("hide")
                    $("#button-partida").prop('disabled', false);
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
                    $("#button-partida").prop('disabled', false);
                }
            });
        });
        Dropzone.options.dropzone = {
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
            init: function() {
                this.on("complete", function(file) {
                    if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
                        definiciones.ajax.reload();
                    }
                });
            },
            error: function(file, message, xhr) {
                $(file.previewElement).remove();
            },
        };
        $(document).on('change', '#lbl-cantidad', function() {
            if (numeral($(this).closest('tr')[0].cells[6].children[0].children[1].children[0].attributes[6].value)
                .value() != numeral($(this).closest('tr')[0].cells[6].children[0].children.cantidad.value)
                .value()) {
                $(this).css('color', 'red')
                $(this).closest('tr').css('color', 'red')
            } else {
                $(this).closest('tr').css('color', 'black')
                $(this).css('color', 'black')
            }
            var total = numeral($(this).closest('tr')[0].cells[6].children[0].children.cantidad.value)
                .value() * numeral($(this).closest('tr')[0].cells[7].children[0].children.precio_unitario.value)
                .value()
            $(this).closest('tr')[0].cells[8].children[0].innerHTML = numeral(total).format('0,0.00')
        });
        $(document).on('change', '#lbl-precio_unitario', function() {
            if (numeral($(this).closest('tr')[0].cells[7].children[0].children[1].children[0]
                    .attributes[6].value).value() != numeral($(this).closest('tr')[0].cells[7].children[0].children
                    .precio_unitario.value).value()) {
                $(this).css('color', 'red')
                $(this).closest('tr').css('color', 'red')
            } else {
                $(this).closest('tr').css('color', 'black')
                $(this).css('color', 'black')
            }
            var total = numeral($(this).closest('tr')[0].cells[6].children[0].children.cantidad.value)
                .value() * numeral($(this).closest('tr')[0].cells[7].children[0].children.precio_unitario.value)
                .value()
            $(this).val(numeral($(this).val()).format('$0,0.00'))
            $(this).closest('tr')[0].cells[8].children[0].innerHTML = numeral(total).format('$0,0.00')
        });
        document.querySelector('#precio_unitario').addEventListener('change', (e) => {
            e.target.value = numeral(e.target.value).format('$0,0.00')
            $('#importe').val(numeral(numeral(e.target.value).value() * numeral($('#cantidad').val()).value())
                .format('$0,0.00'))
        })
        document.querySelector('#cantidad').addEventListener('change', (e) => {
            e.target.value = numeral(e.target.value).format('0,0.00')
            $('#importe').val(numeral(numeral(e.target.value).value() * numeral($('#precio_unitario').val())
                .value()).format('$0,0.00'))
        })
        document.querySelector('#codigo').addEventListener('change', (e) => {
            e.target.value = numeral(e.target.value).format('0,0')
            $('#codigo').val(e.target.value)
        })
        var definiciones = $('#table').DataTable({
            ajax: {
                url: '/api/contrato-control_obra/{{ $contrato->uid }}'
            },
            processing: true,
            responsive: true,
            autoWidth: false,
            columns: [{
                data: 'id',
                render: function(data, type, full, meta) {
                    return `<a href="#" class="list_cancel" title="Eliminar"
                        data-bs-toggle="modal"
                        data-bs-target="#modal-eliminar-partida"
                        data-id="` + data + `">
                        <i class="fas fa-times"></i>
                    </a>`
                }
            }, {
                data: 'codigo_grupo',
                render: function(data, type, full, meta) {
                    return `<label id="lbl-codigo">` + data + `</label>`
                }
            }, {
                data: 'grupo',
                render: function(data, type, full, meta) {
                    return `<label id="lbl-grupo">` + data + `</label>`
                }
            }, {
                data: 'clave',
                render: function(data, type, full, meta) {
                    return `<label id="lbl-clave">` + data + `</label>`
                }
            }, {
                data: 'partida',
                render: function(data, type, full, meta) {
                    return `<label id="lbl-partida">` + data + `</label>`
                }
            }, {
                data: 'unidad',
                render: function(data, type, full, meta) {
                    return `<label id="lbl-unidad">` + data + `</label>`
                }
            }, {
                data: 'cantidad',
                render: function(data, type, full, meta) {
                    return `<div class="input-group mb-3">
                                <input id="lbl-cantidad" name="cantidad" class="form-control"
                                    style="text-align: right"
                                    value="` + data + `">
                                <div class="input-group-append">
                                    <button type="button" class="input-group-text"
                                        id="basic-addon2" data-bs-toggle="popover"
                                        title="Cantidad Original" data-bs-trigger="focus"
                                        data-bs-content="` + data + `">
                                        <i class="fas fa-info"></i>
                                    </button>
                                </div>
                            </div>
                            <label class="invisible">
                                ` + data + `
                            </label>`
                }
            }, {
                data: 'precio_unitario',
                render: function(data, type, full, meta) {
                    return `<div class="input-group mb-3">
                                <input id="lbl-precio_unitario" name="precio_unitario"
                                    class="form-control" style="text-align: right"
                                    value="` + numeral(data).format('$0,0.00') + `">
                                <div class="input-group-append">
                                    <button type="button" class="input-group-text"
                                        id="basic-addon2" data-bs-toggle="popover"
                                        title="Monto Original" data-bs-trigger="focus"
                                        data-bs-content="` + numeral(data).format('$0,0.00') + `">
                                        <i class="fas fa-info"></i>
                                    </button>
                                </div>
                            </div>
                            <label class="invisible">
                                ` + numeral(data).format('$0,0.00') + `
                            </label>`
                }
            }, {
                data: 'importe',
                className: "text-right",
                render: function(data, type, full, meta) {
                    return `<label id="lbl-importe" style="text-align: right">` +
                        numeral(data).format('$0,0.00') + `</label>`
                }
            }, {
                data: 'uuid',
                render: function(data, type, full, meta) {
                    return `<button type="button" class="btn btn-info"
                                data-bs-toggle="modal" data-bs-target="#modalVer"
                                data-bs-target="#staticBackdrop"
                                data-definiciones="` + data + `">
                                <i class="far fa-eye"></i>
                                Ver
                            </button>`
                }
            }],
            columnDefs: [{
                targets: [0, 5, 6, 7, 9],
                orderable: false,
                searchable: false
            }, {
                targets: 9,
                visible: false
            }, {
                targets: 6,
                width: "10%"
            }, {
                targets: 7,
                width: "10%"
            }],
            language: {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "Nada encontrado disculpa",
                "info": "Mostrando la página _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros",
                "infoFiltered": "(filtrado de _MAX_ registros totales)",
                'search': 'Buscar:',
                'paginate': {
                    'next': 'Siguiente',
                    'previous': 'Anterior'
                },
                'processing': 'Cargando...'
            },
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'copyHtml5',
                    text: 'Copiar'
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                'csvHtml5',
                'pdfHtml5',
                {
                    extend: 'colvis',
                    text: 'Visibles'
                }
            ],
            fnDrawCallback: function() {
                $('[data-bs-toggle="popover"]').popover();
            }
        })
        window.onload = function() {
            if (typeof history.pushState === "function") {
                history.pushState("jibberish", null, null);
                window.onpopstate = function() {
                    history.pushState('newjibberish', null, null);
                    // Handle the back (or forward) buttons here
                    // Will NOT handle refresh, use onbeforeunload for this.
                };
            } else {
                var ignoreHashChange = true;
                window.onhashchange = function() {
                    if (!ignoreHashChange) {
                        ignoreHashChange = true;
                        window.location.hash = Math.random();
                        // Detect and redirect change here
                        // Works in older FF and IE9
                        // * it does mess with your hash symbol (anchor?) pound sign
                        // delimiter on the end of the URL
                    } else {
                        ignoreHashChange = false;
                    }
                };
            }
        }
    </script>
@stop
