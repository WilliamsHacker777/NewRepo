<div class="container mt-4">
    <h1 class="mb-4">Habitaciones Disponibles</h1>

    <div class="row">

        <?php if (empty($habitaciones)) : ?>
            <div class="alert alert-warning">
                No hay habitaciones disponibles en este momento.
            </div>
        <?php endif; ?>

        <?php foreach ($habitaciones as $h) : ?>

            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">

                    <img src="/ProyectoReservas/public/img/habitacion.jpeg" 
                         class="card-img-top" alt="Habitación">

                    <div class="card-body">

                        <h5 class="card-title">Habitación <?= $h['numero']; ?></h5>

                        <p class="card-text">
                            <strong>Tipo:</strong> <?= $h['tipo']; ?><br>
                            <strong>Precio:</strong> S/ <?= number_format($h['precio'], 2); ?>
                        </p>

                        <?php if ($logueado): ?>
                            <a href="/ProyectoReservas/public/reservar?id=<?= $h['id']; ?>"
                               class="btn btn-primary w-100">
                                Reservar
                            </a>
                        <?php else: ?>
                            <a href="/ProyectoReservas/public/login"
                               class="btn btn-outline-primary w-100">
                                Iniciar sesión para reservar
                            </a>
                        <?php endif; ?>

                    </div>
                </div>
            </div>

        <?php endforeach; ?>

    </div>
</div>
