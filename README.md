# OPEN SOURCE REDDCOIN FAUCET #

This is a faucet for someone who wants to run a service but doesn't have the time/knowledge to do so. 


### Prerequisites ###

* A server/VPS with reddcoind
* Knowledge on how to set up a database and user
* Basic php knowledge is highly recommended


### Set Up ###

* Configure reddcoin.conf with a user and pass
* Configure includes/cryptowallet-php-api/config.php
* Configure and follow instructions in includes/dbconfig.php
* Set up captcha with https://www.google.com/recaptcha
* Set site-key from recaptcha near the bottom of the head tag in index.php
* Set Secret key from recaptcha in includes/verify_captcha.php
* Create an address in reddcoind labeled "faucet" and deposit funds
* Set direct faucet donation address in index.php

Have any issues? Let me know on [Reddcointalk](https://www.reddcointalk.org/user/iisurge)

### Donations ###

    Rsurge4R9r1XWfPpkRMZ95p7AXsez7tFqw

### Default but configurable options ###

* Default wait period is 12 hours (Can be modified in includes/functions.php and includes/faucet_pay.php)
* Table and faucet balance update every 10 second (Can be modified in index.php)
* Total amount payed out and Number of payouts today updated every 60 seconds (Can be modified in index.php)
* Table shows last 10 (Can be modified in includes/faucet_recents.php)

### How does it stop someone from receiving twice? ###

* It logs address and IP so they can't receive twice from either in one time frame