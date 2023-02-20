@extends('adminlte::page')

@section('plugins.Dropzone', true)

@section('title', 'Banner')

@section('content_header')
    {{ Breadcrumbs::render('banner.index') }}
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill"
                                href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home"
                                aria-selected="true">Fondo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill"
                                href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile"
                                aria-selected="false">Texto de slider</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-four-tabContent">
                        <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel"
                            aria-labelledby="custom-tabs-four-home-tab">
                            <div class="form-group">
                                <p>Fondo de Banner</p>
                                <p>Personalize la imagen que se muestra de fondo en el banner principal.</p>
                                <p>La imagen debe ser formato jpg tener dimensiones minimas de:</p>
                                <ul>
                                    <li><b>Ancho:</b> 1600 Pixeles</li>
                                    <li><b>Alto:</b> 800 Pixeles</li>
                                </ul>
                                <p><b>Imagen:</b></p>
                                <form action="{{ route('img') }}" class="dropzone" id="dropzone" method="POST">
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel"
                            aria-labelledby="custom-tabs-four-profile-tab">
                            <p>Ingrese las Frases que se mostrarán en el slider del Banner Principal</p>
                            <p><b>Texto del Slider</b></p>
                            <form action="{{ route('banner.store') }}" method="POST" id="formulario-banner"
                                autocomplete="off" onsubmit="return checkSubmit();">
                                @csrf
                                <div class="form-group position-relative">
                                    <input type="text" name="texto" id="texto">
                                    <button type="button" class="btn btn-primary btn-sm" id="enviar-banner">
                                        Guardar
                                    </button>
                                </div>
                            </form>
                            <p>Sliders Registrados</p>
                            <p>Se muestran los Sliders por estatus, solo los Sliders Activos Se muestran en la
                                página</p>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead class="thead">
                                            <tr>
                                                <th>
                                                    <center>Texto Slider</center>
                                                </th>
                                                <th>
                                                    <center>Fecha de alta</center>
                                                </th>
                                                <th>
                                                    <center>Estado</center>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($banner as $item)
                                                <tr>
                                                    <td>
                                                        <center><strong>{{ $item->texto }}</strong></center>
                                                    </td>
                                                    <td>
                                                        <center>{{ $item->created_at }}</center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            @can('principal.update')
                                                                <button type="button"
                                                                    class="btn btn-{{ $item->activo == 1 ? 'success' : 'danger' }}"
                                                                    id="btn-confirm" data-toggle="modal" data-target="#active"
                                                                    data-id={{ $item->id }}>{{ $item->activo == 1 ? 'Activo' : 'Inactivo' }}</button>
                                                            @else
                                                                <center>
                                                                    {{ $item->activo == 1 ? 'Activo' : 'Inactivo' }}
                                                                </center>
                                                            @endcan
                                                        </center>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $banner->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"
        id="active">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form action="{{ route('banner.update', $banner->first()) }}" method="POST" autocomplete="off">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Confirmar</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <p>¿Desea cambiar el estatus del Slider ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" id="modal-btn-no"
                            data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" id="modal-btn-si">Guardar</button>
                        @csrf
                        @method('PUT')
                    </div>
                </form>
            </div>
        </div>
    </div>
    <x-modals.confirm text="Agregar" idButton="button-banner" />
@stop

@section('css')
@stop

@section('js')
    <script type="text/javascript">
        $("#button-banner").click(function() {
            $("#button-banner").prop('disabled', true);
            event.preventDefault();
            $.ajax({
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                type: "POST",
                url: "{{ route('banner.store') }}",
                dataType: 'json',
                data: {
                    texto: $("#texto").val(),
                },
                success: function(event) {
                    toastr.success('Registro Agregado con exito.')
                    $("#confirm").modal("hide")
                    $("#button-banner").prop('disabled', false);
                    window.location.href = "{{ route('banner.index') }}"
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
                    $("#button-banner").prop('disabled', false);
                }
            });
        });
        $("#enviar-banner").on("click", function(e) {
            if ($('#formulario-banner').valid()) {
                $("#confirm").modal("show");
            }
        });
        $('#confirm').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            modal.find('.modal-body #id').val(id)
        })
        document.getElementById('active').addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget
            var id = button.getAttribute('data-id')
            var modal = $(this)
            modal.find('.modal-body #id').val(id)
        })
        $('#formulario-banner').validate({
            rules: {
                texto: {
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

        $('a[data-toggle="pill"]').on('shown.bs.tab', function(e) {
            localStorage.setItem('selectedTab', $(e.target).attr('href'));
        });

        var selectedTab = localStorage.getItem('selectedTab');
        if (selectedTab) {
            $(selectedTab + '-tab').tab('show');
        } else {
            $('#custom-tabs-four-home-tab').tab('show');
        }
        Dropzone.options.dropzone = {
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            dictDefaultMessage: "Arrastre una imagen al recuadro para subirlo",
            acceptedFiles: "image/*",
            maxFilesize: 2
        };
    </script>
@stop
