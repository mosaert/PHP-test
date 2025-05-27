<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: auth/login.php');
    exit;
}
$user = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= $titulo ?? 'PHP Test' ?></title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
    <div class="wrapper">

        <header>
            <strong>PHP Test</strong>
            <div class="user-dropdown" onclick="toggleDropdown()">
                <?= htmlspecialchars($user['firstName'] . ' ' . $user['lastName']) ?> ⮟
                <div class="dropdown-content" id="userMenu">
                    <a href="pfController.php">Perfil</a>
                    <a href="../auth/logout.php">Cerrar sesión</a>
                </div>
            </div>
        </header>

        <main>
            <?php
            if (isset($contenido)) {
                include $contenido;
            } else {
                echo "<p>Error: contenido no definido.</p>";
            }
            ?>
        </main>

        <footer>
            <p>&copy; <?= date('Y') ?> Mi Tienda de Mentiritas. Todos los derechos reservados a mí.</p>
        </footer>
    </div>
    <script>
        function toggleDropdown() {
            const menu = document.getElementById('userMenu');
            menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
        }

        // Cerrar el menú si se hace clic fuera
        document.addEventListener('click', function(event) {
            const dropdown = document.querySelector('.user-dropdown');
            const menu = document.getElementById('userMenu');
            if (!dropdown.contains(event.target)) {
                menu.style.display = 'none';
            }
        });
    </script>
</body>
</html>