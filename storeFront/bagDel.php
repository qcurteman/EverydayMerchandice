<?php
 // http://127.0.110.1/110_myStore/storeFront/bagDel.php
 // http://csci.jessup.edu/csci110/110_myStore/storeFront/bagDel.php

 include("../myStore_func.inc.php");
 include("dbOpen.inc.php");
 include("fdaleGlob.inc.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>bagDel.php</title>
</head>
<body>

 <?php
 $s2 = "DELETE FROM shopCart WHERE OID=" . sqlq($zo);
 $db->exec($s2);

 $s2 = "DELETE FROM orderHeader WHERE OID=" . sqlq($zo);
 $db->exec($s2);

 $s2 = "DELETE FROM orderBillTo WHERE OID=" . sqlq($zo);
 $db->exec($s2);

 $s2 = "DELETE FROM orderShipTo WHERE OID=" . sqlq($zo);
 $db->exec($s2);
 ?>

 <form method="post" name="frmNxp" action="home.php">
  <input type="hidden" name="s" value="<?php echo $s; ?>"/>
 </form>
 <script>document.frmNxp.submit();</script>

 <?php include("dbCLose.inc.php"); ?>
</body>
</html>