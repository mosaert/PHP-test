<?php
if (!isset($_GET['id'])) {
    header('Location: pController.php');
    exit;
}

$titulo = 'Detalle del producto';
$contenido = 'iContent.php';
include 'template.php';
