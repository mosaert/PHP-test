<?php
$json = file_get_contents('https://dummyjson.com/products');
$data = json_decode($json, true);
$productos = $data['products'] ?? [];

$categorias = array_unique(array_map(fn($p) => $p['category'], $productos));
sort($categorias);

?>

<h1>Productos</h1>

<div class="catalogo-layout">
    <aside class="categorias-lista">
        <h3>Categorías</h3>
        <ul>
            <li><a href="#" onclick="filtrarCategoria('Todas')">Todas</a></li>
            <?php foreach ($categorias as $cat): ?>
                <li><a href="#" onclick="filtrarCategoria('<?= $cat ?>')"><?= ucfirst($cat) ?></a></li>
            <?php endforeach; ?>
        </ul>
    </aside>

    <section class="productos-grid" id="productos"></section>
</div>

<script>
    const productos = <?= json_encode($productos) ?>;
    const contenedor = document.getElementById('productos');

    function mostrarProductos(lista) {
        contenedor.innerHTML = '';
        lista.forEach(producto => {
            const card = document.createElement('a');
            card.href = `iController.php?id=${producto.id}`;
            card.className = 'producto-card';
            card.innerHTML = `
                <img src="${producto.images[0]}" alt="${producto.title}">
                <h3>${producto.title}</h3>
                <p>$${producto.price}</p>
            `;
            contenedor.appendChild(card);
        });
    }

    function filtrarCategoria(categoria) {
        if (categoria === 'Todas') {
            mostrarProductos(productos);
        } else {
            const filtrados = productos.filter(p => p.category === categoria);
            mostrarProductos(filtrados);
        }
    }
    
    // carga todo al iniciar
    mostrarProductos(productos);
</script>