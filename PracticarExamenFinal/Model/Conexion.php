<?php

class Conexion {
    public static function conectar() {
        $host = 'localhost';
        $db   = 'gestion_alquiler'; // ⚠️ Cambia esto por el nombre de tu BD en phpMyAdmin
        $user = 'root';                        // Usuario por defecto en XAMPP
        $pass = 'toor';                            // Contraseña por defecto en XAMPP (vacía)
        $charset = 'utf8mb4';

        try {
            $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
            $pdo = new PDO($dsn, $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}