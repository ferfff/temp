<div class="modal fade" id="confirm-{{ $type }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route($route, $value->first() ?? $value) }}" method="POST">
                @csrf
                @method($method)
                <div class="modal-header">
                    <h5 class="modal-title">{{ $message }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label>¿Quieres {{ $message }} el registro?</label>
                    <input type="hidden" name="slug" id="{{ $type == 'delete' ? 'slugdelete' : 'slugrestore' }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-{{ $bgColor }}"
                        id="confirm-{{ $type }}-btn">{{ $message }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
