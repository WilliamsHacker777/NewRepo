<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Reservas</title>

    <!-- Bootstrap 5 -->
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet">

    <!-- Iconos Bootstrap -->
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" 
        rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar-brand {
            font-weight: bold;
            letter-spacing: 1px;
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="/index.php">
            <i class="bi bi-building"></i> Hotel Ica Reservas
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link" href="/habitaciones"><i class="bi bi-door-open"></i> Habitaciones</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/reservar"><i class="bi bi-calendar-check"></i> Reservar</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/login"><i class="bi bi-person-circle"></i> Ingresar</a>
                </li>

            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
