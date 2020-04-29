<?php

require dirname(dirname(__FILE__)). DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';


/*$instanceV = new Ademakanaky\Payout();
$details = $instanceV->initiateTransfer('011','3038739704','1600','Job well done');

echo $details;*/

$wallet = new Ademakanaky\Airtime();
$walletDetails = $wallet->purchase('airtel', '07068260000', '100');
echo $walletDetails;

