<?php
function connectToDatabase()
{
    $localhost = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "db";
    "Dans commandDetails"
    "le plus commandé : SELECT Nocom,Refprod,SUM(Quantity) as "Quantity",ROUND((Quantity*100/SUM(Quantity))) AS "Pourcentage"  FROM `commanddetail` GROUP by Refprod ORDER BY (Quantity*100/SUM(Quantity)) DESC;"

    try {
        $db = new PDO("mysql:host=$localhost;dbname=$dbname;charset=utf8", $username, $password);
        return $db;
    } catch (PDOException $e) {
        // Gérer les erreurs de connexion
        die("Erreur de connexion à la base de données: " . $e->getMessage());
    }
}
