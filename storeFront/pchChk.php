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
 $emsg = "";

 $biFNm = trim(rqgp("biFNm"));
 if ($biFNm=="") {
  $emsg = "ERROR: A <i>BILL-TO</i> first name is required.";
 }

 $biLNm = trim(rqgp("biLNm"));
 if ($biLNm=="" && $emsg=="") {
  $emsg = "ERROR: A <i>BILL-TO</i> last name is required.";
 }

 $biEml = trim(rqgp("biEml"));
 if ($biEml=="" && $emsg=="") {
  $emsg = "ERROR: A <i>BILL-TO</i> e-mail address is required.";
 }

 $biAddr = trim(rqgp("biAddr"));
 if ($biAddr=="" && $emsg=="") {
  $emsg = "ERROR: A <i>BILL-TO</i> postal address is required.";
 }

 $biCity = trim(rqgp("biCity"));
 if ($biCity=="" && $emsg=="") {
  $emsg = "ERROR: A <i>BILL-TO</i> city is required.";
 }

 $biAbRg = rqgp("biAbRg");
 if ($biAbRg=="" && $emsg=="") {
  $emsg = "ERROR: A <i>BILL-TO</i> state is required.";
 }

 $biZip = trim(rqgp("biZip"));
 if ($biZip=="" && $emsg=="") {
  $emsg = "ERROR: A <i>BILL-TO</i> zipcode is required.";
 }

 $biPh1 = trim(rqgp("biPh1"));
 $biPh2 = trim(rqgp("biPh2"));
 $biPh3 = trim(rqgp("biPh3"));
 $biPhn = "";
 if ($emsg=="") {
  if ((strlen($biPh1) <> 3) || (strlen($biPh2) <> 3) || (strlen($biPh3) <> 4)) {
   $emsg = "ERROR: <i>BILL-TO</i> phone number is incomplete/invalid.";
  } elseif ((!is_numeric($biPh1)) || (!is_numeric($biPh2)) || (!is_numeric($biPh3))) {
   $emsg = "ERROR: <i>BILL-TO</i> phone number must consist of numerals only.";
  } else {
   $biPhn = $biPh1 . "-" . $biPh2 . "-" . $biPh3;
  }
 }

 $ign = rqgp("ign");

 if ($ign=="1") {
  $shFNm = $biFNm;
  $shLNm = $biLNm;
  $shEml = $biEml;
  $shAddr = $biAddr;
  $shCity = $biCity;
  $shAbRg = $biAbRg;
  $shZip = $biZip;
  $shPhn = $biPhn;

 } else {
  $shFNm = trim(rqgp("shFNm"));
  if ($shFNm=="" && $emsg=="") {
   $emsg = "ERROR: A <i>SHIP-TO</i> first name is required.";
  }
  $shLNm = trim(rqgp("shLNm"));
  if ($shLNm=="" && $emsg=="") {
   $emsg = "ERROR: A <i>SHIP-TO</i> last name is required.";
  }
  $shEml = trim(rqgp("shEml"));
  if ($shEml=="" && $emsg=="") {
   $emsg = "ERROR: A <i>SHIP-TO</i> e-mail address is required.";
  }
  $shAddr = rqgp("shAddr");
  if ($shAddr=="" && $emsg=="") {
   $emsg = "ERROR: A <i>SHIP-TO</i> postal address is required.";
  }
  $shCity = trim(rqgp("shCity"));
  if ($shCity=="" && $emsg=="") {
   $emsg = "ERROR: A <i>SHIP-TO</i> city is required.";
  }
  $shAbRg = trim(rqgp("shAbRg"));
  if ($shAbRg=="" && $emsg=="") {
   $emsg = "ERROR: A <i>SHIP-TO</i> state is required.";
  }
  $shZip = trim(rqgp("shZip"));
  if ($shZip=="" && $emsg=="") {
   $emsg = "ERROR: A <i>SHIP-TO</i> zipcode is required.";
  }
  $shPh1 = trim(rqgp("shPh1"));
  $shPh2 = trim(rqgp("shPh2"));
  $shPh3 = trim(rqgp("shPh3"));
  $shPhn = "";
  if ($emsg=="") {
   if ((strlen($shPh1) <> 3) || (strlen($shPh2) <> 3) || (strlen($shPh3) <> 4)) {
    $emsg = "ERROR: <i>SHIP-TO</i> phone number is incomplete/invalid.";
   } elseif ((!is_numeric($shPh1)) || (!is_numeric($shPh2)) || (!is_numeric($shPh3))) {
    $emsg = "ERROR: <i>SHIP-TO</i> phone number must consist of numerals only.";
   } else {
    $shPhn = $shPh1 . "-" . $shPh2 . "-" . $shPh3;
   }
  }
 }

 $nts = trim(rqgp("nts"));
?>

