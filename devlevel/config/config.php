<?php
declare(strict_types=1);

// Roles
const ROL_JUNIOR = 'DEVELOPER_JUNIOR';
const ROL_SENIOR = 'DEVELOPER_SENIOR';
const ROL_PM = 'PROJECT_MANAGER';

// Sesión: 20 minutos sin actividad y se cierra
const TIMEOUT_SESION = 20 * 60;

// Cookie de "Recordar usuario": 30 días
const COOKIE_RECORDAR = 'devlevel_remember_user';
const DURACION_COOKIE = 30 * 24 * 60 * 60;

// XP mínima para llegar a cada nivel (tabla 4.1 del enunciado)
const NIVELES = [1 => 0, 2 => 100, 3 => 250, 4 => 450, 5 => 700];
const UMBRAL_SENIOR = 450;