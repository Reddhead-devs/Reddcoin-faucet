<?php 

include "cryptowallet-php-api/config.php";
include "cryptowallet-php-api/lib/jsonRPCClient.php";
include "cryptowallet-php-api/lib/Crypto.php";


$crypt = new Crypto_API($integrity_check, $settings, $server);

if ($crypt->open_connection()) {

echo $crypt->get_balance('faucet'); 
}