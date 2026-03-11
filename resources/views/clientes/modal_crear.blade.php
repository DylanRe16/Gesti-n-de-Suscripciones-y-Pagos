<div class="modal fade" id="modalCrear" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Crear Nuevo</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>

            <form action="{{ route('clientes.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Nombre Completo</label>
                        <input type="text" name="nombre_completo" class="form-control" value="{{ old('nombre_completo') }}">

                        @error('nombre_completo')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>ID Fiscal (DNI/RUC)</label>
                                <input type="text" name="id_fiscal" class="form-control" value="{{ old('id_fiscal') }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Guardar Cliente</button>
                    <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>