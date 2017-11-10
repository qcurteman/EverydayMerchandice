<?php
 // http://127.0.110.1/110_myStore/storeFront/home.php
 // http://csci.jessup.edu/csci110/110_myStore/storeFront/home.php

 include("../myStore_func.inc.php");
 include("dbOpen.inc.php");
 include("fdaleGlob.inc.php");

 if (trim($zo)=="") {
  // The logic of the s ("state") string handler in fdaleGlob.inc.php makes
  // sure that the zo variable is empty if invalid s string is encountered.
  $zo = CreateNewRndSt();
  while(isUsedOID($zo,$db)) {
   $zo = CreateNewRndSt();
  }
  // ACHTUNG!!  One of very few places where the s string is constructed.
  $s = $zo . "@0@" . $anonCID;
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $storeName ?></title>
<link rel="stylesheet" type="text/css" href="../myStore_style.css">
</head>
<body>
 <table border="0" cellpadding="0" cellspacing="0" width="100%"><tr>
  <?php
    $lftNavLnk = "home";
  ?>
  <td valign="top" bgcolor="<?php echo $bgcLNav; ?>" width="<?php echo $widLNav; ?>">
   <?php include("fdaleLNav.inc.php"); ?>
  </td>
  <td valign="top" width="100%">
   <?php include("fdaleHdr.inc.php"); ?>
   <div id="mainBlock">
    <h4>Today's Specials</h4>

    <table border="0" cellpadding="5" cellspacing="3" width="100%">
<?php
 // FETCH MORE THAN ONE ROW OF DATA
 $s1 = "SELECT PID, ProdName, ProdCode, Dscrp, Cost, Price, Markup, Weight, Shipping, ";
 $s1 = $s1 . "MFRID, CATID FROM product WHERE Enabled=1 ORDER BY ProdName";
 $s2 = $db->query($s1);
 $s2->setFetchMode(PDO::FETCH_ASSOC); // fetches associative array, indexed by column name

 $knt = 1;
 while ($row = $s2->fetch()) {
  $dbPID = $row["PID"];
  $dbProdName = $row["ProdName"];
  $dbProdCode = $row["ProdCode"];
  $dbDscrp = $row["Dscrp"];
  $dbCost = $row["Cost"];
  $dbPrice = $row["Price"];
  $dbMarkup = $row["Markup"];
  $dbWeight = $row["Weight"];
  $dbShipping = $row["Shipping"];
  $dbMFRID = $row["MFRID"];
  $dbCATID = $row["CATID"];

  // FETCH ONE ROW OF DATA
  $s5 = "SELECT MfrName FROM mfr WHERE MFRID=" . sqlq($dbMFRID);
  $s6 = $db->query($s5);
  $rowTmp = $s6->fetch(PDO::FETCH_ASSOC); // fetches associative array, indexed by column name
  $dbMfrName = $rowTmp["MfrName"];

  $dscrpLb = $dbDscrp . "<br />(" . $dbMfrName . " &#149; S&H $" . $dbShipping;
  $dscrpLb = $dscrpLb . " &#149; " . $dbWeight . " Lbs)";

  // DOES THERE EXIST ...?
  $s5 = "SELECT Count(PID) FROM shopCart WHERE PID=" . sqlq($dbPID) . " AND OID=" . sqlq($zo);
  $hmny = $db->query($s5)->fetchColumn();
?>
     <tr bgcolor="#ababc0">
      <td valign="top" align="right"><?php echo $knt."."; ?></td>
      <td valign="top" bgcolor="#ffffff" style="border-top:2px solid #ffff90">
       <img src="<?php echo "imgs/".$dbPID.".jpg"; ?>" width="80"/>
      </td>
      <td valign="top"><?php echo $dscrpLb; ?></td>
      <td valign="top" nowrap>p/n <?php echo $dbProdCode; ?></td>
      <td valign="top" align="right"><?php echo "$".number_format($dbPrice,2); ?></td>

      <?php if ($hmny <= 0) { ?>
        <form method="post" action="bag.php">
         <td valign="top" align="center">
          <input class="formBtn" type="submit" value="BUY"/>
         </td>
         <input type="hidden" name="pid" value="<?php echo $dbPID; ?>"/>
         <input type="hidden" name="s" value="<?php echo $s; ?>"/>
        </form>
      <?php } else { ?>
        <td valign="top" align="center"><img src="imgs/shc_filled.gif" width="28"/></td>
      <?php } ?>
     </tr>
<?php
  $knt = $knt + 1;
 } // while ($row = $s2->fetch())...
?>
    </table>

    <?php include("fdaleFtr.inc.php"); ?>
   </div><!--mainBlock-->
  </td>
 </tr></table>

 <br /><br />
 <?php include("dbCLose.inc.php"); ?>
</body>
</htmL>