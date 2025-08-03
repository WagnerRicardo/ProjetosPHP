<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>GET AND POST TEST</title>
</head>
<body>
    <h1>Place your order!</h1>

    <form action="index.php" method="get">
        <label for="foods">Select your food</label>
        <select id="foods" name="food">
            <option value="Pizza">Pizza</option>
            <option value="Burger">Burger</option>
            <option value="Burrito">Burrito</option>
        </select>

        <label for="quantity">Quantity: </label>
        <input id="quantity" name="quantity" type="number" min="0" required>

        <input type="submit" value="ORDER">

    </form>

</body>
</html>

<?php
    $foods = [
    "Pizza" => 50,
    "Burger" => 30,
    "Burrito" => 10
    ];

    $food = $_GET['food'];
    $price = $foods[$food];
    $quantity = $_GET['quantity'];
    $total = $quantity * $price;

    echo "<h2> You ordered {$quantity} {$food}/s </h2>";
    echo "<h3> Total is: \${$total} </h3>";


?>