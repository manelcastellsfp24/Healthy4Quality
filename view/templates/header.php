<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Healthy4Quality</title>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Tu CSS -->
    <link rel="stylesheet" href="/Healthy4Quality/assets/css/style.css">
</head>
<body>

<header class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top main-navbar">
    <div class="container">
        <a class="navbar-brand fw-bold logo" href="index.php">
            Healthy<span>4</span>Quality
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <nav class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-3">
                <li class="nav-item">
                    <a class="nav-link" href="index.php?controller=pagina&action=home#carta">Carta</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?controller=pagina&action=home#horario">Horario</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?controller=pagina&action=home#servicios">Servicios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?controller=pagina&action=home#contacto">Contacto</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-success nav-cta" href="index.php?controller=producto&action=lista">
                        Hacer pedido
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</header>

<main class="py-4">
    <div class="container">
