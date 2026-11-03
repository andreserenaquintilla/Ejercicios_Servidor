<?php
declare(strict_types=1);

$dsn = 'mysql:host=localhost;dbname=ludoteca;charset=utf8mb4';

try {
  $pdo = new PDO($dsn, 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
  ]);
} catch (PDOException $e) {
  error_log('Error de conexión: ' . $e->getMessage());
  exit('Error en el servicio de datos.');
}

echo 'Conectado';