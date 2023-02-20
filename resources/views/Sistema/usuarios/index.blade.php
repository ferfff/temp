@extends('adminlte::page')

@section('plugins.Datatables', true)
@section('plugins.iCheck', true)

@section('title', 'Usuarios')

@section('content_header')
    {{ Breadcrumbs::render('users.index') }}
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <x-layouts.header title="Usuarios" message="Agregar" route="usuarios" icon="fas fa-users" />
                <div class="card-body">
                    <x-layouts.buscador route="usuarios" :buscar="$buscar" :activo="$activo" show="true" />
                    <x-tables.table :headers="['ID', 'Nombre', 'Email', 'Rol', 'Fecha de Creación', 'Estado', 'Acciones']" id="usuarios">
                        @forelse ($usuarios as $usuario)
                            <tr>
                                <x-tables.td :key="true">{{ $usuario->id }}</x-tables.td>
                                <x-tables.td>{{ $usuario->fullName }}</x-tables.td>
                                <x-tables.td>{{ $usuario->email }}</x-tables.td>
                                <x-tables.td>{{ $usuario->roles->first()->name }}</x-tables.td>
                                <x-tables.td>{{ $usuario->created_at->diffForHumans() }}</x-tables.td>
                                <x-tables.td>
                                    @if ($usuario->deleted_at != null)
                                        <span class="badge badge-pill badge-danger">Inactivo</span>
                                    @else
                                        <span class="badge badge-pill badge-success">Activo</span>
                                    @endif
                                </x-tables.td>
                                <x-tables.td>
                                    <x-buttons.dropdown-eliminar :value="$usuario" route="usuarios" :viewId="false">
                                        <a type="button" class="dropdown-item" data-toggle="modal"
                                            data-target="#ver-accesos" data-id="{{ $usuario->id }}">
                                            <i class="fas fa-hat-wizard"></i> Accesos
                                        </a>
                                        <a type="button" class="dropdown-item" data-toggle="modal"
                                            data-target="#cambiar-contraseña" data-id="{{ $usuario->id }}">
                                            <i class="fas fa-exchange-alt"></i> Cambiar Contraseña
                                        </a>
                                    </x-buttons.dropdown-eliminar>
                                </x-tables.td>
                            </tr>
                        @empty
                            <x-layouts.vacio />
                        @endforelse
                    </x-tables.table>
                    {{ $usuarios->appends(['buscar' => $buscar, 'activo' => $activo])->links() }}
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->

    <x-modals.modal-eliminar-restaurar type="delete" :value="$usuarios" route="usuarios.destroy" method="DELETE"
        message="Desactivar" />
    <x-modals.modal-eliminar-restaurar type="restore" :value="$usuarios" route="user-restore" method="PUT"
        message="Restaurar" bgColor="primary" />

    <!-- Modal -->
    <x-modals.confirm text="Editar" />
    @if (count((array) $usuarios) > 0)
        <div class="modal fade" id="cambiar-contraseña" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cambiar contraseña</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('cambiarPassword', $usuarios->first()) }}" method="POST" autocomplete="off"
                        id="formulario" onsubmit="return checkSubmit();">
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id">
                            <div class="form-group position-relative row">
                                <div class="col-md-6">
                                    <input type="hidden" name="id" id="id">
                                    @csrf
                                    @method('PUT')
                                    <label class="h5">Nueva Contraseña</label>
                                    <input type="password" name="new_password"
                                        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        id="contraseña" placeholder="Nueva Contraseña">
                                    {!! $errors->first('password', '<div class="invalid-tooltip">:message</div>') !!}
                                </div>
                                <div class="col-md-6">
                                    <label class="h5">Confirmacion de Contraseña</label>
                                    <input type="password" name="confirm_password" class="form-control"
                                        placeholder="Confirmar Contraseña">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary" id="enviar">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
    <div class="modal fade" id="ver-accesos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bitacora</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <table id="table" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $('#confirm-delete-btn').click(function() {
            $(this).prop('disabled', true);
        })
        $('#confirm-delete').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var slug = button.data('slug')
            var modal = $(this)
            modal.find('.modal-body #slugdelete').val(slug)
        })
        $('#confirm-restore').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var slug = button.data('slug')
            var modal = $(this)
            modal.find('.modal-body #slugrestore').val(slug)
        })
        $('#cambiar-contraseña').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var modal = $(this)
            modal.find('.modal-content #id').val(button.data('id'))
        })
        $('#ver-accesos').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var modal = $(this)
            modal.find('.modal-content #id').val(button.data('id'))
            table = $('#table').DataTable({
                ajax: '/api/usuarios-accesos/' + button.data('id'),
                serverSide: true,
                processing: true,
                retrieve: true,
                columns: [{
                        data: 'user.fullName',
                        name: 'user.fullName'
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
                    'processing': 'Procesando',
                    'paginate': {
                        'next': 'Siguiente',
                        'previous': 'Anterior'
                    }
                }
            })
        })
        $("#ver-accesos").on("hidden.bs.modal", function() {
            table.destroy();
        });
        $.validator.addMethod("strong_password", function(value, element) {
            let password = value;
            if (!(/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@#$%&])(.{8,30}$)/.test(password))) {
                return false;
            }
            return true;
        }, function(value, element) {
            let password = $(element).val();
            if (!(/^(.{8,30}$)/.test(password))) {
                return 'La contraseña debe tener entre 8 y 30 caracteres.';
            } else if (!(/^(?=.*[A-Z])/.test(password))) {
                return 'La contraseña debe contener al menos una mayúscula.';
            } else if (!(/^(?=.*[a-z])/.test(password))) {
                return 'La contraseña debe contener al menos una minúscula.';
            } else if (!(/^(?=.*[0-9])/.test(password))) {
                return 'La contraseña debe contener al menos un dígito.';
            } else if (!(/^(?=.*[@#$%&])/.test(password))) {
                return "La contraseña debe contener caracteres especiales de @#$%&.";
            }
        });
        $('#formulario').validate({
            rules: {
                new_password: {
                    required: true,
                    strong_password: function(element) {
                        return $('#contraseña').val().length > 0
                    },
                },
                confirm_password: {
                    required: function(element) {
                        return $("#contraseña").val() != "";
                    },
                    equalTo: "#contraseña",
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
    </script>
    <script>
        (function($, window) {
            'use strict';

            var MultiModal = function(element) {
                this.$element = $(element);
                this.modalCount = 0;
            };

            MultiModal.BASE_ZINDEX = 1040;

            MultiModal.prototype.show = function(target) {
                var that = this;
                var $target = $(target);
                var modalIndex = that.modalCount++;

                $target.css('z-index', MultiModal.BASE_ZINDEX + (modalIndex * 20) + 10);

                // Bootstrap triggers the show event at the beginning of the show function and before
                // the modal backdrop element has been created. The timeout here allows the modal
                // show function to complete, after which the modal backdrop will have been created
                // and appended to the DOM.
                window.setTimeout(function() {
                    // we only want one backdrop; hide any extras
                    if (modalIndex > 0)
                        $('.modal-backdrop').not(':first').addClass('hidden');

                    that.adjustBackdrop();
                });
            };

            MultiModal.prototype.hidden = function(target) {
                this.modalCount--;

                if (this.modalCount) {
                    this.adjustBackdrop();
                    // bootstrap removes the modal-open class when a modal is closed; add it back
                    $('body').addClass('modal-open');
                }
            };

            MultiModal.prototype.adjustBackdrop = function() {
                var modalIndex = this.modalCount - 1;
                $('.modal-backdrop:first').css('z-index', MultiModal.BASE_ZINDEX + (modalIndex * 20));
            };

            function Plugin(method, target) {
                return this.each(function() {
                    var $this = $(this);
                    var data = $this.data('multi-modal-plugin');

                    if (!data)
                        $this.data('multi-modal-plugin', (data = new MultiModal(this)));

                    if (method)
                        data[method](target);
                });
            }

            $.fn.multiModal = Plugin;
            $.fn.multiModal.Constructor = MultiModal;

            $(document).on('show.bs.modal', function(e) {
                $(document).multiModal('show', e.target);
            });

            $(document).on('hidden.bs.modal', function(e) {
                $(document).multiModal('hidden', e.target);
            });
        }(jQuery, window));
    </script>
@stop
