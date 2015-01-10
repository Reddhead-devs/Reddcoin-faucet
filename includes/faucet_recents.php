<?php
include_once 'dbconnect.php';

date_default_timezone_set('America/New_York'); 

$stmt = $mysqli->query("SELECT id, address, time FROM payouts ORDER BY id DESC LIMIT 10");
 while ($row = $stmt->fetch_array()) {
$id = $row['id'];
$address = $row['address'] ;
$time = date("F j, g:ia", $row['time']);
//make a display block to display the results on a html table row at a time
$display_block .= "

<tr>

<td width=\"10%\">" . $id . "</td>

<td width=\"45%\">" . $address . "</td>
<td width=\"45%\">" . $time . "</td>

</tr>" ;
} //close the while loop
// close the php and start a html table

?>

<tr id="title">
<td id="payoutnumtbl" width="20%"><strong>Payout #</strong></td>
<td id="usertbl" width="40%"><strong>Address</strong></td>
<td id="timetbl" width="40%"><strong>Time (EST.)</strong></td>
</tr>
<?php //open a php block to populate the table
echo $display_block ;
//close the php block and then the table


 
    

        

       