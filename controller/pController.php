<?php
$titulo = 'Catálogo de productos';
$contenido = 'content/pContent.php';
$selectedCategory = $_GET['category'] ?? null;
include '../template.php';