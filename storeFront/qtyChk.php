<?php
 // http://127.0.110.1/110_myStore/storeFront/qtyChk.php
 // http://csci.jessup.edu/csci110/110_myStore/storeFront/qtyChk.php

 include("../myStore_func.inc.php");
 include("dbOpen.inc.php");
 include("fdaleGlob.inc.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>qtyChk.php</title>
</head>
<body>

 <?php
 //get info from user. Make sure it is a number. check if it is greater than or equal to zero. If it is zero or less
 //erase from database. Update if greater than 0.
 //check if the shopping cart is empty after removing item from Shopping cart. If it is, delete the OID ($zo) in all other tables. (Same as in the bagDel.php)
 $emsg = ""; 

 $qty = trim(rqgp("qty"));
 if (!is_numeric($qty) && $emsg=="") {
  $emsg = "ERROR: Quantity must be numeric.";
 }

 $qtyPID = trim(rqgp("qtyPID"));
 if ( $qtyPID == "" && $emsg=="") {
  $emsg = "ERROR: No PID in shopping cart for customer.";
 }

 if ($qty > 0) {
  //$s1 = "SELECT Quantity FROM shopCart WHERE OID=" . sqlq($zo) . " AND PID=" . sqlq($qtyPID);
  //$s2 = $db->query($s1);
  //$row->setFetchMode(PDO::FETCH_ASSOC);
  //$dbQuantity = $row["Quantity"];

  $qtyUpdate = $qty;

  $s3 = "UPDATE shopCart SET Quantity=" . $qtyUpdate . " WHERE OID=" . sqlq($zo) . " AND PID=" . sqlq($qtyPID);
  $db->exec($s3);
 } else {
  $s2 = "DELETE FROM shopCart WHERE OID=" . sqlq($zo) . " AND PID=" . sqlq($qtyPID);
  $db->exec($s2);

  $s1 = "SELECT Count(OID) FROM shopCart WHERE OID=" . sqlq($zo);
  $hmny = $db->query($s1)->fetchColumn();
 
  if ( $hmny <= 0 ) {
   $s2 = "DELETE FROM orderHeader WHERE OID=" . sqlq($zo);
   $db->exec($s2);

   $s2 = "DELETE FROM orderBillTo WHERE OID=" . sqlq($zo);
   $db->exec($s2);

   $s2 = "DELETE FROM orderShipTo WHERE OID=" . sqlq($zo);
   $db->exec($s2);
  }
 }
 ?>

 <form method="post" name="frmNxp" action="shc.php">
  <input type="hidden" name="s" value="<?php echo $s; ?>"/>
  <input type="hidden" name="qtyPID" value="<?php echo $qtyPID; ?>"/>
 </form>
 <script>document.frmNxp.submit();</script>

 <?php include("dbCLose.inc.php"); ?>
</body>
</html>