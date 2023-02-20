@extends('adminlte::master')

@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

@section('adminlte_css')
    @stack('css')
    @yield('css')
    <style>
        #toast-container>.toast-warning {
            color: black;
        }

        label.error {
            margin: 0%;
            display: block;
            color: red;
        }

        input.error {
            border: 1px solid red;
            color: red;
        }

        fieldset {
            min-width: revert;
            padding: revert;
            margin: revert;
            border: revert;
        }

        iframe {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            width: 100%;
            height: 100%;
        }
    </style>
    @toastr_css
@stop

@section('classes_body', $layoutHelper->makeBodyClasses())

@section('body_data', $layoutHelper->makeBodyData())

@section('body')
    <div class="wrapper">
        {{-- Preloader Animation --}}
        @if ($layoutHelper->isPreloaderEnabled())
            @include('adminlte::partials.common.preloader')
        @endif

        {{-- Top Navbar --}}
        @if ($layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.navbar.navbar-layout-topnav')
        @else
            @include('adminlte::partials.navbar.navbar')
        @endif

        {{-- Left Main Sidebar --}}
        @if (!$layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.sidebar.left-sidebar')
        @endif

        {{-- Content Wrapper --}}
        @empty($iFrameEnabled)
            @include('adminlte::partials.cwrapper.cwrapper-default')
        @else
            @include('adminlte::partials.cwrapper.cwrapper-iframe')
        @endempty

        {{-- Footer --}}
        @hasSection('footer')
            @include('adminlte::partials.footer.footer')
        @endif

        {{-- Right Control Sidebar --}}
        @if (config('adminlte.right_sidebar'))
            @include('adminlte::partials.sidebar.right-sidebar')
        @endif

    </div>
@stop

@section('adminlte_js')
    <script>
        ion.sound({
            sounds: [{
                alias: "error",
                name: "button_tiny"
            }, ],

            // main config
            path: "{{ asset('sonidos') }}/",
            preload: true,
            multiplay: true,
            volume: 0.1
        });
        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });
        $("#button").click(function() {
            $("#formulario").submit();
        });
        $("#enviar").on("click", function(e) {
            if ($('#formulario').valid()) {
                $("#confirm").modal("show");
            }
        });

        function checkSubmit() {
            document.getElementById("button").value = "Enviando...";
            document.getElementById("button").disabled = true;
            return true;
        }
    </script>
    @stack('js')
    @yield('js')
    @toastr_js
    @toastr_render
@stop
