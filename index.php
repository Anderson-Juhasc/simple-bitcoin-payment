<?php

$productName = "Produto #1";
$productValue = number_format(25.00, 2);
$oneBTCinSatoshis = 100000000;
$askBtcAverage = json_decode(file_get_contents("https://api.bitcoinaverage.com/ticker/USD/"), true)[ask];
$oneUSDinSatoshis = ($oneBTCinSatoshis / $askBtcAverage);
$productInSatoshis = ceil($productValue * $oneUSDinSatoshis);
$productInBTC = number_format($productInSatoshis / $oneBTCinSatoshis, 8);

?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<title>Products</title>
</head>
<body>
    <ul>
        <li><?php echo $productName; ?></li>
        <li>Preço em USD: <?php echo $productValue; ?></li>
        <li>
            <a href="payment.php?name=<?php echo urlencode($productName); ?>&value=<?php echo $productValue; ?>">Pagar</a>
        </li>
    </ul>
</body>
</html>
