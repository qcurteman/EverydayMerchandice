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
 // Empty the shopCart records belonging to this $zo and anonymous $zc
 $s2 = "DELETE FROM shopCart WHERE OID=" . sqlq($zo) . " AND CID=" . sqlq($anonCID);
 $db->exec($s2);

 // ACHTUNG!!  Reset s string to an "empty" s string (see home.php)
 $zo = CreateNewRndSt();
 while(isUsedOID($zo,$db)) {
  $zo = CreateNewRndSt();
 }
 $s = $zo . "@0@" . $anonCID;
?>

<form method="post" name="frmNxp" action="home.php">
 <input type="hidden" name="s" value="<?php echo $s; ?>"/>
</form>
<script>document.frmNxp.submit();</script>

<?php include("dbCLose.inc.php"); ?>
</body>
</htmL>