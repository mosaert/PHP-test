<?php
$json = file_get_contents('https://dummyjson.com/products');
$data = json_decode($json, true);
$productos = $data['products'] ?? [];

$categorias = array_unique(array_map(fn($p) => $p['category'], $productos));
sort($categorias);

?>

<h1>Productos</h1>

<div class="categoria-container">
    <button class="categoria-btn" onclick="toggleCategorias()">Categorías ⮟</button>
    <div class="categoria-menu" id="categoriaMenu">
        <a href="#" class="categoria-link" onclick="filtrarCategoria('Todas')">Todas</a>
        <?php foreach ($categorias as $cat): ?>
            <a href="#" class="categoria-link" onclick="filtrarCategoria('<?= $cat ?>')">
                <?= ucfirst($cat) ?>
            </a>
        <?php endforeach; ?>
    </div>
</div>

<div id="productos" class="productos-grid"></div>

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
        toggleCategorias();
        if (categoria === 'Todas') {
            mostrarProductos(productos);
        } else {
            const filtrados = productos.filter(p => p.category === categoria);
            mostrarProductos(filtrados);
        }
    }

    function toggleCategorias() {
        const menu = document.getElementById('categoriaMenu');
        menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
    }

    document.addEventListener('click', function(e) {
        const menu = document.getElementById('categoriaMenu');
        const btn = document.querySelector('.categoria-btn');
        if (!menu.contains(e.target) && e.target !== btn) {
            menu.style.display = 'none';
        }
    });

    // carga todo al iniciar
    mostrarProductos(productos);
</script>