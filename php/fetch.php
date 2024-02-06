<?php
include('database_connection.php');
$db = connectToDatabase();

// Récupérer la quantité totale de tous les produits
$sql_total = "SELECT SUM(Quantity) as total_quantity FROM commanddetail";
$result_total = $db->query($sql_total);
$data_total = $result_total->fetch();
$total_quantity = $data_total['total_quantity'];

// Récupérer les trois meilleurs produits
$sql = "SELECT * FROM commanddetail 
    JOIN product ON product.Refprod = commanddetail.Refprod 
    ORDER BY Quantity DESC LIMIT 3";
$result_join = $db->query($sql);

// Calculer le pourcentage et créer le JSON
$best_products = [];
$total_percentage = 0;
while ($row = $result_join->fetch(PDO::FETCH_ASSOC)) {
    $percentage = (($row['Quantity'] / $total_quantity) * 100);
    $row['percentage'] = $percentage;
    $best_products[] = $row;
    $total_percentage += $percentage;
}

$other_percentage = 100 - $total_percentage;
$other = array("ProdName" => "Other", "percentage" => $other_percentage);
$best_products[] = $other;
$best_products[] = $total_quantity;


echo json_encode($best_products);
