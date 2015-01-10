<?php

/**
 * These are the database login details
 * DO NOT USE ROOT, MAKE A NEW USER
 * THIS SCRIPT IS SET UP FOR YOU TO HAVE A DATABASE CALLED "faucet" AND A TABLE CALLED "payouts"
 * TABLE SHOULD HAVE 4 ROWS: 
 * id INT PRIMARY AUTO_INCREMENT 
 * address VARCHAR 50
 * time VARCHAR 128
 */  
define("HOST", "localhost");     // The host you want to connect to.
define("USER", "user");    // The database username. 
define("PASSWORD", "password");    // The database password. 
define("DATABASE", "faucet");    // The database name.
 
define("CAN_REGISTER", "any");
define("DEFAULT_ROLE", "member");
 

?>