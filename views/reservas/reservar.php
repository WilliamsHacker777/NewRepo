<div class="container mt-4">

    <a href="/ProyectoReservas/public/home" class="btn btn-link mb-3">
        ← Volver
    </a>

    <h2 class="mb-4">Reserva de Habitación</h2>

    <div class="row">
        <div class="col-md-6">

            <!-- Tarjeta estilo Booking -->
            <div class="card shadow-sm">
                <img src="/ProyectoReservas/public/img/habitacion.jpg" 
                     class="card-img-top" alt="Habitación">

                <div class="card-body">
                    <h4 class="card-title">Habitación <?= $habitacion['numero']; ?></h4>

                    <p class="card-text">
                        <strong>Tipo: </strong><?= $habitacion['tipo']; ?><br>
                        <strong>Precio por noche: </strong>S/ <?= number_format($habitacion['precio'], 2); ?><br>
                    </p>

                    <?php if (!empty($habitacion['descripcion'])): ?>
                        <p class="card-text text-muted">
                            <?= $habitacion['descripcion']; ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>

        </div>

        <div class="col-md-6">
            
            <div class="card shadow-sm p-4">

                <form action="/ProyectoReservas/public/reservar/guardar" method="POST">

                    <input type="hidden" name="habitacion_id" value="<?= $habitacion['id']; ?>">
                    <input type="hidden" id="precio" value="<?= $habitacion['precio']; ?>">

                    <div class="mb-3">
                        <label class="form-label">Fecha de inicio</label>
                        <input type="date" class="form-control" required name="inicio" id="inicio">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Fecha de fin</label>
                        <input type="date" class="form-control" required name="fin" id="fin">
                    </div>

                    <div class="alert alert-info">
                        <strong>Total estimado: </strong>
                        S/ <span id="total">0.00</span>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        Confirmar Reserva
                    </button>

                </form>

            </div>

        </div>
    </div>
</div>

<!-- Script para calcular total automáticamente -->
<script>
    const inicio = document.getElementById('inicio');
    const fin = document.getElementById('fin');
    const total = document.getElementById('total');
    const precio = parseFloat(document.getElementById('precio').value);

    function calcularTotal() {
        if (!inicio.value || !fin.value) {
            total.textContent = "0.00";
            return;
        }

        const fechaInicio = new Date(inicio.value);
        const fechaFin   = new Date(fin.value);

        if (fechaFin <= fechaInicio) {
            total.textContent = "0.00";
            return;
        }

        const diffTime = fechaFin - fechaInicio;
        const dias = diffTime / (1000 * 60 * 60 * 24);

        total.textContent = (dias * precio).toFixed(2);
    }

    inicio.addEventListener("change", calcularTotal);
    fin.addEventListener("change", calcularTotal);
</script>
