<div class="modal fade" id="modal-excel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Excel</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route($route) }}" enctype="multipart/form-data">
                    <fieldset>
                        <legend>
                            <center>Importar datos</center>
                        </legend>
                        @csrf
                        <input type="file" name="excel" accept=".xls, .xlsx" class="form-control" id="archivo"
                            required>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
