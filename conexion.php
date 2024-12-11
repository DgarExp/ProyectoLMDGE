<?php
$mysqli = new mysqli('127.0.0.1', 'root', '', 'proyecto_gym_lm');

if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}