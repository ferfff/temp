<form method="POST" action="{{ route('login') }}">
    @csrf
    <center>
        <p>Proporcione sus datos de acceso</p>
    </center>
    <div class="row mb-3">
        <label for="email" class="col-md-4 col-form-label text-md-end">Correo Electrónico</label>

        <div class="col-md-8">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

        <div class="col-md-8">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" required autocomplete="current-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mb-0">
        <a class="btn btn-link col-md-6" data-bs-toggle="modal" data-bs-target="#modal-email">
            ¿Olvidaste tu contraseña?
        </a>
        <div class="col-md-6">
            <button type="submit" class="btn btn-primary">
                Entrar
            </button>
        </div>
    </div>
</form>
