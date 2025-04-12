<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Biblioteca</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
    background-color: #121212;
    color: white;
    }
    .card {
    background-color: #1f1f1f;
    margin-bottom: 1rem;
    }
    .modal-content {
    background-color: #2c2c2c;
    color: white;
    }
    .form-label {
    color: #ccc;
    }
</style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
    <a class="navbar-brand" href="#">Biblioteca</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
    <span class="navbar-toggler-icon"></span>
    </button>
</div>
</nav>

<div class="container mt-4">
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Listado de Libros</h2>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalLibro">Ingresar nuevo libro</button>
</div>

<?php
    $archivo = "libros.txt";
    if (file_exists($archivo)) {
    $libros = file($archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($libros as $libro) {
        list($titulo, $autor, $anio) = explode('|', $libro);
        echo "<div class='card p-3'>
                <h5 class='mb-1'>Título: $titulo</h5>
                <p class='mb-1'>Autor: $autor</p>
                <p class='mb-0'>Año: $anio</p>
            </div>";
    }
    } else {
    echo "<p>No hay libros registrados aún.</p>";
    }
?>
</div>

<div class="modal fade" id="modalLibro" tabindex="-1">
<div class="modal-dialog">
    <div class="modal-content">
    <form action="" method="POST">
        <div class="modal-header">
        <h5 class="modal-title">Nuevo Libro</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
        <div class="mb-3">
            <label class="form-label">Título</label>
            <input type="text" class="form-control" name="titulo" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Autor</label>
            <input type="text" class="form-control" name="autor" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Año</label>
            <input type="number" class="form-control" name="anio" required>
        </div>
        </div>
        <div class="modal-footer">
        <button type="submit" class="btn btn-success">Guardar</button>
        </div>
    </form>
    </div>
</div>
</div>

<footer class="bg-dark text-white text-center py-3 mt-5">
Desarrollado por Sharon Pineda – Carnet: 202460509
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
$titulo = trim($_POST["titulo"]);
$autor = trim($_POST["autor"]);
$anio = trim($_POST["anio"]);

if ($titulo && $autor && $anio) {
    $linea = "$titulo|$autor|$anio\n";
    file_put_contents("libros.txt", $linea, FILE_APPEND);
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}
}
?>
