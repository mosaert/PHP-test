<?php
$json = file_get_contents('https://dummyjson.com/products');
$data = json_decode($json, true);
$productos = $data['products'] ?? [];

$categorias = array_unique(array_map(fn($p) => $p['category'], $productos));
sort($categorias);

if (isset($_GET['category'])) {
    $productos = array_filter($productos, fn($p) => $p['category'] === $_GET['category']);
}
?>

<h1>Productos</h1>

<div class="categoria-container">
    <button class="categoria-btn" onclick="toggleCategorias()">Categorías ⮟</button>
    <div class="categoria-menu" id="categoriaMenu">
        <a href="pController.php">Todas</a>
        <?php foreach ($categorias as $cat): ?>
            <a href="pController.php?category=<?= urlencode($cat) ?>">
                <?= ucfirst($cat) ?>
            </a>
        <?php endforeach; ?>
    </div>
</div>

<div class="productos-grid">
    <?php foreach ($productos as $producto): ?>
        <a href="iController.php?id=<?= $producto['id'] ?>" class="producto-card">
            <img src="<?= $producto['images'][0] ?>" alt="<?= htmlspecialchars($producto['title']) ?>">
            <h3><?= htmlspecialchars($producto['title']) ?></h3>
            <p>$<?= $producto['price'] ?></p>
        </a>
    <?php endforeach; ?>
</div>

<script>
    function toggleCategorias() {
        const menu = document.getElementById('categoriaMenu');
        menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
    }
    document.addEventListener('click', function(e) {
        const menu = document.getElementById('categoriaMenu');
        const btn = document.querySelector('button');
        if (!menu.contains(e.target) && e.target !== btn) {
            menu.style.display = 'none';
        }
    });
</script>