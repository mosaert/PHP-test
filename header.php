<?php
// SOLO en páginas que ya hayan validado sesión

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

$user = $_SESSION['usuario'];
?>

<div class="user-info">
    <div>
        <?= htmlspecialchars($user['firstName'] . ' ' . $user['lastName']) ?>
    </div>
    <div>
        <a href="logout.php">Cerrar sesión</a>
    </div>
</div>

<style>
    .user-info {
        position: fixed;
        top: 10px;
        right: 10px;
        text-align: right;
        background-color: #f0f0f0;
        padding: 10px;
        border-radius: 8px;
        font-size: 14px;
        box-shadow: 0 0 5px rgba(0,0,0,0.1);
        max-width: 220px;
    }
    .user-info a {
        color: #333;
        text-decoration: none;
        font-weight: bold;
        margin-left: 10px;
    }
</style>