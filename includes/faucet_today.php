<?php
include_once 'dbconnect.php';
$today = 0;
$stmt = $mysqli->query("SELECT time FROM payouts");
 while ($row = $stmt->fetch_array()) {
     if($row['time'] >= strtotime("-24 hours")) {
                    
                    $today++;
                    
                
    }
 }

echo $today;