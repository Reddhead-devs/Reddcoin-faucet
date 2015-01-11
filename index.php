<?php
/*
    Copyright (C) 2015  iisurge
    Reddcoin-faucet comes with ABSOLUTELY NO WARRANTY
    This is free software, and you are welcome to redistribute it
    under certain conditions
    
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
*/
include_once 'includes/dbconnect.php';
include "includes/cryptowallet-php-api/config.php";
include "includes/cryptowallet-php-api/lib/jsonRPCClient.php";
include "includes/cryptowallet-php-api/lib/Crypto.php";

$crypt = new Crypto_API($integrity_check, $settings, $server);


//GOOGLE CAPTCHA
$msg='';
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $recaptcha=$_POST['g-recaptcha-response'];
    if(!empty($recaptcha)) {
            include("getCurlData.php");
            $google_url="https://www.google.com/recaptcha/api/siteverify";
            $secret='Google Secret Key';
            $ip=$_SERVER['REMOTE_ADDR'];
            $url=$google_url."?secret=".$secret."&response=".$recaptcha."&remoteip=".$ip;
            $res=getCurlData($url);
        $res= json_decode($res, true);
        //reCaptcha success check 
        if($res['success']) {
            //Include login check code
        }
        else
        {
            $msg="Please re-enter your reCAPTCHA.";
}

}
else
{
$msg="Please re-enter your reCAPTCHA.";
}

}

if ($crypt->open_connection()) {

?>
<html>
<head>
<title>Faucet</title>   
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="faucet.css" rel="stylesheet" />
    
    <script>
        $(document).ready(function() {
            $("#balf").load('includes/faucet_bal.php');
			$(".recents").load('includes/faucet_recents.php');
            $("#payedout").load('includes/faucet_payed.php');
            $("#today").load('includes/faucet_today.php');
            
            $("#faucetform").submit(function() {
                var serializedValues = jQuery("#faucetform").serialize();
                jQuery.ajax({ type: 'POST',url:"includes/verify_captcha.php",data: serializedValues,success:function(result){
                    if(result){
                        $.post('includes/faucet_pay.php', $('#faucetform').serialize(), function(data) {
                
                if (data == "Success: You have been sent 5 RDD! Please wait atleast 12 hours before redeeming again") {
                    
                    $("#return").html('<div class="alert alert-success alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + data + '</div>');
                }else {
                $("#return").html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span> ' + data + '</div>');
                }
                
                 
            });
                    }else {
                     $("#return").html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span> Invalid Captcha!</div>');   
                    }
                }});
                $("#balf").load('includes/faucet_bal.php');
                return false;
			
		      });

        });
        
   
        
		function updateShouts(){
			$('.recents').load('includes/faucet_recents.php');
            $("#balf").load('includes/faucet_bal.php');
            
		}
		setInterval('updateShouts()', 10000);
        
        function statupdate(){
         $("#payedout").load('includes/faucet_payed.php');
            $("#today").load('includes/faucet_today.php');   
        }
        setInterval('statupdate()', 60000);
        
 var onloadCallback = function() {
 grecaptcha.render('captcha_ele', {
 'sitekey' : '', // google re-captcha Site key
 });
 };
        </script>

</head>
    <body>
        <div id="return">
        </div>
        <h1 id="topbal">Faucet Balance: <b id="balf"></b><img src='imgs/logo-only.png' style=' margin-left: 5px; margin-top: -0.33em; height: 1.5em; width: auto; ' /></h1>
    
    
    <div id="formcontainer">
    <form id="faucetform">
        <input type="text" name="faucet-pay" class="form-control" placeholder="Rsurge4R9r1XWfPpkRMZ95p7AXsez7tFqw">
        <div id="captcha_ele"></div><br />
        <input type="submit" style="font-size: 2em;" class="btn btn-success"  value="Redeem" /> 
      
    </form>
    </div>
    
        <div class="stats">
        <h4 style="padding-top: 5px;">Stats</h4>
        Payout: 5<img src='imgs/logo-only.png' style=' margin-left: 5px; margin-top: -0.33em; height: 1.5em; width: auto; ' /><br />
        Redemptions In Last 24 Hours: <b id="today"></b><br />
        Wait Period: 12 hours<br />
        Total Paid Out: <b id="payedout"></b><img src='imgs/logo-only.png' style=' margin-left: 5px; margin-top: -0.33em; height: 1.5em; width: auto; ' /><br />
        Direct Faucet Donations:<br /> RmaQLkiebAgCCRTwyz73JZqcPZD47qLH6K <!--PUT YOUR FAUCET ADDRESS HERE -->
        <br />
            <br />
        </div>
        <br><br>
        
        <table class="recents"  width="98%" border="1" align="center">
        
            
        </table>
        <br /><br /><br />
        <script src="js/bootstrap.js"></script>
        <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit&response=yes" async defer></script>
 </body>
    </body>
</html>

<?php }else { echo "failed to connect to wallet, please try again later!"; }
