<?php
$user = $_SESSION['usuario'] ?? null;

if (!$user) {
    echo "<p>No hay usuario autenticado.</p>";
    return;
}
?>

<h1>Perfil de <?= htmlspecialchars($user['firstName']) ?></h1>

<div style="display: flex; gap: 40px; margin-top: 20px;">
    <div>
        <img src="<?= htmlspecialchars($user['image']) ?>" alt="Avatar de usuario" style="width: 150px; border-radius: 50%; border: 2px solid #ccc;">
    </div>
    <div>
        <p><strong>Nombre:</strong> <?= htmlspecialchars($user['firstName'] . ' ' . $user['lastName']) ?></p>
        <p><strong>Correo:</strong> <?= htmlspecialchars($user['email']) ?></p>
        <p><strong>Teléfono:</strong> <?= htmlspecialchars($user['phone']) ?></p>
        <p><strong>Edad:</strong> <?= htmlspecialchars($user['age']) ?></p>
        <p><strong>Ciudad:</strong> <?= htmlspecialchars($user['address']['city']) ?></p>
        <p><strong>Dirección:</strong> <?= htmlspecialchars($user['address']['address']) ?></p>
        <p><strong>Compañía:</strong> <?= htmlspecialchars($user['company']['name']) ?></p>
    </div>
</div>
