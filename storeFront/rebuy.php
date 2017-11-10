<?php
 include("../myStore_func.inc.php");
 include("dbOpen.inc.php");
 include("fdaleGlob.inc.php");
?>

<!DOCTYPE html>
<html lang="en">
<head><title><?php echo $storeName ?></title></head>
<body>

<?php
 $reBuyOID = rqgp("reBuy");

 // DOES THERE EXIST ...?
 $s1 = "SELECT Count(OID) FROM shopCart WHERE OID=" . sqlq($zo);
 $hmny = $db->query($s1)->fetchColumn();

 if ($hmny > 0) {
  $warnMsg = "WARNING: Shopping cart is not empty. Cannot restart incomplete order #" . $reBuyOID;

 } else {
  $warnMsg = "";
  // Make a $zoNew to replace existing orderHeader.[reBuy]OID and shopCart.[reBuy]OID
  $zoNew = CreateNewRndSt();
  while(isUsedOID($zoNew,$db)) {
   $zoNew = CreateNewRndSt();
  }

  $s2 = "UPDATE orderHeader SET OID=" . sqlq($zoNew) . " ";
  $s2 = $s2 . "WHERE OID=" . sqlq($reBuyOID) . " AND CID=" . sqlq($zc);
  $db->exec($s2);
  $s2 = "UPDATE orderBillTo SET OID=" . sqlq($zoNew) . " ";
  $s2 = $s2 . "WHERE OID=" . sqlq($reBuyOID) . " AND CID=" . sqlq($zc);
  $db->exec($s2);
  $s2 = "UPDATE orderShipTo SET OID=" . sqlq($zoNew) . " ";
  $s2 = $s2 . "WHERE OID=" . sqlq($reBuyOID) . " AND CID=" . sqlq($zc);
  $db->exec($s2);
  $s2 = "UPDATE shopCart SET OID=" . sqlq($zoNew) . " ";
  $s2 = $s2 . "WHERE OID=" . sqlq($reBuyOID) . " AND CID=" . sqlq($zc);
  $db->exec($s2);

  // Change $zo in $s string to $zoNew to resume the incomplete order.
  $s = $zoNew . "@1@" . $zc;
 }
?>

<form method="post" name="frmNxp" action="shc.php">
 <input type="hidden" name="warnMsg" value="<?php echo $warnMsg; ?>"/>
 <input type="hidden" name="s" value="<?php echo $s; ?>"/>
</form>
<script>document.frmNxp.submit();</script>

<?php include("dbCLose.inc.php"); ?>
</body>
</htmL>