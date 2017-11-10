<?php
 include("../myStore_func.inc.php");
 include("dbOpen.inc.php");
 include("fdaleGlob.inc.php");

 if ((trim($zo)=="") || (isUsedOID(trim($zo),$db))) {
  die('<script>window.location=\''.$storeURL.'\';</script>');
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $storeName ?></title>
<link rel="stylesheet" type="text/css" href="../myStore_style.css">
</head>
<body>

<?php if ($zn <> "1") { ?>
 <form method="post" name="frmLgn" action="lgn.php">
  <input type="hidden" name="tgPg" value="pch"/>
  <input type="hidden" name="s" value="<?php echo $s; ?>"/>
 </form>
 <script>document.frmLgn.submit();</script>
<?php } ?>

<?php if ($zn=="1") { ?>
<?php
 // DOES THERE EXIST ...?
 $s1 = "SELECT Count(OID) FROM shopCart WHERE OID=" . sqlq($zo) . " AND CID=" . sqlq($zc);
 $hmny = $db->query($s1)->fetchColumn();
?>
 <?php if ($hmny <= 0) { ?>
   <?php /* orderHeader.OID may become non-existent due to restarting an incomplete order */ ?>
   <form method="post" name="frmShc" action="shc.php">
    <input type="hidden" name="s" value="<?php echo $s; ?>"/>
   </form>
   <script>document.frmShc.submit();</script>
 <?php } ?>

 <table border="0" cellpadding="0" cellspacing="0" width="100%"><tr>
  <?php
    if ($hasPch) { $lftNavLnk="pch"; } else { $lftNavLnk="shc"; }
  ?>
  <td valign="top" bgcolor="<?php echo $bgcLNav; ?>" width="<?php echo $widLNav; ?>">
   <?php include("fdaleLNav.inc.php"); ?>
  </td>
  <td valign="top" width="100%">
   <?php include("fdaleHdr.inc.php"); ?>
   <div id="mainBlock">
    <div class="bcrumb" style="border-bottom:1px solid #202020">&#10017;
     <a href="javascript:document.frmShc.submit()">Shopping Cart</a> &gt; Create / Edit...
    </div>
    <form method="post" name="frmShc" action="shc.php">
     <input type="hidden" name="s" value="<?php echo $s; ?>"/>
    </form>

    <table border="0" cellpadding="0" cellspacing="0" width="100%"><tr>
     <td><h4>Create / Edit My Order</h4></td>
     <td align="right" style="font-size:0.77em">
      <a href="javascript:document.frmRfs.submit()">REFRESH</a>
     </td>
    </table>
    <form method="post" name="frmRfs" action="pch.php">
     <input type="hidden" name="s" value="<?php echo $s; ?>"/>
    </form>

<?php
 if ($hasPch) {
    // FETCH ONE ROW OF DATA
  $s1 = "SELECT BillToFName, BillToLName, Email, Address, City, AbRegion, Zip, Phone ";
  $s1 = $s1 . "FROM orderBillTo WHERE OID=" . sqlq($zo) . " AND CID=" . sqlq($zc);
  $s2 = $db->query($s1);
  $row = $s2->fetch(PDO::FETCH_ASSOC);
  $dbBiFNm = $row["BillToFName"];
  $dbBiLNm = $row["BillToLName"];
  $dbBiEml = $row["Email"];
  $dbBiAddr = $row["Address"];
  $dbBiCity = $row["City"];
  $dbBiAbRg = $row["AbRegion"];
  $dbBiZip = $row["Zip"];
  $dbBiPhn = $row["Phone"];
  $dbBiPh1 = "";
  $dbBiPh2 = "";
  $dbBiPh3 = "";
  if ($dbBiPhn <> "") {
   $zPhone = explode("-",$dbBiPhn);
   $dbBiPh1 = $zPhone[0];
   $dbBiPh2 = $zPhone[1];
   $dbBiPh3 = $zPhone[2];
  }
    // FETCH ONE ROW OF DATA
  $s1 = "SELECT ShipToFName, ShipToLName, Email, Address, City, AbRegion, Zip, Phone, SameAsBillTo ";
  $s1 = $s1 . "FROM orderShipTo WHERE OID=" . sqlq($zo) . " AND CID=" . sqlq($zc);
  $s2 = $db->query($s1);
  $row = $s2->fetch(PDO::FETCH_ASSOC);
  $dbShFNm = $row["ShipToFName"];
  $dbShLNm = $row["ShipToLName"];
  $dbShEml = $row["Email"];
  $dbShAddr = $row["Address"];
  $dbShCity = $row["City"];
  $dbShAbRg = $row["AbRegion"];
  $dbShZip = $row["Zip"];
  $dbShPhn = $row["Phone"];
  $dbShPh1 = "";
  $dbShPh2 = "";
  $dbShPh3 = "";
  if ($dbShPhn <> "") {
   $zPhone = explode("-",$dbShPhn);
   $dbShPh1 = $zPhone[0];
   $dbShPh2 = $zPhone[1];
   $dbShPh3 = $zPhone[2];
  }
  $dbIgnoreShipTo = $row["SameAsBillTo"];
    // FETCH ONE ROW OF DATA
  $s1 = "SELECT NotesFromCust FROM orderHeader WHERE OID=" . sqlq($zo) . " AND CID=" . sqlq($zc);
  $s2 = $db->query($s1);
  $row = $s2->fetch(PDO::FETCH_ASSOC);
  $dbNotes = $row["NotesFromCust"];

 } else {
    // FETCH ONE ROW OF DATA
  $s1 = "SELECT FirstName, LastName, Email, Address, City, AbRegion, Zip, Phone ";
  $s1 = $s1 . "FROM customer WHERE CID=" . sqlq($zc);
  $s2 = $db->query($s1);
  $row = $s2->fetch(PDO::FETCH_ASSOC);
  $dbBiFNm = $row["FirstName"];
  $dbBiLNm = $row["LastName"];
  $dbBiEml = $row["Email"];
  $dbBiAddr = $row["Address"];
  $dbBiCity = $row["City"];
  $dbBiAbRg = $row["AbRegion"];
  $dbBiZip = $row["Zip"];
  $dbBiPhn = $row["Phone"];
  $dbBiPh1 = "";
  $dbBiPh2 = "";
  $dbBiPh3 = "";
  if ($dbBiPhn <> "") {
   $zPhone = explode("-",$dbBiPhn);
   $dbBiPh1 = $zPhone[0];
   $dbBiPh2 = $zPhone[1];
   $dbBiPh3 = $zPhone[2];
  }
  $dbShFNm = "";
  $dbShLNm = "";
  $dbShEml = "";
  $dbShAddr = "";
  $dbShCity = "";
  $dbShAbRg = "";
  $dbShZip = "";
  $dbShPhn = "";
  $dbShPh1 = "";
  $dbShPh2 = "";
  $dbShPh3 = "";
  $dbIgnoreShipTo = "";
  $dbNotes = "";
 }

 if (rqgpIsSet("biFNm")) { $biFNm=rqgp("biFNm"); } else { $biFNm=$dbBiFNm; }
 if (rqgpIsSet("biLNm")) { $biLNm=rqgp("biLNm"); } else { $biLNm=$dbBiLNm; }
 if (rqgpIsSet("biEml")) { $biEml=rqgp("biEml"); } else { $biEml=$dbBiEml; }
 if (rqgpIsSet("biAddr")) { $biAddr=rqgp("biAddr"); } else { $biAddr=$dbBiAddr; }
 if (rqgpIsSet("biCity")) { $biCity=rqgp("biCity"); } else { $biCity=$dbBiCity; }
 if (rqgpIsSet("biAbRg")) { $biAbRg=rqgp("biAbRg"); } else { $biAbRg=$dbBiAbRg; }
 if (rqgpIsSet("biZip")) { $biZip=rqgp("biZip"); } else { $biZip=$dbBiZip; }
 if (rqgpIsSet("biPh1")) {$biPh1=rqgp("biPh1");} else {$biPh1=$dbBiPh1;}
 if (rqgpIsSet("biPh2")) {$biPh2=rqgp("biPh2");} else {$biPh2=$dbBiPh2;}
 if (rqgpIsSet("biPh3")) {$biPh3=rqgp("biPh3");} else {$biPh3=$dbBiPh3;}

 if (rqgpIsSet("shFNm")) { $shFNm=rqgp("shFNm"); } else { $shFNm=$dbShFNm; }
 if (rqgpIsSet("shLNm")) { $shLNm=rqgp("shLNm"); } else { $shLNm=$dbShLNm; }
 if (rqgpIsSet("shEml")) { $shEml=rqgp("shEml"); } else { $shEml=$dbShEml; }
 if (rqgpIsSet("shAddr")) { $shAddr=rqgp("shAddr"); } else { $shAddr=$dbShAddr; }
 if (rqgpIsSet("shCity")) { $shCity=rqgp("shCity"); } else { $shCity=$dbShCity; }
 if (rqgpIsSet("shAbRg")) { $shAbRg=rqgp("shAbRg"); } else { $shAbRg=$dbShAbRg; }
 if (rqgpIsSet("shZip")) { $shZip=rqgp("shZip"); } else { $shZip=$dbShZip; }
 if (rqgpIsSet("shPh1")) {$shPh1=rqgp("shPh1");} else {$shPh1=$dbShPh1;}
 if (rqgpIsSet("shPh2")) {$shPh2=rqgp("shPh2");} else {$shPh2=$dbShPh2;}
 if (rqgpIsSet("shPh3")) {$shPh3=rqgp("shPh3");} else {$shPh3=$dbShPh3;}

 if (rqgpIsSet("ign")) { $ign=rqgp("ign"); } else { $ign=$dbIgnoreShipTo; }
 if (rqgpIsSet("nts")) { $nts=rqgp("nts"); } else { $nts=$dbNotes; }
?>
    <table border="0" cellpadding="0" cellspacing="3"">
     <?php if (rqgpIsSet("Error")) { ?>
       <tr class="errMsg">
        <td align="right">&#10148;</td>
        <td><?php echo rqgp("Error"); ?></td>
       </tr>
     <?php } ?>
     <tr>
      <td colspan="2">
       <p class="halfpad" style="color:brown">&#10148; <b>Order <i>BILL-TO</i></b></p>
      </td>
     </tr>
     <form method="post" action="pchChk.php">
      <tr>
       <td>First name</td>
       <td><input type="text" name="biFNm" value="<?php echo $biFNm; ?>" size="20" maxlength="50"/></td>
      </tr>
      <tr>
       <td>Last name</td>
       <td><input type="text" name="biLNm" value="<?php echo $biLNm; ?>" size="20" maxlength="50"/></td>
      </tr>
      <tr>
       <td>E-mail address</td>
       <td><input type="text" name="biEml" value="<?php echo $biEml; ?>" size="50" maxlength="255"/></td>
      </tr>
      <tr>
       <td>Postal address</td>
       <td><input type="text" name="biAddr" value="<?php echo $biAddr; ?>" size="50" maxlength="255"/></td>
      </tr>
      <tr>
       <td>City</td>
       <td><input type="text" name="biCity" value="<?php echo $biCity; ?>" size="20" maxlength="50"/></td>
      </tr>
      <tr>
       <td>State</td>
       <td>
        <select name="biAbRg">
 	 <option value=""></option>
	 <option value="AL" <?php if($biAbRg=="AL") {?>selected<?php }?> > Alabama </option>
	 <option value="AK" <?php if($biAbRg=="AK") {?>selected<?php }?> > Alaska </option>
	 <option value="AZ" <?php if($biAbRg=="AZ") {?>selected<?php }?> > Arizona </option>
	 <option value="AR" <?php if($biAbRg=="AR") {?>selected<?php }?> > Arkansas </option>
	 <option value="CA" <?php if($biAbRg=="CA") {?>selected<?php }?> > California </option>
	 <option value="CO" <?php if($biAbRg=="CO") {?>selected<?php }?> > Colorado </option>
	 <option value="CT" <?php if($biAbRg=="CT") {?>selected<?php }?> > Connecticut </option>
	 <option value="DE" <?php if($biAbRg=="DE") {?>selected<?php }?> > Delaware </option>
	 <option value="DC" <?php if($biAbRg=="DC") {?>selected<?php }?> > District of Columbia </option>
	 <option value="FL" <?php if($biAbRg=="FL") {?>selected<?php }?> > Florida </option>
	 <option value="GA" <?php if($biAbRg=="GA") {?>selected<?php }?> > Georgia </option>
	 <option value="HI" <?php if($biAbRg=="HI") {?>selected<?php }?> > Hawaii </option>
	 <option value="ID" <?php if($biAbRg=="ID") {?>selected<?php }?> > Idaho </option>
	 <option value="IL" <?php if($biAbRg=="IL") {?>selected<?php }?> > Illinois </option>
	 <option value="IN" <?php if($biAbRg=="IN") {?>selected<?php }?> > Indiana </option>
	 <option value="IA" <?php if($biAbRg=="IA") {?>selected<?php }?> > Iowa </option>
	 <option value="KS" <?php if($biAbRg=="KS") {?>selected<?php }?> > Kansas </option>
	 <option value="KY" <?php if($biAbRg=="KY") {?>selected<?php }?> > Kentucky </option>
	 <option value="LA" <?php if($biAbRg=="LA") {?>selected<?php }?> > Louisiana </option>
	 <option value="ME" <?php if($biAbRg=="ME") {?>selected<?php }?> > Maine </option>
	 <option value="MD" <?php if($biAbRg=="MD") {?>selected<?php }?> > Maryland </option>
	 <option value="MA" <?php if($biAbRg=="MA") {?>selected<?php }?> > Massachusetts </option>
	 <option value="MI" <?php if($biAbRg=="MI") {?>selected<?php }?> > Michigan </option>
	 <option value="MN" <?php if($biAbRg=="MN") {?>selected<?php }?> > Minnesota </option>
	 <option value="MS" <?php if($biAbRg=="MS") {?>selected<?php }?> > Mississippi </option>
	 <option value="MO" <?php if($biAbRg=="MO") {?>selected<?php }?> > Missouri </option>
	 <option value="MT" <?php if($biAbRg=="MT") {?>selected<?php }?> > Montana </option>
	 <option value="NE" <?php if($biAbRg=="NE") {?>selected<?php }?> > Nebraska </option>
	 <option value="NV" <?php if($biAbRg=="NV") {?>selected<?php }?> > Nevada </option>
	 <option value="NH" <?php if($biAbRg=="NH") {?>selected<?php }?> > New Hampshire </option>
	 <option value="NJ" <?php if($biAbRg=="NJ") {?>selected<?php }?> > New Jersey </option>
	 <option value="NM" <?php if($biAbRg=="NM") {?>selected<?php }?> > New Mexico </option>
	 <option value="NY" <?php if($biAbRg=="NY") {?>selected<?php }?> > New York </option>
	 <option value="NC" <?php if($biAbRg=="NC") {?>selected<?php }?> > North Carolina </option>
	 <option value="ND" <?php if($biAbRg=="ND") {?>selected<?php }?> > North Dakota </option>
	 <option value="OH" <?php if($biAbRg=="OH") {?>selected<?php }?> > Ohio </option>
	 <option value="OK" <?php if($biAbRg=="OK") {?>selected<?php }?> > Oklahoma </option>
	 <option value="OR" <?php if($biAbRg=="OR") {?>selected<?php }?> > Oregon </option>
	 <option value="PA" <?php if($biAbRg=="PA") {?>selected<?php }?> > Pennsylvania </option>
	 <option value="RI" <?php if($biAbRg=="RI") {?>selected<?php }?> > Rhode Island </option>
	 <option value="SC" <?php if($biAbRg=="SC") {?>selected<?php }?> > South Carolina </option>
	 <option value="SD" <?php if($biAbRg=="SD") {?>selected<?php }?> > South Dakota </option>
	 <option value="TN" <?php if($biAbRg=="TN") {?>selected<?php }?> > Tennessee </option>
	 <option value="TX" <?php if($biAbRg=="TX") {?>selected<?php }?> > Texas </option>
	 <option value="UT" <?php if($biAbRg=="UT") {?>selected<?php }?> > Utah </option>
	 <option value="VT" <?php if($biAbRg=="VT") {?>selected<?php }?> > Vermont </option>
	 <option value="VA" <?php if($biAbRg=="VA") {?>selected<?php }?> > Virginia </option>
	 <option value="WA" <?php if($biAbRg=="WA") {?>selected<?php }?> > Washington </option>
	 <option value="WV" <?php if($biAbRg=="WV") {?>selected<?php }?> > West Virginia </option>
	 <option value="WI" <?php if($biAbRg=="WI") {?>selected<?php }?> > Wisconsin </option>
	 <option value="WY" <?php if($biAbRg=="WY") {?>selected<?php }?> > Wyoming </option>
        </select>
       </td>
      </tr>
      <tr>
       <td>Zip</td>
       <td><input type="text" name="biZip" value="<?php echo $biZip; ?>" size="5" maxlength="5"/></td>
      </tr>
      <tr>
       <td>Phone</td>
       <td>
        <input type="text" name="biPh1" value="<?php echo $biPh1; ?>" size="3" maxlength="3"/> &ndash;
        <input type="text" name="biPh2" value="<?php echo $biPh2; ?>" size="3" maxlength="3"/> &ndash;
        <input type="text" name="biPh3" value="<?php echo $biPh3; ?>" size="4" maxlength="4"/>
       </td>
      </tr>
      <tr>
       <td colspan="2">
        <p class="halfpad" style="color:brown">&#10148; <b>Order <i>SHIP-TO</i></b></p>
       </td>
      </tr>
      <tr>
       <td colspan="2" style="color:brown">
        <input type="checkbox" name="ign" value="1" <?php if ($ign=="1") { ?>checked<?php } ?> />
        Check this box if SHIP-TO information is the same as the above BILL-TO.<br />
        NOTE: When checked, all SHIP-TO information below will be ignored.
       </td>
      </tr>
      <tr><td style="height:5px"></td></tr>
      <tr>
       <td>First name</td>
       <td><input type="text" name="shFNm" value="<?php echo $shFNm; ?>" size="20" maxlength="50"/></td>
      </tr>
      <tr>
       <td>Last name</td>
       <td><input type="text" name="shLNm" value="<?php echo $shLNm; ?>" size="20" maxlength="50"/></td>
      </tr>
      <tr>
       <td>E-mail address</td>
       <td><input type="text" name="shEml" value="<?php echo $shEml; ?>" size="50" maxlength="255"/></td>
      </tr>
      <tr>
       <td>Postal address</td>
       <td><input type="text" name="shAddr" value="<?php echo $shAddr; ?>" size="50" maxlength="255"/></td>
      </tr>
      <tr>
       <td>City</td>
       <td><input type="text" name="shCity" value="<?php echo $shCity; ?>" size="20" maxlength="50"/></td>
      </tr>
      <tr>
       <td>State</td>
       <td>
        <select name="shAbRg">
 	 <option value=""></option>
	 <option value="AL" <?php if($shAbRg=="AL") {?>selected<?php }?> > Alabama </option>
	 <option value="AK" <?php if($shAbRg=="AK") {?>selected<?php }?> > Alaska </option>
	 <option value="AZ" <?php if($shAbRg=="AZ") {?>selected<?php }?> > Arizona </option>
	 <option value="AR" <?php if($shAbRg=="AR") {?>selected<?php }?> > Arkansas </option>
	 <option value="CA" <?php if($shAbRg=="CA") {?>selected<?php }?> > California </option>
	 <option value="CO" <?php if($shAbRg=="CO") {?>selected<?php }?> > Colorado </option>
	 <option value="CT" <?php if($shAbRg=="CT") {?>selected<?php }?> > Connecticut </option>
	 <option value="DE" <?php if($shAbRg=="DE") {?>selected<?php }?> > Delaware </option>
	 <option value="DC" <?php if($shAbRg=="DC") {?>selected<?php }?> > District of Columbia </option>
	 <option value="FL" <?php if($shAbRg=="FL") {?>selected<?php }?> > Florida </option>
	 <option value="GA" <?php if($shAbRg=="GA") {?>selected<?php }?> > Georgia </option>
	 <option value="HI" <?php if($shAbRg=="HI") {?>selected<?php }?> > Hawaii </option>
	 <option value="ID" <?php if($shAbRg=="ID") {?>selected<?php }?> > Idaho </option>
	 <option value="IL" <?php if($shAbRg=="IL") {?>selected<?php }?> > Illinois </option>
	 <option value="IN" <?php if($shAbRg=="IN") {?>selected<?php }?> > Indiana </option>
	 <option value="IA" <?php if($shAbRg=="IA") {?>selected<?php }?> > Iowa </option>
	 <option value="KS" <?php if($shAbRg=="KS") {?>selected<?php }?> > Kansas </option>
	 <option value="KY" <?php if($shAbRg=="KY") {?>selected<?php }?> > Kentucky </option>
	 <option value="LA" <?php if($shAbRg=="LA") {?>selected<?php }?> > Louisiana </option>
	 <option value="ME" <?php if($shAbRg=="ME") {?>selected<?php }?> > Maine </option>
	 <option value="MD" <?php if($shAbRg=="MD") {?>selected<?php }?> > Maryland </option>
	 <option value="MA" <?php if($shAbRg=="MA") {?>selected<?php }?> > Massachusetts </option>
	 <option value="MI" <?php if($shAbRg=="MI") {?>selected<?php }?> > Michigan </option>
	 <option value="MN" <?php if($shAbRg=="MN") {?>selected<?php }?> > Minnesota </option>
	 <option value="MS" <?php if($shAbRg=="MS") {?>selected<?php }?> > Mississippi </option>
	 <option value="MO" <?php if($shAbRg=="MO") {?>selected<?php }?> > Missouri </option>
	 <option value="MT" <?php if($shAbRg=="MT") {?>selected<?php }?> > Montana </option>
	 <option value="NE" <?php if($shAbRg=="NE") {?>selected<?php }?> > Nebraska </option>
	 <option value="NV" <?php if($shAbRg=="NV") {?>selected<?php }?> > Nevada </option>
	 <option value="NH" <?php if($shAbRg=="NH") {?>selected<?php }?> > New Hampshire </option>
	 <option value="NJ" <?php if($shAbRg=="NJ") {?>selected<?php }?> > New Jersey </option>
	 <option value="NM" <?php if($shAbRg=="NM") {?>selected<?php }?> > New Mexico </option>
	 <option value="NY" <?php if($shAbRg=="NY") {?>selected<?php }?> > New York </option>
	 <option value="NC" <?php if($shAbRg=="NC") {?>selected<?php }?> > North Carolina </option>
	 <option value="ND" <?php if($shAbRg=="ND") {?>selected<?php }?> > North Dakota </option>
	 <option value="OH" <?php if($shAbRg=="OH") {?>selected<?php }?> > Ohio </option>
	 <option value="OK" <?php if($shAbRg=="OK") {?>selected<?php }?> > Oklahoma </option>
	 <option value="OR" <?php if($shAbRg=="OR") {?>selected<?php }?> > Oregon </option>
	 <option value="PA" <?php if($shAbRg=="PA") {?>selected<?php }?> > Pennsylvania </option>
	 <option value="RI" <?php if($shAbRg=="RI") {?>selected<?php }?> > Rhode Island </option>
	 <option value="SC" <?php if($shAbRg=="SC") {?>selected<?php }?> > South Carolina </option>
	 <option value="SD" <?php if($shAbRg=="SD") {?>selected<?php }?> > South Dakota </option>
	 <option value="TN" <?php if($shAbRg=="TN") {?>selected<?php }?> > Tennessee </option>
	 <option value="TX" <?php if($shAbRg=="TX") {?>selected<?php }?> > Texas </option>
	 <option value="UT" <?php if($shAbRg=="UT") {?>selected<?php }?> > Utah </option>
	 <option value="VT" <?php if($shAbRg=="VT") {?>selected<?php }?> > Vermont </option>
	 <option value="VA" <?php if($shAbRg=="VA") {?>selected<?php }?> > Virginia </option>
	 <option value="WA" <?php if($shAbRg=="WA") {?>selected<?php }?> > Washington </option>
	 <option value="WV" <?php if($shAbRg=="WV") {?>selected<?php }?> > West Virginia </option>
	 <option value="WI" <?php if($shAbRg=="WI") {?>selected<?php }?> > Wisconsin </option>
	 <option value="WY" <?php if($shAbRg=="WY") {?>selected<?php }?> > Wyoming </option>
        </select>
       </td>
      </tr>
      <tr>
       <td>Zip</td>
       <td><input type="text" name="shZip" value="<?php echo $shZip; ?>" size="5" maxlength="5"/></td>
      </tr>
      <tr>
       <td>Phone</td>
       <td>
        <input type="text" name="shPh1" value="<?php echo $shPh1; ?>" size="3" maxlength="3"/> &ndash;
        <input type="text" name="shPh2" value="<?php echo $shPh2; ?>" size="3" maxlength="3"/> &ndash;
        <input type="text" name="shPh3" value="<?php echo $shPh3; ?>" size="4" maxlength="4"/>
       </td>
      </tr>
      <tr>
       <td colspan="2">
        <p class="halfpad" style="color:brown">&#10148; <b>Order Notes</b> (optional)</p>
       </td>
      </tr>
      <tr>
       <td colspan="2">
        <textarea rows="3" cols="55" name="nts"
          wrap="virtual"/><?php echo htmlentities($nts); ?></textarea>
       </td>
      </tr>
      <tr><td style="height:5px"></td></tr>
      <tr bgcolor="#e0e0e0">
       <td>&nbsp;</td>
       <td><input class="formBtn" type="submit" value="Submit"/></td>
      </tr>
      <input type="hidden" name="s" value="<?php echo $s; ?>"/>
     </form>
    </table>

    <?php include("fdaleFtr.inc.php"); ?>
   </div><!--mainBlock-->
  </td>
 </tr></table>
<?php } // if ($zn=="1")...?>

 <br /><br />
 <?php include("dbCLose.inc.php"); ?>
</body>
</htmL>