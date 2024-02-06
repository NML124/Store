<?php
function connectToDatabase()
{
    $localhost = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "db";

    try {
        $db = new PDO("mysql:host=$localhost;dbname=$dbname;charset=utf8", $username, $password);
        return $db;
    } catch (PDOException $e) {
        // Gérer les erreurs de connexion
        die("Erreur de connexion à la base de données: " . $e->getMessage());
    }
}
