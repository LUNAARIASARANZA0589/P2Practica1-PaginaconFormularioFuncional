<?php
$host = "localhost";
$db = "arinnsell";
$user = "root";
$pass = ""; 

try {
    $conexion = new PDO(
        "mysql:host=$host;dbname=$db;charset=utf8mb4",
        $user,
        $pass
    );

    $conexion->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );
} catch (PDOException $e) {
    error_log($e->getMessage());
    exit("No se pudo conectar con la base de datos.");
}