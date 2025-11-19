<?php include_once __DIR__ . "/../layout/header.php"; ?>

<div class="container text-center">

    <div class="alert alert-danger mt-4 shadow">
        <h4><i class="bi bi-x-circle"></i> Error en la reserva</h4>
        <p><?= $mensaje ?></p>
    </div>

    <a href="/home" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Volver al inicio
    </a>

</div>

<?php include_once __DIR__ . "/../layout/footer.php"; ?>
