<?php
 // http://127.0.110.1/110_myStore/storeFront/myacctChk.php
 // http://csci.jessup.edu/csci110/110_myStore/storeFront/myacctChk.php

 include("../myStore_func.inc.php");
 include("dbOpen.inc.php");
 include("fdaleGlob.inc.php");
?>

<!DOCTYPE html>
<html lang="en">
<head><title><?php echo $storeName ?></title></head>
<body>

<?php
 $emsg = "";

 // Capture & SANITIZE all incoming data
 $fnm = trim(rqgp("fnm"));
 if ($fnm=="" && $emsg=="") {
  $emsg = "ERROR: A First Name is required.";
 }

 $lnm = trim(rqgp("lnm"));
 if ($lnm=="" && $emsg=="") {
  $emsg = "ERROR: A Last Name is required.";
 }

 $eml = trim(rqgp("eml"));
 if ($eml=="") {
  $emsg = "ERROR: A Email name is required.";
 }
 if ($emsg=="") {
  // DOES THERE EXIST ...?
  $s1 = "SELECT Email FROM customer WHERE CID=". sqlq($zc);
  $s2 = $db->query($s1);
  $row = $s2->fetch(PDO::FETCH_ASSOC);
  $EmlTest = $row["Email"];

  $s1 = "SELECT Count(CID) FROM customer WHERE Email=" . sqlq($eml);
  $hmny = $db->query($s1)->fetchColumn();
  if ($hmny > 0 && $EmlTest != $eml) {
   $emsg = "ERROR: Email <u>" . $eml . "</u> already exists. Try another one.";
  }
 }

 $pswd = trim(rqgp("pswd"));
 if ($pswd=="" && $emsg=="") {
  $emsg = "ERROR: A Password is required.";
 }

 $addr = trim(rqgp("addr"));
 if ($addr=="" && $emsg=="") {
  $emsg = "ERROR: An address is required.";
 }

 $city = trim(rqgp("city"));
 if ($city=="" && $emsg=="") {
  $emsg = "ERROR: A city is required.";
 }

 $abrg = trim(rqgp("abrg"));
 if ($abrg=="" && $emsg=="") {
  $emsg = "ERROR: A State is required.";
 }

 $zip = trim(rqgp("zip"));
 if ($zip=="" && $emsg=="") {
  $emsg = "ERROR: A Zip code is required.";
 }

 if(!is_numeric($zip)) $emsg="ERROR: Zip must be numeric.";

 $ph1 = trim(rqgp("ph1"));
 if ($ph1=="" && $emsg=="") {
  $emsg = "ERROR: A Phone is required.";
 }

 $ph2 = trim(rqgp("ph2"));
 if ($ph2=="" && $emsg=="") {
  $emsg = "ERROR: A Phone is required.";
 }

 $ph3 = trim(rqgp("ph3"));
 if ($ph3=="" && $emsg=="") {
  $emsg = "ERROR: A Phone is required.";
 }

 if(!(is_numeric($ph1) && is_numeric($ph2) && is_numeric($ph3)))
 $emsg = "ERROR: Phone number must be numeric.";
?>

<?php if ($emsg <> "")  { ?>
  <form method="post" name="frmNxp" action="myacct.php">
   <input type="hidden" name="ErrorAdd" value="<?php echo $emsg; ?>"/>
   <input type="hidden" name="fromChk" value="1"/>
   <input type="hidden" name="e" value="da"/>
   <input type="hidden" name="s" value="<?php echo $s; ?>"/>
   <input type="hidden" name="fnm" value="<?php echo $fnm; ?>"/>
   <input type="hidden" name="lnm" value="<?php echo $lnm; ?>"/>
   <input type="hidden" name="eml" value="<?php echo $eml; ?>"/>
   <input type="hidden" name="pswd" value="<?php echo $pswd; ?>"/>
   <input type="hidden" name="addr" value="<?php echo $addr; ?>"/>
   <input type="hidden" name="city" value="<?php echo $city; ?>"/>
   <input type="hidden" name="abrg" value="<?php echo $abrg; ?>"/>
   <input type="hidden" name="zip" value="<?php echo $zip; ?>"/>
   <input type="hidden" name="ph1" value="<?php echo $ph1; ?>"/>
   <input type="hidden" name="ph2" value="<?php echo $ph2; ?>"/>
   <input type="hidden" name="ph3" value="<?php echo $ph3; ?>"/>
  </form>
<?php } ?>

<?php if ($emsg=="")  { ?>
<?php
 $phn = $ph1 ."-". $ph2 ."-". $ph3;

 // Store input data in database table customer
 $s2 = "UPDATE customer SET FirstName= ". sqlq($fnm) .", LastName= ". sqlq($lnm) .", Email= ". sqlq($eml) .", LgnPswd= ". sqlq($pswd) .", Address= ". sqlq($addr) .", City= ". sqlq($city) .", AbRegion= ". sqlq($abrg) .", Zip= ". sqlq($zip) .", Phone= ". sqlq($phn) .", LModiDtTm= ". sqlt(GetNowDtTm()) ." WHERE CID=" .sqlq($zc);
 $db->exec($s2);
?>
  <form method="post" name="frmNxp" action="myacct.php">
   <input type="hidden" name="s" value="<?php echo $s; ?>"/>
   <input type="hidden" name="e" value="no"/>
  </form>
<?php } ?>

<script>document.frmNxp.submit()</script>

<?php include("dbCLose.inc.php"); ?>

</body>
</html>
