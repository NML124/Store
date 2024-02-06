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
            <div class=" menu-dashboard">
                <i class="fa-solid fa-gauge"></i>
                <h2>Dashboard</h2>
            </div>
            <div class=" menu-dashboard">
                <i class="fa-solid fa-box"></i>
                <h2>Product</h2>
            </div>
            <div class=" menu-dashboard">
                <i class="fa-solid fa-basket-shopping"></i>
                <h2>Command</h2>
            </div>
            <div class=" menu-dashboard">
                <i class="fa-solid fa-user-nurse"></i>
                <h2>Employe</h2>
            </div>
            <div class=" menu-dashboard">
                <i class="fa-solid fa-globe"></i>
                <h2>Provider</h2>
            </div>
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
                                <h2 id="bestProductName"> name</h2>
                            </div>
                            <div>
                                <h3>Unit cost</h3>
                                <h2 id="bestProductCost"> 10</h2>
                            </div>
                            <div>
                                <h3>Quantity</h3>
                                <h2 id="bestProductQuantity"> 50</h2>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

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
                <tr>
                    <td>1</td>
                    <td id="idCustomer1">4565d8</td>
                    <td id="customerName1">Luc</td>
                    <td id="productName1">Pain</td>
                    <td id="orderDate1">10/10/2189</td>
                    <td id="price1">10$</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td id="idCustomer2">4565d8</td>
                    <td id="customerName2">Luc</td>
                    <td id="productName2">Pain</td>
                    <td id="orderDate2">10/10/2189</td>
                    <td id="price2">10$</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td id="idCustomer3">4565d8</td>
                    <td id="customerName3">Luc</td>
                    <td id="productName3">Pain</td>
                    <td id="orderDate3">10/10/2189</td>
                    <td id="price3">10$</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td id="idCustomer4">4565d8</td>
                    <td id="customerName4">Luc</td>
                    <td id="productName4">Pain</td>
                    <td id="orderDate4">10/10/2189</td>
                    <td id="price4">10$</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td id="idCustomer5">4565d8</td>
                    <td id="customerName5">Luc</td>
                    <td id="productName5">Pain</td>
                    <td id="orderDate5">10/10/2189</td>
                    <td id="price5">10$</td>
                </tr>
            </table>
        </div>
        </div>

    </section>
    <script type="text/javascript" src="./js/index.js"></script>
</body>

</html>