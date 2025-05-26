<?php
$json = file_get_contents('https://dummyjson.com/products');
$data = json_decode($json, true);
$productos = $data['products'] ?? [];
?>

<h1>Productos</h1>
<div style="display: flex; flex-wrap: wrap; gap: 20px;">
<?php foreach ($productos as $producto): ?>
    <a href="iController.php?id=<?= $producto['id'] ?>" style="text-decoration: none; color: inherit;">
        <div style="border: 1px solid #ccc; padding: 10px; width: 200px;">
            <img src="<?= $producto['images'][0] ?>" alt="" style="width: 100%; height: auto;">
            <h3><?= htmlspecialchars($producto['title']) ?></h3>
            <p>$<?= $producto['price'] ?></p>
        </div>
    </a>
<?php endforeach; ?>
</div>