@extends('adminlte::page')

@section('plugins.Switch', true)

@section('title', 'Clientes')

@section('content_header')
    {{ Breadcrumbs::render('cliente.store') }}
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{ route('clientes.store') }}" role="form" enctype="multipart/form-data"
                    id="formulario-cliente" autocomplete="off">
                    @csrf
                    @include('Catalogos.cliente.form')
                </form>
            </div>
        </div>
    </section>
    <x-modals.confirm text="Agregar" idButton="button-cliente" />
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Correos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" id="formulario-correo">
                        <div class="form-group ">
                            <label for="correo">Proceso</label>
                            <div class="position-relative">
                                <select name="tipo_proceso" id="tipo_proceso" class="form-control">
                                    <option value=""></option>
                                    <option value="Alta Presupuesto">Presupuesto (Alta)</option>
                                    <option value="Autorizado Presupuesto">Presupuesto (Autorizacion)</option>
                                    <option value="Rechazado Presupuesto">Presupuesto (Rechazar)</option>
                                    <option value="Modificado Presupuesto">Presupuesto (Modificacion)</option>
                                    <option value="Siroc">Siroc</option>
                                    <option value="Jornal">Jornales</option>
                                    <option value="Estimacion">Estimaciones (Alta)</option>
                                    <option value="Estimacion Cliente">Estimaciones (Cliente)</option>
                                    <option value="Estimacion Pendiente Pago">Estimaciones (Pendiente de pago)</option>
                                    <option value="Expediente">Expedientes </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="titulo">Titulo</label>
                            <div class="position-relative">
                                <select name="titulo" id="titulo" class="form-control">
                                    <option value=""></option>
                                    <option value="Lic.">Lic.</option>
                                    <option value="Mtr.">Mtr.</option>
                                    <option value="Dr.">Dr.</option>
                                    <option value="Ing.">Ing.</option>
                                    <option value="Téc.">Téc.</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <div class="position-relative">
                                <input type="text" name="nombre" id="nombre" placeholder="Nombre"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="correo">Correo</label>
                            <div class="position-relative">
                                <input type="email" name="correo" id="correo" placeholder="Correo"
                                    class="form-control" style="text-transform: lowercase">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="correo">Tipo</label>
                            <div class="position-relative">
                                <select name="tipo_correo" id="tipo_correo" class="form-control">
                                    <option value=""></option>
                                    <option value="Destinatario"> Destinatario </option>
                                    <option value="CC"> CC </option>
                                    <option value="CCO"> CCO </option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary list_add" id="button-correo">Agregar</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        #toast-container>.toast-warning {
            color: black;
        }
    </style>
@stop

