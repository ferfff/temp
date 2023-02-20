@extends('adminlte::page')

@section('plugins.Switch', true)

@section('title', 'Roles')

@section('content_header')
    {{ Breadcrumbs::render('roles.update', $role) }}
@stop

@section('content')

    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Editar Rol</span>
                    </div>
                    <div class="card-body">
                        {!! Form::model($role, [
                            'route' => ['roles.update', $role],
                            'method' => 'put',
                            'id' => 'formulario-rol',
                            'autocomplete' => 'off',
                        ]) !!}
                        @include('Sistema.roles.form')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <x-modals.confirm text="Editar" idButton="button-rol" />
@stop

@section('js')
    <script>
        $("#button-rol").click(function() {
            $("#button-rol").prop('disabled', true);
            event.preventDefault();
            var array = []
            var checkboxes = document.querySelectorAll('input[type=checkbox]:checked')

            for (var i = 0; i < checkboxes.length; i++) {
                array.push(checkboxes[i].value)
            }
            $.ajax({
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                type: "PUT",
                url: "{{ route('roles.update', $role) }}",
                dataType: 'json',
                data: {
                    name: $("#name").val(),
                    permissions: array,
                },
                success: function(event) {
                    toastr.success('Registro Modificado con exito.')
                    $("#confirm").modal("hide")
                    $("#button-rol").prop('disabled', false);
                    window.location.href = "{{ route('roles.index') }}"
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
                    $("#button-rol").prop('disabled', false);
                }
            });
        });
        $("#enviar-rol").on("click", function(e) {
            if ($('#formulario-rol').valid()) {
                $("#confirm").modal("show");
            }
        });
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
        $('input[type="checkbox"]').bootstrapSwitch({
            onText: "Si",
            offText: 'No'
        });
        $('#formulario-rol').validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 25
                },
                permissions: {
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
