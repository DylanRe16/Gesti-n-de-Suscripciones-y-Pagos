<div class="modal fade" id="modalCrear2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Nuevo Plan de Servicio</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('suscripciones.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        {{-- Columna 1: Cliente y Plan --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cliente_id">Seleccionar Cliente</label>
                                <select name="cliente_id" class="form-control" required>
                                    <option value="">-- Seleccione un cliente --</option>
                                    @foreach($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->nombre_completo }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Fecha de Inicio</label>
                                <input type="date" name="fecha_inicio" class="form-control" value="{{ date('Y-m-d') }}" required>
                                <small class="text-muted">La fecha de vencimiento se calculará automáticamente según los meses del plan.</small>
                            </div>

                        </div>

                        {{-- Columna 2: Fechas --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="plan_id">Plan a Contratar</label>
                                <select name="plan_id" class="form-control" required>
                                    <option value="">-- Seleccione un plan --</option>
                                    @foreach($planes as $plan)
                                    <option value="{{ $plan->id }}">{{ $plan->nombre_plan }} (${{ $plan->precio }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Duración (Meses)</label>
                                <input type="number" name="duracion_meses" class="form-control" value="1" required>
                                <small class="text-muted">Puedes ajustar la duración si deseas que la suscripción sea más larga o más corta que la duración estándar del plan.</small>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="observaciones">Operador que activa la suscripción</label>
                                <select name="user_id" id="user_id" class="form-control" required>
                                    <option value="">-- Seleccione un operador --</option>
                                    @foreach($user as $users)
                                    <option value="{{ $users->id }}">{{ $users->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="alert alert-info mt-4">
                            <h5><i class="icon fas fa-info"></i> Nota Importante</h5>
                            Al guardar, el sistema generará el registro de suscripción y calculará el monto fijo basado en el precio actual del plan.
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Activar Suscripción Ahora</button>
                    <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Volver</a>
                </div>
            </form>
        </div>
    </div>
</div>