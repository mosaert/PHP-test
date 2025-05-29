<?php
$id = (int)$_GET['id'];
$json = file_get_contents("https://dummyjson.com/products/$id");
$producto = json_decode($json, true);

if (!$producto) {
    echo "<p>Producto no encontrado.</p>";
    return;
}
?>

<div class="detalle-producto-container">
    <a href="../controller/pController.php" class="btn-volver">⬅ Volver al catálogo</a>

    <div class="producto-detalle">
        <div class="imagen-principal">
            <img src="<?= htmlspecialchars($producto['images'][0]) ?>" alt="<?= htmlspecialchars($producto['title']) ?>">
        </div>

        <div class="info-producto">
            <h1><?= htmlspecialchars($producto['title']) ?></h1>
            <p><strong>Marca:</strong> <?= htmlspecialchars($producto['brand']) ?></p>
            <p><strong>Categoría:</strong> <?= htmlspecialchars($producto['category']) ?></p>
            <p><strong>Precio:</strong> $<?= $producto['price'] ?></p>
            <p><strong>Rating:</strong> ⭐ <?= $producto['rating'] ?>/5</p>
            <p><?= htmlspecialchars($producto['description']) ?></p>
        </div>
    </div>

    <?php if (!empty($producto['reviews'])): ?>
        <section class="reseñas">
            <h2>Reseñas</h2>
            <?php foreach ($producto['reviews'] as $review): ?>
                <div class="review-card">
                    <div class="review-header">
                        <strong><?= htmlspecialchars($review['reviewerName']) ?></strong>
                        <span>⭐ <?= $review['rating'] ?>/5</span>
                    </div>
                    <p><?= htmlspecialchars($review['comment']) ?></p>
                    <small><?= date('d/m/Y', strtotime($review['date'])) ?></small>
                </div>
            <?php endforeach; ?>
        </section>
    <?php else: ?>
        <p>No hay reseñas disponibles.</p>
    <?php endif; ?>
</div>