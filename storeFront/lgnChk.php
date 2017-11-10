<?php
 include("../myStore_func.inc.php");
 include("dbOpen.inc.php");
 include("fdaleGlob.inc.php");
?>

<!DOCTYPE html>
<html lang="en">
<head><title>Flamingdale Mercantile</title></head>
<body>

<?php
 $tgPg = rqgp("tgPg");

 $emsg = "";

 $eml = trim(rqgp("eml"));
 if ($eml=="") {
  $emsg = "ERROR: A valid e-mail address is required.";
 }

 $pwd = trim(rqgp("pwd"));
 if ($pwd=="" && $emsg=="") {
  $emsg = "ERROR: A password is required.";
 }

 if ($emsg=="") {
  // DOES THERE EXIST ...?
  $s1 = "SELECT Count(CID) FROM customer WHERE Email=" . sqlq($eml) . " AND LgnPswd=" . sqlq($pwd);
  $hmny = $db->query($s1)->fetchColumn();
  if ($hmny < 1) {
   $emsg = "ERROR: Invalid e-mail address and/or password.";
  }
 }
 if ($emsg=="") {
  // DOES THERE EXIST ...?
  $s1 = "SELECT Count(CID) FROM customer ";
  $s1 = $s1 . "WHERE Email=" . sqlq($eml) . " AND LgnPswd=" . sqlq($pwd) . " AND Enabled=1";
  $hmny = $db->query($s1)->fetchColumn();
  if ($hmny < 1) {
   $emsg = "ERROR: Login denied.";
  }
 }
?>

<?php if ($emsg <> "") { ?>
  <form method="post" name="frmNxp" action="lgn.php">
   <input type="hidden" name="ErrorLgn" value="<?php echo $emsg; ?>"/>
   <input type="hidden" name="eml" value="<?php echo $eml; ?>"/>
   <input type="hidden" name="pwd" value="<?php echo $pwd; ?>"/>
   <input type="hidden" name="tgPg" value="<?php echo $tgPg; ?>"/>
   <input type="hidden" name="s" value="<?php echo $s; ?>"/>
  </form>
<?php } ?>

<?php if ($emsg=="") { ?>
<?php
  // FETCH ONE ROW OF DATA
  $s1 = "SELECT CID FROM customer WHERE Email=" . sqlq($eml) . " AND LgnPswd=" . sqlq($pwd);
  $s2 = $db->query($s1);
  $row = $s2->fetch(PDO::FETCH_ASSOC);
  $dbCID = $row["CID"];

  // ACHTUNG!!  Update the s string.
  $s = $zo . "@1@" . $dbCID;

  // Update shopCart records that now belong to this $dbCID customer.
  $s2 = "UPDATE shopCart SET CID=" . sqlq($dbCID) . " WHERE OID=" . sqlq($zo);
  $db->exec($s2);

  // Decide where to go next
  if ($tgPg=="pch") {
   $nxPg = "pch.php";
  } elseif ($tgPg=="lso") {
   $nxPg = "lso.php";
  } elseif ($tgPg=="myacct") {
   $nxPg = "myacct.php";
  } else {
   $nxPg = "home.php";
  }
?>
  <form method="post" name="frmNxp" action="<?php echo $nxPg; ?>">
   <input type="hidden" name="s" value="<?php echo $s; ?>"/>
  </form>
<?php } ?>

<script>document.frmNxp.submit();</script>

<?php include("dbCLose.inc.php"); ?>
</body>
</htmL>