@section('js')
    <script>
        $("#button-cliente").click(function() {
            $("#button-cliente").prop('disabled', true);
            event.preventDefault();
            var titulo = [];
            var nombre = [];
            var correo = [];
            var tipo_correo = [];
            var tipo_proceso = [];
            var ititulo = document.querySelectorAll('label[id=lbl-titulo]')
            var inombre = document.querySelectorAll('label[id=lbl-nombre]')
            var icorreo = document.querySelectorAll('label[id=lbl-correo]')
            var itipo = document.querySelectorAll('label[id=lbl-tipo]')
            var iproceso = document.querySelectorAll('label[id=lbl-proceso]')
            for (var i = 0; i < inombre.length; i++) {
                titulo.push(ititulo[i].innerHTML)
                nombre.push(inombre[i].innerHTML)
                correo.push(icorreo[i].innerHTML)
                tipo_correo.push(itipo[i].innerHTML)
                tipo_proceso.push(iproceso[i].innerHTML)
            }
            $.ajax({
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                type: "POST",
                url: "{{ route('clientes.store') }}",
                dataType: 'json',
                data: {
                    razon_social: $("#razon_social").val(),
                    RFC: $("#RFC").val(),
                    contacto: $("#contacto").val(),
                    registro_patronal: $("#registro_patronal").val(),
                    repse: $("#repse").val(),
                    presupuesto: $("#presupuesto").bootstrapSwitch('state'),
                    siroc: $("#siroc").bootstrapSwitch('state'),
                    expediente: $("#expediente").bootstrapSwitch('state'),
                    activo: $("#activo").bootstrapSwitch('state'),
                    titulo: titulo,
                    nombre: nombre,
                    correo: correo,
                    tipo_correo: tipo_correo,
                    tipo_proceso: tipo_proceso
                },
                success: function(event) {
                    toastr.success('Registro Agregado con exito.')
                    $("#confirm").modal("hide")
                    $("#button-cliente").prop('disabled', false);
                    window.location.href = "{{ route('clientes.index') }}"
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
        $("#enviar-cliente").on("click", function(e) {
            if ($('#archivo').fileinput('getFilesCount') == 0) {
                toastr.info('Suba un archivo')
            }
            if ($('#formulario-cliente').valid()) {
                $("#confirm").modal("show");
            }
        });
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl, {
                html: true
            })
        })
        $('#activo').bootstrapSwitch({
            onText: "Si",
            offText: 'No'
        });
        $('#presupuesto').bootstrapSwitch({
            onText: "Si",
            offText: 'No'
        });
        $('#siroc').bootstrapSwitch({
            onText: "Si",
            offText: 'No'
        });
        $('#expediente').bootstrapSwitch({
            onText: "Solicita expediente completo",
            offText: 'No Solicita'
        });
        $.validator.addMethod(
            "regex",
            function(value, element, regexp) {
                var check = false;
                return this.optional(element) || regexp.test(value);
            },
            "RFC No valido"
        );
        $.validator.addMethod("isEmail", function(value, element) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test($(element).val()) || $(element).val() == "";
        }, function(value, element) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!regex.test($(element).val())) {
                return 'El correo es incorrecto'
            }
        });
        $('#formulario-cliente').validate({
            rules: {
                razon_social: {
                    required: true,
                    maxlength: 50,
                },
                RFC: {
                    required: true,
                    maxlength: 50,
                    regex: /^([A-ZÑa-zñ\x26]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])([A-Za-z\d]{3}))$/
                },
                contacto: {
                    required: true,
                    maxlength: 50,
                },
                registro_patronal: {
                    required: true,
                    maxlength: 50,
                },
                repse: {
                    required: true,
                    maxlength: 10,
                    minlength: 5,
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
            errorClass: "invalid-tooltip",
        })
        $("#button-correo").click(function(element) {
            if ($('#nombre').val() != '') {
                $.get('/api/uso-correos/' + $('#tipo_proceso').val(), function(data) {
                    var array = data.dominio != null ? data.dominio.split(',') : []
                    if (array.length > 0) {
                        var existe = array.indexOf($('#correo').val().substring($('#correo').val()
                            .indexOf('@') + 1, $('#correo').val().length))
                        if (existe < 0) {
                            $('#correo').val('')
                            toastr.info(
                                'El dominio del correo ingresado, no está autorizado.<br>Los dominios autorizados para este proceso son: ' +
                                data.dominio)
                        }
                    }
                }).done(function() {
                    tipo_proceso = []
                    tipo_correo = []
                    existe = false
                    array = document.querySelectorAll('label[id=lbl-proceso]')
                    array2 = document.querySelectorAll('label[id=lbl-correo]')
                    array.forEach(element => tipo_proceso.push(element.textContent));
                    array2.forEach(element => tipo_correo.push(element.textContent));
                    for (let index = 0; index < array.length; index++) {
                        if ($('#correo').val() == tipo_correo[index] && $('#tipo_proceso').val() ==
                            tipo_proceso[index]) {
                            existe = true
                        }
                    }
                    if (existe) {
                        toastr.info('Este correo ya esta registrado')
                    }
                    if ($('#formulario-correo').valid() && !existe) {
                        if ($.inArray($('#tipo_proceso').val(), tipo_proceso) == -1) {
                            $('#tipo_correo').val('Destinatario')
                        }
                        $("#table").find('tbody').append(
                            `<tr class="trow">
            <x-tables.td class="controls">
                <a href="#" class="list_cancel" title="Eliminar">
                    <i class="fas fa-times"></i>
                </a>
            </x-tables.td>
            <x-tables.td>
                <label id="lbl-titulo">` + $('#titulo').val() + `</label>
            </x-tables.td>
            <x-tables.td>
                <label id="lbl-nombre">` + $('#nombre').val() + `</label>
            </x-tables.td>
            <x-tables.td>
                <label id="lbl-correo">` + $('#correo').val() + `</label>
            </x-tables.td>
            <x-tables.td>
                <label id="lbl-tipo">` + $('#tipo_correo').val() + `</label>
            </x-tables.td>
            <x-tables.td>
                <label id="lbl-proceso">` + $('#tipo_proceso').val() + `</label>
            </x-tables.td>
        </tr>`);
                        if ($.inArray($('#tipo_proceso').val(), tipo_proceso) == -1)
                            toastr.warning(
                                'Correo agregado correctamente pero el correo sera como destinatario')
                        else
                            toastr.success('Correo agregado correctamente')

                        $('#titulo option[value=""]').prop("selected", true)
                        $('#nombre').val('')
                        $('#correo').val('')
                        $('#tipo_correo option[value=""]').prop("selected", true)
                        $('#tipo_proceso option[value=""]').prop("selected", true)
                    }
                });
            } else {
                toastr.info('Agrega informacion')
            }
        });
        $(document).on('click', '.list_cancel', function() {
            $(this).closest('tr').remove();
        });
        $('#formulario-correo').validate({
            rules: {
                nombre: {
                    required: true,
                    maxlength: 50,
                },
                correo: {
                    required: function(element) {
                        return $("#nombre").val() != ""
                    },
                    maxlength: 50,
                    isEmail: true,
                },
                tipo_correo: {
                    required: function(element) {
                        return $("#nombre").val() != ""
                    }
                },
                tipo_proceso: {
                    required: function(element) {
                        return $("#nombre").val() != ""
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
            errorClass: "invalid-tooltip",
        })
    </script>
@stop
