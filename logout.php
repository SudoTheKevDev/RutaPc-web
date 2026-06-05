<?php
// ============================================================
//  RutaPc – Cerrar sesión
//  logout.php
// ============================================================

require_once __DIR__ . '/includes/auth.php';

cerrarSesion();

header('Location: ' . APP_URL . '/login.php?logout=1');
exit;
