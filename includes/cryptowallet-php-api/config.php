<?php
/*
	Original source from: Shane B. (Xenland)
	Modified by: Antoan Stoykov
	
	Date: Sep, 2014
	
	Purpose: To provide a drop-in library for php programmers that are not educated in the art of financial security and programming methods.
	Last Updated in Version: 0.0.x
	Donation Bitcoin Address (Shane B.): 13ow3MfnbksrSxdcmZZvkhtv4mudsnQeLh
	Donation Reddcoin Address (Antoan Stoykov): Ro9D17Q9E3vrSPZxKt5gePSE9dyCeqkkk2
	Website: http://alienshaped.com http://bitcoindevkit.com
	
	License (AGPL)
*/
	/*
		Select the hashing function you would like to use to experience data integrity with your transactions
	*/
	$settings["hash_type"] = "sha256"; //What should the hash() function use?
	$settings["coin_authentication_timeout"] = 1200; //How much time (in seconds) how long a user has to authenticate their identity before a signature is considered expired
	
	//Define some server configuration settings
	$server["https"]	= "http"; //HTTPS is recommended....
	$server["host"]	= "127.0.0.1"; //Just the domainname don't put Http:// or https:// that is already taken care of. (HIGHLY RECOMENDED TO USE WALLET ON SAME SERVER IF YOU DO NOT HAVE HTTPS FOR RPC)
	$server["user"]	= "user";//username in reddcoin.conf (make very strong you do not need to remember it)
	$server["pass"]	= "pass"; //password in reddcoin.conf (make very strong you do not need to remember it)
	$server["port"]	= "45443";//rpcport in reddcoin.conf (if there is one there change this to that, else set it to this)
	
	//Define Integrity checks (checksum details)
	$integrity_check = ''; //Generate a random string that is atleast 4096 characters long, Random number here:  http://textmechanic.com/Random-String-Generator.html