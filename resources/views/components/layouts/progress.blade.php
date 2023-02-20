$ {{ number_format($valueMin, 2, '.', ',') }} -
$ {{ number_format($valueMax, 2, '.', ',') }}
<div class="progress progress-sm">
    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="57"
        aria-valuemin="0" aria-vañluemax="100" style="width: {{ $total }}%">
    </div>
</div>
<small>
    {{ $total }}% {{ $mensaje }}
</small>
