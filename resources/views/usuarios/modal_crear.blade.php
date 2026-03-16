<div class="modal fade" id="modalCrearUsuario" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Registrar Nuevo Empleado</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ route('usuarios.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Cédula</label>
                        <input type="text" name="cedula" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Nombre Completo</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Contraseña</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Asignar Rol</label>
                        <select name="role" class="form-control" required>
                            <option value="">Seleccione un rol...</option>
                            <option value="Admin">Administrador</option>
                            <option value="Vendedor">Vendedor</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Crear Usuario</button>
                </div>
            </form>
        </div>
    </div>
</div>