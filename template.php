<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}
$user = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= $titulo ?? 'PHP Test' ?></title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f0f0f0;
            padding: 10px 20px;
            position: relative;
        }

        header, footer {
            background-color: #f0f0f0;
            padding: 10px 20px;
        }

        header .user-info {
            float: right;
            font-size: 0.9em;
            text-align: right;
        }

        .user-dropdown {
            cursor: pointer;
            background-color: #f0f0f0;
            padding: 8px 12px;
            border-radius: 4px;
            font-size: 0.95em;
            position: relative;
        }

        .user-dropdown:hover {
            background-color: #e0e0e0;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            top: 35px;
            right: 0;
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 150px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            z-index: 100;
        }

        .dropdown-content a {
            display: block;
            padding: 10px;
            color: #333;
            text-decoration: none;
        }

        .dropdown-content a:hover {
            background-color: #f5f5f5;
        }

        main {
            flex: 1;
            padding: 20px;
        }

        footer {
            text-align: center;
            color: #777;
            border-top: 1px solid #ddd;
        }

        a {
            text-decoration: none;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="wrapper">

        <header>
            <strong>PHP Test</strong>
            <div class="user-dropdown" onclick="toggleDropdown()">
                <?= htmlspecialchars($user['firstName'] . ' ' . $user['lastName']) ?> ⮟
                <div class="dropdown-content" id="userMenu">
                    <a href="pfController.php">Perfil</a>
                    <a href="logout.php">Cerrar sesión</a>
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