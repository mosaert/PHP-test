<?php
$id = (int)$_GET['id'];
$json = file_get_contents("https://dummyjson.com/products/$id");
$producto = json_decode($json, true);

if (!$producto) {
    echo "<p>Producto no encontrado.</p>";
    return;
}
?>

<div style="margin-bottom: 20px;">
    <a href="../controller/pController.php" style="
        display: inline-block;
        padding: 8px 16px;
        background-color: #0077cc;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        font-weight: bold;
    ">
        ⬅ Volver al catálogo
    </a>
</div>

<h1><?= htmlspecialchars($producto['title']) ?></h1>

<div style="display: flex; gap: 30px;">
    <div>
        <img src="<?= htmlspecialchars($producto['images'][0]) ?>" alt="<?= htmlspecialchars($producto['title']) ?>" style="width: 300px; height: auto; border-radius: 4px;">
    </div>
    <div>
        <p><strong>Marca:</strong> <?= htmlspecialchars($producto['brand']) ?></p>
        <p><strong>Categoría:</strong> <?= htmlspecialchars($producto['category']) ?></p>
        <p><strong>Precio:</strong> $<?= $producto['price'] ?></p>
        <p><strong>Rating:</strong> <?= $producto['rating'] ?>/5</p>
        <p><strong>Descripción:</strong></p>
        <p><?= htmlspecialchars($producto['description']) ?></p>
    </div>
</div>

<?php if (!empty($producto['reviews'])): ?>
    <h2>Reseñas</h2>
    <div style="margin-top: 10px;">
        <?php foreach ($producto['reviews'] as $review): ?>
            <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px; border-radius: 6px;">
                <strong><?= htmlspecialchars($review['reviewerName']) ?></strong>
                <span style="float:right;">⭐ <?= $review['rating'] ?>/5</span>
                <p><?= htmlspecialchars($review['comment']) ?></p>
                <small><?= date('d/m/Y', strtotime($review['date'])) ?></small>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>No hay reseñas disponibles.</p>
<?php endif; ?>