<?php
include_once 'dbconfig.php';

function faucet($address, $ip, $mysqli) {
        
            //GET TIMESTAMP
            if ($stmt = $mysqli->prepare("SELECT time FROM payouts WHERE address = ? ORDER BY id DESC LIMIT 1")) {
            $stmt->bind_param('s', $address);  
            $stmt->execute();    // Execute the prepared query.
            $stmt->store_result();
 
            // get variables from result.
            $stmt->bind_result($timestamp);
            $stmt->fetch();
            
            
        
                if($timestamp <= strtotime("-12 hours")) {
                    
                //GET IP ADDRESS
                if ($stmt = $mysqli->prepare("SELECT time FROM payouts WHERE ip = ? ORDER BY id DESC LIMIT 1")) {
                    $stmt->bind_param('s', $ip);  
                    $stmt->execute();    // Execute the prepared query.
                    $stmt->store_result();
 
                    // get variables from result.
                    $stmt->bind_result($timestamp_ip);
                    $stmt->fetch();
                    
                        if ($timestamp_ip <= strtotime("-12 hours")) {
                            
                            return $address;
                            
                        }else {
                            //NEED TO WAIT UNTIL 12 HOURS AFTER LAST FAUCET 
                    
                            return false;
                            
                        }
                    }
                
                }else {
                    //NEED TO WAIT UNTIL 12 HOURS AFTER LAST FAUCET 
                    
                    
                    return false;
                }
                
            
        
        }else {
            // NO FAUCET RECORD FOUND ON USER 
                
                return $address;
                
                
        }
        
    
}



?>