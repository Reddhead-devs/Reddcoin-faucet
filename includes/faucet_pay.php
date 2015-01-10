<?php
include_once 'dbconnect.php';
include_once 'functions.php';
include "cryptowallet-php-api/config.php";
include "cryptowallet-php-api/lib/jsonRPCClient.php";
include "cryptowallet-php-api/lib/Crypto.php";

$crypt = new Crypto_API($integrity_check, $settings, $server);

if ($crypt->open_connection()) {


if (isset($_POST['faucet-pay'])) {
    $address = $_POST['faucet-pay'];
    $ip = getenv('HTTP_CLIENT_IP')?:
          getenv('HTTP_X_FORWARDED_FOR')?:
          getenv('HTTP_X_FORWARDED')?:
          getenv('HTTP_FORWARDED_FOR')?:
          getenv('HTTP_FORWARDED')?:
          getenv('REMOTE_ADDR');
   
        //VERIFY ADDRESS
        include('address_check.php');
        $validator = new ReddCoinAddressValidator();
        $isValid = $validator->checkAddress($find);
        
    if (($isValid ? true  : false) == true) {
            
       if (faucet($address, $ip, $mysqli) == $address) {
           
           if($crypt->get_balance('faucet') > 5) { 
               //SUCCESS
                $payout = $crypt->coin_to_satoshi(5);
                $crypt->sendfrom('faucet', $address, $payout);
                $now = time();
                $mysqli->query("INSERT INTO payouts(address, ip, time) VALUES ('$address', '$ip', '$now')");
                echo 'Success: You have been sent 5 RDD! Please wait atleast 12 hours before redeeming again';
           }else {
               //faucet has less then 5 coins
               echo 'Error: Faucet to low';
           }
       }else if (faucet($address, $ip, $mysqli) == false)  {
           //Error getting rdd address label
           echo 'Error: Please wait 12 hours between each redemption!';
       }else {
           //user does not match
           echo 'Error: User Error';
       }
        
        
    
}else {
    //User accessed page by method other then clicking button
    header('Location: ../?error=UNKNOWN-ERROR');
}

}else {
      //Not a valid reddcoin address
     echo 'Error: Address entered is invalid';  
}

}else {
    //Failed to connect to wallet
     echo 'Error: Couldn\'t connect to wallet';
    
}

?>