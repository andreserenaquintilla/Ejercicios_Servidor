<?php
declare(strict_types=1);
session_start();
if (isset($_SESSION['usuario'])) {
  require(__DIR__ . '/../views/dashboard.php');
} else {
  require(__DIR__ .'/../views/login.php');
}