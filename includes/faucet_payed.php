<?php
include_once 'dbconnect.php';


$stmt = $mysqli->query("SELECT * FROM payouts");




echo $stmt->num_rows *5;


