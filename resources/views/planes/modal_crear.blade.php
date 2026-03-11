<div class="modal fade" id="modalCrearPlan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Nuevo Plan de Servicio</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('planes.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nombre del Plan</label>
                        <input type="text" name="nombre" class="form-control" placeholder="Ej: Básico, VIP..." required>
                    </div>
                    <div class="form-group">
                        <label>Precio ($)</label>
                        <input type="number" name="precio" step="0.01" class="form-control" placeholder="0.00" required>
                    </div>
                    <div class="form-group">
                        <label>Duración (Meses)</label>
                        <input type="number" name="duracion_meses" class="form-control" value="1" required>
                    </div>
                    <div class="form-group">
                        <label>Descripción</label>
                        <textarea name="descripcion" class="form-control" rows="2" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar Plan</button>
                </div>
            </form>
        </div>
    </div>
</div>