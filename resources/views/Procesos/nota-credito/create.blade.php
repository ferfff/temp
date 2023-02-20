@extends('adminlte::page')

@section('plugins.Numeral', true)

@section('title', 'Nota de Credito')

@section('content_header')
    {{ Breadcrumbs::render('nota-de-credito.store') }}
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Agregar Nota de Credito</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('nota-de-credito.store') }}" role="form"
                            enctype="multipart/form-data" autocomplete="off" id="formulario-credito">
                            @csrf
                            @include('Procesos.nota-credito.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label>¿Quieres agregar el registro?</label>
                    <div id="cont1" class="text-danger font-weight-bold"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="button-credito">Guardar</button>
                </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script>
        var folio
        var serie
        var fecha
        var monto
        var cliente
        var ul = document.createElement("ul");
        document.querySelector('#monto').addEventListener('change', (e) => {
            var number = numeral(e.target.value);
            numeral.defaultFormat('$0,0.00')
            e.target.value = number.format()
        })
        $("#button-credito").click(function() {
            $("#button-credito").prop('disabled', true);
            event.preventDefault();
            var formData = new FormData();
            formData.append('folio', $("#folio").val());
            formData.append('cliente_id', $("#cliente").val());
            formData.append('emisor', $("#emisor").val());
            formData.append('fecha', $("#fecha").val());
            formData.append('monto', $("#monto").val());
            formData.append('xml', $("#xml")[0].files[0]);
            formData.append('pdf', $("#pdf")[0].files[0]);
            $.ajax({
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                type: "POST",
                url: "{{ route('nota-de-credito.store') }}",
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                success: function(event) {
                    toastr.success('Registro Agregado con exito.')
                    $("#confirm").modal("hide")
                    $("#button-credito").prop('disabled', false);
                    window.location.href = "{{ route('nota-de-credito.index') }}"
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
                    $("#button-credito").prop('disabled', false);
                }
            });
        });
        $("#enviar-credito").on("click", function(e) {
            if ($('#formulario-credito').valid()) {
                while (ul.firstChild) {
                    ul.removeChild(ul.firstChild);
                }
                if (serie + folio != $('#folio').val()) {
                    var li = document.createElement("li");
                    li.className = "li"
                    li.innerHTML = "El folio fue cambiado";
                    ul.appendChild(li)
                }
                if (fecha != $('#fecha').val()) {
                    var li = document.createElement("li");
                    li.className = "li"
                    li.innerHTML = "La fecha fue cambiado";
                    ul.appendChild(li)
                }
                if (cliente != $('#cliente').val()) {
                    var li = document.createElement("li");
                    li.className = "li"
                    li.innerHTML = "El cliente fue cambiado";
                    ul.appendChild(li);
                }
                var number = numeral(monto);
                numeral.defaultFormat('$0,0.00')
                if (number.format() != $('#monto').val()) {
                    var li = document.createElement("li");
                    li.className = "li"
                    li.innerHTML = "El monto fue cambiado";
                    ul.appendChild(li);
                }
                document.getElementById('cont1').appendChild(ul)
                $("#confirm").modal("show");
            }
        });

        document.getElementById('xml').addEventListener('change', handleFileSelection, false);

        function parseTextAsXml(text) {
            var xmlDoc = $.parseXML(text);
            //console.log(xmlDoc.documentElement)
            if (xmlDoc.documentElement.attributes.TipoDeComprobante.value == 'E') {
                folio = xmlDoc.documentElement.attributes.Folio.value
                if (typeof xmlDoc.documentElement.attributes.Serie !== 'undefined') {
                    serie = xmlDoc.documentElement.attributes.Serie.value
                } else {
                    serie = ''
                }
                fecha = xmlDoc.documentElement.attributes.Fecha.value
                monto = xmlDoc.documentElement.attributes.Total.value
                cliente = xmlDoc.documentElement.children[1].attributes.Rfc.value
                emisor = xmlDoc.documentElement.children[0].attributes.Rfc.value
                $.get('/api/cliente-nota_credito/' + cliente, function(data) {
                    if (data.length < 1) {
                        toastr.warning('El RFC del cliente no esta registrado')
                    } else {
                        $('#folio').val(serie + folio)
                        $('#fecha').val(fecha)
                        var number = numeral(monto);
                        numeral.defaultFormat('$0,0.00')
                        $('#monto').val(number.format())
                        $('#cliente').val(cliente)
                        $('#emisor').val(emisor)
                    }
                });
            } else {
                toastr.info('Agrega un CFDI valido')
            }
        }

        function waitForTextReadComplete(reader) {
            reader.onloadend = function(event) {
                var text = event.target.result;

                parseTextAsXml(text);
            }
        }

        function handleFileSelection() {

            var file = document.getElementById('xml').files[0],
                reader = new FileReader();
            if (file.type == 'text/xml') {
                waitForTextReadComplete(reader);
                reader.readAsText(file);
            }
        }
        $('#formulario-credito').validate({
            rules: {
                folio: {
                    required: true,
                    maxlength: 50,
                },
                emisor: {
                    required: true,
                    maxlength: 50,
                },
                cliente: {
                    required: true,
                    maxlength: 50,
                },
                fecha: {
                    required: true,
                },
                monto: {
                    required: true,
                },
                xml: {
                    required: true,
                    extension: "xml"
                },
                pdf: {
                    required: true,
                    extension: "pdf"
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
