<?php
declare(strict_types= 1);
session_start();
$_SESSION = [];
setcookie(session_name(), '', time() - 42000, '/');
session_destroy();