@extends('adminlte::page')

@section('plugins.Summernote', true)

@section('title', 'Footer')

@section('content_header')
    {{ Breadcrumbs::render('footer.index') }}
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span id="card_title">
                            <h2><i class="fas fa-user-shield"></i> Footer Page</h2>
                        </span>
                    </div>
                </div>
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill"
                                    href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home"
                                    aria-selected="true">Redes Sociales</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill"
                                    href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile"
                                    aria-selected="false">Aviso de privacidad</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill"
                                    href="#custom-tabs-four-messages" role="tab"
                                    aria-controls="custom-tabs-four-messages" aria-selected="false">Informacion de
                                    contacto</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('footer.update', $footer->id) }}" method="POST"
                            enctype="multipart/form-data" id="formulario-footer" autocomplete="off">
                            <div class="tab-content" id="custom-tabs-four-tabContent">
                                <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel"
                                    aria-labelledby="custom-tabs-four-home-tab">
                                    <p>Defina las redes sociales a mostrar en el pie de Página</p>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend input-group-text">
                                                <i class="fab fa-facebook-square"></i>
                                            </div>
                                            <input type="text" name="facebook_url" id="facebook_url" class="form-control"
                                                placeholder="Facebook" value="{{ $footer->facebook_url }}">
                                            <div class="input-group-append input-group-text">
                                                <input type="checkbox" name="facebook_activo" id="facebook_activo"
                                                    {{ $footer->facebook_activo == 1 ? 'checked' : '' }}>
                                                <label for="facebook_activo">¿Activo?</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend input-group-text">
                                                <i class="fab fa-twitter-square"></i>
                                            </div>
                                            <input type="text" name="twitter_url" id="twitter_url" class="form-control"
                                                placeholder="Twitter" value="{{ $footer->twitter_url }}">
                                            <div class="input-group-append input-group-text">
                                                <input type="checkbox" name="twitter_activo" id="twitter_activo"
                                                    {{ $footer->twitter_activo == 1 ? 'checked' : '' }}>
                                                <label for="twitter_activo">¿Activo?</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend input-group-text">
                                                <i class="fab fa-instagram-square"></i>
                                            </div>
                                            <input type="text" name="instagram_url" id="instagram_url"
                                                class="form-control" placeholder="Instagram"
                                                value="{{ $footer->instagram_url }}">
                                            <div class="input-group-append input-group-text">
                                                <input type="checkbox" name="instagram_activo" id="instagram_activo"
                                                    {{ $footer->instagram_activo == 1 ? 'checked' : '' }}>
                                                <label for="instagram_activo">¿Activo?</label>
                                            </div>
                                        </div>
                                    </div>
                                    <p>Si se activa un red social, pero la url permanece en blanco, será desactivada por
                                        defecto </p>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel"
                                    aria-labelledby="custom-tabs-four-profile-tab">
                                    <p>Proporcione la información a mostrar en <b>Aviso de Privacidad</b></p>
                                    <b>Resumen</b><br>
                                    <textarea name="aviso_privacidad_resumen" id="aviso_privacidad_resumen" cols="115" rows="5">{{ $footer->aviso_privacidad_resumen }}</textarea>
                                    <p>Ingrese el resumen del Aviso de Privacidad a mostrar en los pie de página. Máximo
                                        200
                                        catácteres</p>
                                    <textarea class="form-control" id="aviso_privacidad" name="aviso_privacidad">{{ $footer->aviso_privacidad }}</textarea>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel"
                                    aria-labelledby="custom-tabs-four-messages-tab">
                                    <div class="row col-sm-12">
                                        <div class="form-group col-sm-4">
                                            <div class="input-group">
                                                <div class="input-group-prepend input-group-text"><i
                                                        class="fas fa-home"></i>
                                                </div>
                                                <input type="text" name="ubicacion" id="ubicacion"
                                                    class="form-control" placeholder="Facebook"
                                                    value="{{ $footer->ubicacion }}">
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <div class="input-group">
                                                <div class="input-group-prepend input-group-text"><i
                                                        class="fas fa-envelope"></i></div>
                                                <input type="text" name="email" id="email" class="form-control"
                                                    placeholder="Twitter" value="{{ $footer->email }}">
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <div class="input-group">
                                                <div class="input-group-prepend input-group-text"><i
                                                        class="fas fa-phone"></i>
                                                </div>
                                                <input type="text" name="telefono" id="telefono"
                                                    class="form-control" placeholder="Instagram"
                                                    value="{{ $footer->telefono }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @csrf
                            @method('PUT')
                            @can('principal.update')
                                <center>
                                    <button type="button" class="btn btn-primary btn-sm mt-2" id="enviar-footer">
                                        Guardar
                                    </button>
                                </center>
                            @endcan
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-modals.confirm text="Editar" idButton="button-footer" />
@stop

@section('js')
    <script type="text/javascript">
        $("#button-footer").click(function() {
            $("#button-footer").prop('disabled', true);
            event.preventDefault();
            var formData = new FormData();
            formData.append('facebook_url', $("#facebook_url").val());
            formData.append('facebook_activo', $("#facebook_activo").val());
            formData.append('twitter_url', $("#twitter_url").val());
            formData.append('twitter_activo', $("#twitter_activo").val());
            formData.append('instagram_url', $("#instagram_url").val());
            formData.append('instagram_activo', $("#instagram_activo").val());
            formData.append('aviso_privacidad', $("#aviso_privacidad").val());
            formData.append('aviso_privacidad_resumen', $("#aviso_privacidad_resumen").val());
            formData.append('ubicacion', $("#ubicacion").val());
            formData.append('email', $("#email").val());
            formData.append('telefono', $("#telefono").val());
            formData.append("_method", "PUT");
            $.ajax({
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                type: "POST",
                url: "{{ route('footer.update', $footer->id) }}",
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                success: function(event) {
                    toastr.success('Registro Agregado con exito.')
                    $("#confirm").modal("hide")
                    $("#button-footer").prop('disabled', false);
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
                    $("#button-footer").prop('disabled', false);
                }
            });
        });
        $("#enviar-footer").on("click", function(e) {
            if ($('#formulario-footer').valid()) {
                $("#confirm").modal("show");
            }
        });
        $('#formulario-footer').validate({
            rules: {
                aviso_privacidad: {
                    required: true,
                },
                aviso_privacidad_resumen: {
                    required: true,
                    maxlength: 200
                },
                ubicacion: {
                    required: true,
                    maxlength: 50
                },
                email: {
                    required: true,
                    maxlength: 50
                },
                telefono: {
                    required: true,
                    maxlength: 10
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
        $('#aviso_privacidad').summernote();

        $('button[data-toggle="pill"]').on('shown.bs.tab', function(e) {
            localStorage.setItem('selectedTab', $(e.target).attr('href'));
        });

        var selectedTab = localStorage.getItem('selectedTab');
        if (selectedTab) {
            $(selectedTab + '-tab').tab('show');
        } else {
            $('#pills-home-tab').tab('show');
        }
        $("#facebook_url").on("change", function() {
            $("#facebook_activo").prop("checked", $("#facebook_url").val().length > 0 ? true : false);
        });
        $("#twitter_url").on("change", function() {
            $("#twitter_activo").prop("checked", $("#twitter_url").val().length > 0 ? true : false);
        });
        $("#instagram_url").on("change", function() {
            $("#instagram_activo").prop("checked", $("#instagram_url").val().length > 0 ? true : false);
        });
    </script>
@stop
