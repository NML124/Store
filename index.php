<?php
include('php/database_connection.php');
$db = connectToDatabase();
/*For the command*/
$recup_command = $db->prepare('SELECT COUNT(*) AS NoCom FROM command');
$recup_command->execute();
$result_command = $recup_command->fetch();
$command = $result_command['NoCom'];

/*For the provider*/
$recup_provider = $db->prepare('SELECT COUNT(*) AS NoProvider FROM provider');
$recup_provider->execute();
$result_provider = $recup_provider->fetch();
$provider = $result_provider['NoProvider'];

/*For the customer*/
$recup_customer = $db->prepare('SELECT COUNT(*) AS CustomerCode FROM customer');
$recup_customer->execute();
$result_customer = $recup_customer->fetch();
$customer = $result_customer['CustomerCode'];


/*For the product*/
$recup_product = $db->prepare('SELECT COUNT(*) AS Refprod FROM product');
$recup_product->execute();
$result_product = $recup_product->fetch();
$product = $result_product['Refprod'];


/*For the best product*/
$sql_0 = "SELECT * FROM commanddetail 
        JOIN product ON product.Refprod = commanddetail.Refprod ORDER BY Quantity DESC LIMIT 1 ";
$result_join_0 = $db->query($sql_0);
$recup_best_product = $result_join_0->fetch();



/* Si tu efface le commentaire le code ne marche plus je sais pas pourquoi mais laisse simplement
$recup_best_product = $db->prepare('SELECT NoCom, COUNT(*) as nombre
FROM command
GROUP BY NoCom
ORDER BY nombre DESC
LIMIT 1');
$recup_best_product->execute();
$recup_best_product = $recup_best_product->fetch();
$recup_best_product_name = $recup_best_product['NoCom'];*/


/*For all command*/
$sql = "SELECT * FROM command 
        JOIN customer ON command.CustomerCode = customer.CustomerCode 
        JOIN commanddetail ON commanddetail.NoCom = command.NoCom
        JOIN product ON commanddetail.Refprod = product.Refprod";
$result_join = $db->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Dashboard</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
</head>

<body>
    <section class="right">
        <div class="rightTitle">
            <div class="shopTitle">
                <i class="fa-solid fa-shop"></i>
                <h1>Luc Shop</h1>
            </div>
            <div>
                <p>Where you can find everything</p>
            </div>
        </div>
        <hr>
        <div class="menu">
            <a href="#">
                <div class=" menu-dashboard selected">
                    <i class="fa-solid fa-gauge"></i>
                    <h2>Dashboard</h2>
                </div>
            </a>
            <a href="./Pages/product.html">
                <div class=" menu-dashboard">
                    <i class="fa-solid fa-box"></i>
                    <h2>Product</h2>
                </div>
            </a>
            <a href="./Pages/command.html">
                <div class=" menu-dashboard">
                    <i class="fa-solid fa-basket-shopping"></i>
                    <h2>Command</h2>
                </div>
            </a>
            <a href="./Pages/employe.html">

                <div class=" menu-dashboard">
                    <i class="fa-solid fa-user-nurse"></i>
                    <h2>Employe</h2>
                </div>
            </a>
            <a href="./Pages/Provider.html">
                <div class=" menu-dashboard">
                    <i class="fa-solid fa-globe"></i>
                    <h2>Provider</h2>
                </div>
            </a>

        </div>
    </section>
    <section class="left">
        <div class="greeting">
            <p>Welcome Back Luc !</p>
        </div>
        <div class="stats">
            <div class="card customer">
                <div class="barre">
                </div>
                <div>
                    <h3>Customer</h3>
                    <h2 id="numberCustomer"><?php echo $customer; ?></h2>
                </div>
            </div>
            <div class="card command">
                <div class="barre">
                </div>
                <div>
                    <h3>Command</h3>
                    <h2 id="numberCommand"><?php echo $command; ?></h2>
                </div>
            </div>
            <div class="card provider">
                <div class="barre">
                </div>
                <div>
                    <h3>Provider</h3>
                    <h2 id="numberProvider"><?php echo $provider; ?></h2>
                </div>
            </div>
            <div class="card revenue">
                <div class="barre">
                </div>
                <div>
                    <h3>Product</h3>
                    <h2 id="numberRevenue"><?php echo $product; ?></h2>
                </div>
            </div>
        </div>
        <div class="bestProduct">
            <div class="card">
                <div class="pieChartStats">
                    <div>
                        <h2> Best product</h2>
                    </div>
                    <div class="chart-container">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>

            </div>
            <div class="card">
                <div class="theBestProduct">
                    <div>
                        <h2>The best Product</h2>
                    </div>
                    <div class="flex">
                        <div class="image">
                            <img id="bestProductImage" src="./res/arbre.jpg" alt="BestProduct">
                        </div>
                        <div class="flex-description">
                            <div>
                                <h3>Product name</h3>
                                <h2 id="bestProductName"><?php echo $recup_best_product['ProdName'] ?></h2>
                            </div>
                            <div>
                                <h3>Unit cost</h3>
                                <h2 id="bestProductCost"><?php echo $recup_best_product['UnitPrice'] ?></h2>
                            </div>
                            <div>
                                <h3>Quantity</h3>
                                <h2 id="bestProductQuantity"><?php echo $recup_best_product['Quantity'] ?></h2>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="commands">
            <div class="card">
                <div>
                    <h2>
                        Commands
                    </h2>
                </div>
                <table>
                    <tr>
                        <th>No</th>
                        <th>Id customer</th>
                        <th> Customer name</th>
                        <th> Product name</th>
                        <th>Order date</th>
                        <th>Price</th>

                    </tr>
                    <?php
                    $i = 1;
                    while ($data = $result_join->fetch()) {
                        echo '<tr>';
                        echo '<td>' . $i . '</td>';
                        echo '<td id="idCustomer">' . $data['CustomerCode'] . '</td>';
                        echo '<td id="customerName">' . $data['Contact'] . '</td>';
                        echo '<td id="productName">' . $data['ProdName'] . '</td>';
                        echo '<td id="orderDate">' . $data['ComDate'] . '</td>';
                        echo '<td id="price">' . $data['UnitPrice'] . '$</td>';
                        echo '</tr>';
                        $i++;
                    }
                    ?>
                </table>
            </div>
        </div>

    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="./js/index.js"></script>
</body>

</html>