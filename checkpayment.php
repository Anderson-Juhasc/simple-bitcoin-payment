<?php
require 'config.php';

$address = $_POST['address'];

$bal = json_decode(file_get_contents("https://blockchain.info/merchant/$ID/address_balance?password=$PW&address=$address&confirmations=0"), true);

$parseBal = $bal[balance];

echo json_encode($parseBal);
