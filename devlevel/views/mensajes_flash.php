<?php
// Si hay un mensaje pendiente en la sesión, lo enseño y lo borro
if (isset($_SESSION['flash'])) {
    echo '<p class="flash">' . e($_SESSION['flash']) . '</p>';
    unset($_SESSION['flash']);
}