<div class="table-responsive-sm">
    <table class="table {{ $class }}" id="{{ $id }}">
        <thead class="thead">
            <tr>
                @foreach ($headers as $header)
                    <x-tables.th> {{ ucwords($header) }} </x-tables.th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            {{ $slot }}
        </tbody>
    </table>
</div>
