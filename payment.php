<?php
require 'config.php';

$productName = $_GET['name'];
$productValue = $_GET['value'];
$oneBTCinSatoshis = 100000000;
$askBtcAverage = json_decode(file_get_contents("https://api.bitcoinaverage.com/ticker/USD/"), true)[ask];
$oneUSDinSatoshis = ($oneBTCinSatoshis / $askBtcAverage);
$productInSatoshis = ceil($productValue * $oneUSDinSatoshis);
$productInBTC = number_format($productInSatoshis / $oneBTCinSatoshis, 8);

$newAddy = json_decode(file_get_contents("https://blockchain.info/merchant/$ID/new_address?password=$PW"), true);
$parseAddy = $newAddy[address];

?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Payment</title>
</head>
<body>
    <form action="">
        <h1><?php echo $productName; ?></h1>
        <ul>
            <li><?php echo $productValue; ?></li>
            <li><?php echo $productInBTC; ?></li>
            <li><?php echo $parseAddy; ?></li>
            <li id="qrcode"></li>
        </ul>
    </form>

    <script type="text/javascript" src="bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="bower_components/jquery-qrcode/jquery.qrcode.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#qrcode').qrcode({"text": "bitcoin:<?php echo $parseAddy; ?>?amount=<?php echo $productInBTC; ?>", "height": 100, "width": 100});

            var json = { "address": "<?php echo $parseAddy; ?>" };
            setInterval(function() {
                $.post("checkpayment.php", json, function(data) {
                    if (data == <?php echo $productInSatoshis; ?>) {
                        window.location.href = "success.php";
                    } else {
                        console.log('Waiting...');
                    }
                });
            }, 1000);
        });
    </script>
</body>
</html>