<?php if ($emsg <> "")  { ?>
  <form method="post" name="frmNxp" action="pch.php">
   <input type="hidden" name="Error" value="<?php echo $emsg; ?>"/>
   <input type="hidden" name="s" value="<?php echo $s; ?>"/>
   <input type="hidden" name="biFNm" value="<?php echo $biFNm; ?>"/>
   <input type="hidden" name="biLNm" value="<?php echo $biLNm; ?>"/>
   <input type="hidden" name="biEml" value="<?php echo $biEml; ?>"/>
   <input type="hidden" name="biAddr" value="<?php echo $biAddr; ?>"/>
   <input type="hidden" name="biCity" value="<?php echo $biCity; ?>"/>
   <input type="hidden" name="biAbRg" value="<?php echo $biAbRg; ?>"/>
   <input type="hidden" name="biZip" value="<?php echo $biZip; ?>"/>
   <input type="hidden" name="biPh1" value="<?php echo $biPh1; ?>"/>
   <input type="hidden" name="biPh2" value="<?php echo $biPh2; ?>"/>
   <input type="hidden" name="biPh3" value="<?php echo $biPh3; ?>"/>

   <input type="hidden" name="shFNm" value="<?php echo $shFNm; ?>"/>
   <input type="hidden" name="shLNm" value="<?php echo $shLNm; ?>"/>
   <input type="hidden" name="shEml" value="<?php echo $shEml; ?>"/>
   <input type="hidden" name="shAddr" value="<?php echo $shAddr; ?>"/>
   <input type="hidden" name="shCity" value="<?php echo $shCity; ?>"/>
   <input type="hidden" name="shAbRg" value="<?php echo $shAbRg; ?>"/>
   <input type="hidden" name="shZip" value="<?php echo $shZip; ?>"/>
   <input type="hidden" name="shPh1" value="<?php echo $shPh1; ?>"/>
   <input type="hidden" name="shPh2" value="<?php echo $shPh2; ?>"/>
   <input type="hidden" name="shPh3" value="<?php echo $shPh3; ?>"/>
   <input type="hidden" name="ign" value="<?php echo $ign; ?>"/>
   <input type="hidden" name="nts" value="<?php echo $nts; ?>"/>
  </form>
<?php } ?>

<?php if ($emsg=="")  { ?>
<?php
 if ($ign=="") {
  $ign = "0";
 }

 ////// Idempotent operations: Part 1
 $s2 = "DELETE FROM orderHeader WHERE OID=" . sqlq($zo) . " AND CID=" . sqlq($zc);
   $db->exec($s2);
 $s2 = "DELETE FROM orderBillTo WHERE OID=" . sqlq($zo) . " AND CID=" . sqlq($zc);
   $db->exec($s2);
 $s2 = "DELETE FROM orderShipTo WHERE OID=" . sqlq($zo) . " AND CID=" . sqlq($zc);
   $db->exec($s2);

 ////// Idempotent operations: Part 2
 // Make OrderType=='Q' now, change later to OrderType=='P' when order is paid.
 $s2 = "INSERT INTO orderHeader (OID, CID, OrderDtTm, OrderType, NotesFromCust) VALUES (";
 $s2 = $s2 . sqlq($zo) . "," . sqlq($zc) . "," . sqlt(GetNowDtTm()) . ",'Q'," . sqlq($nts) . ")";
 $db->exec($s2);

 $s2 = "INSERT INTO orderBillTo (OID, CID, BillToFName, BillToLName, Email, Address, City, ";
 $s2 = $s2 . "AbRegion, Zip, Phone) VALUES (" . sqlq($zo) . "," . sqlq($zc) . "," . sqlq($biFNm);
 $s2 = $s2 . "," . sqlq($biLNm) . "," . sqlq($biEml) . "," . sqlq($biAddr) . "," . sqlq($biCity);
 $s2 = $s2 . "," . sqlq($biAbRg) . "," . sqlq($biZip) . "," . sqlq($biPhn) . ")";
 $db->exec($s2);

 $s2 = "INSERT INTO orderShipTo (OID, CID, ShipToFName, ShipToLName, Email, Address, City, ";
 $s2 = $s2 . "AbRegion, Zip, Phone, SameAsBillTo) VALUES (" . sqlq($zo) . "," . sqlq($zc) . ",";
 $s2 = $s2 . sqlq($shFNm) . "," . sqlq($shLNm) . "," . sqlq($shEml) . "," . sqlq($shAddr) . ",";
 $s2 = $s2 . sqlq($shCity) . "," . sqlq($shAbRg) . "," . sqlq($shZip) . "," . sqlq($shPhn) . ",";
 $s2 = $s2 . $ign . ")";
 $db->exec($s2);
?>
  <form method="post" name="frmNxp" action="osum.php">
   <input type="hidden" name="s" value="<?php echo $s; ?>"/>
  </form>
<?php } ?>

<script>document.frmNxp.submit()</script>

<?php include("dbCLose.inc.php"); ?>

</body>
</htmL>
