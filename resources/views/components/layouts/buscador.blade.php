<form action="{{ route("$route.index") }}" method="GET" autocomplete="off">
    <div class="input-group rounded">
        <input type="search" class="form-control rounded" placeholder="Buscar" aria-label="Search"
            aria-describedby="search-addon" name="buscar" value="{{ $buscar }}" />
        @if ($range)
            <input type="text" name="daterange" value="{{ $datarange }}" />
        @endif
        <button type="submit">
            <span class="input-group-text border-0" id="search-addon">
                <i class="fas fa-search"></i>
            </span>
        </button>
    </div>
    @if ($show)
        <div class="row">
            <div class="col-md-6 mt-2 mb-2">
                @if ($fieldset)
                    <x-layouts.fieldset legend="Estado del expediente">
                        <div class="form-check ml-2">
                            <div class="icheck-primary">
                                <input class="form-check-input" type="radio" name="activo" id="exampleRadios1"
                                    value="0" {{ $activo == 0 || $activo == null ? 'checked' : '' }}
                                    onchange="submit()">
                                <label class="form-check-label" for="exampleRadios1">{{ $todos }}</label>
                            </div>
                        </div>
                        <div class="form-check ml-2">
                            <div class="icheck-success">
                                <input class="form-check-input" type="radio" name="activo" id="exampleRadios2"
                                    value="1" {{ $activo == 1 ? 'checked' : '' }} onchange="submit()">
                                <label class="form-check-label" for="exampleRadios2">{{ $activos }}</label>
                            </div>
                        </div>
                        <div class="form-check ml-2">
                            <div class="icheck-danger">
                                <input class="form-check-input" type="radio" name="activo" id="exampleRadios3"
                                    value="2" {{ $activo == 2 ? 'checked' : '' }} onchange="submit()">
                                <label class="form-check-label" for="exampleRadios3">{{ $inactivos }}</label>
                            </div>
                        </div>
                    </x-layouts.fieldset>
                @else
                    <div class="row">
                        <div class="form-check ml-2">
                            <div class="icheck-primary">
                                <input class="form-check-input" type="radio" name="activo" id="exampleRadios1"
                                    value="0" {{ $activo == 0 || $activo == null ? 'checked' : '' }}
                                    onchange="submit()">
                                <label class="form-check-label" for="exampleRadios1">{{ $todos }}</label>
                            </div>
                        </div>
                        <div class="form-check ml-2">
                            <div class="icheck-success">
                                <input class="form-check-input" type="radio" name="activo" id="exampleRadios2"
                                    value="1" {{ $activo == 1 ? 'checked' : '' }} onchange="submit()">
                                <label class="form-check-label" for="exampleRadios2">{{ $activos }}</label>
                            </div>
                        </div>
                        <div class="form-check ml-2">
                            <div class="icheck-danger">
                                <input class="form-check-input" type="radio" name="activo" id="exampleRadios3"
                                    value="2" {{ $activo == 2 ? 'checked' : '' }} onchange="submit()">
                                <label class="form-check-label" for="exampleRadios3">{{ $inactivos }}</label>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-md-6 mt-2 mb-2">
                {{ $slot }}
            </div>
        </div>
    @endif
</form>
