<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $json = file_get_contents('https://dummyjson.com/users');
    $data = json_decode($json, true);
    $usuarios = $data['users'] ?? [];

    foreach ($usuarios as $usuario) {
        if ($usuario['username'] === $username && $usuario['password'] === $password) {
            $_SESSION['usuario'] = $usuario;
            header('Location: pController.php');
            exit;
        }
    }

    $error = "Usuario o contraseña incorrectos.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }
        .login-container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px #ccc;
            width: 300px;
        }
        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #0077cc;
            color: white;
            border: none;
            cursor: pointer;
        }
        .error {
            color: red;
            font-size: 0.9em;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php if (isset($error)): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="POST" action="login.php">
            <input type="text" name="username" placeholder="Usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>