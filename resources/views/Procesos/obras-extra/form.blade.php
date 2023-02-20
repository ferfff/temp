<input type="hidden" name="contrato_id" value="{{ $contrato->id }}">
<input type="hidden" name="folio" value="{{ $contrato->folio }}">
<input type="hidden" name="id" id="id">
<div class="form-group">
    <label for="bitacora">Bitacora</label>
    <textarea type="text" name="bitacora" id="bitacora" class="form-control"></textarea>
</div>
<div class="form-group">
    <label for="presupuesto">Presupuesto</label>
    <input type="number" name="presupuesto" id="presupuesto" class="form-control">
</div>
<div class="form-group">
    <label for="monto_original">Monto Original</label>
    <input type="number" name="monto_original" id="monto_original" class="form-control">
</div>
