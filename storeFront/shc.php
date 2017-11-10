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
 <table border="0" cellpadding="0" cellspacing="0" width="100%"><tr>
  <?php
    $lftNavLnk = "shc";
  ?>
  <td valign="top" bgcolor="<?php echo $bgcLNav; ?>" width="<?php echo $widLNav; ?>">
   <?php include("fdaleLNav.inc.php"); ?>
  </td>
  <td valign="top" width="100%">
   <?php include("fdaleHdr.inc.php"); ?>
   <div id="mainBlock">
    <table border="0" cellpadding="0" cellspacing="0" width="100%"><tr>
     <td><h4>Shopping Cart</h4></td>
     <td align="right" style="font-size:0.77em">
      <a href="javascript:document.frmRfs.submit()">REFRESH</a>
     </td>
    </table>
    <form method="post" name="frmRfs" action="shc.php">
     <input type="hidden" name="s" value="<?php echo $s; ?>"/>
    </form>

<?php
 // DOES THERE EXIST ...?
 $s1 = "SELECT Count(OID) FROM shopCart WHERE OID=" . sqlq($zo);
 $hmny = $db->query($s1)->fetchColumn();
?>

<?php if ($hmny <= 0) { ?>
    <p class="quarterpad">Your shopping cart is empty.</p>

<?php } else { ?>
    <?php if (rqgp("warnMsg") <> "") { ?>
      <div style="margin:3px 0 8px 0;padding:5px 8px;background:yellow;color:red">
       <?php echo rqgp("warnMsg"); ?>
      </div>
    <?php } ?>
    <table class="tbStyl" cellpadding="3" cellspacing="0" width="100%">
     <tr bgcolor="#efefef">
      <th>&nbsp;</th>
      <th>Mfr.</th>
      <th>Description</th>
      <th>P/N</th>
      <th>Qty.</th>
      <th>Price</th>
      <th>Ext. Price</th>
     </tr>
<?php
 // FETCH MORE THAN ONE ROW OF DATA
 $s1 = "SELECT PID, ProdName, ProdCode, CatName, MfrName, Dscrp, Quantity, Price, Shipping ";
 $s1 = $s1 . "FROM shopCart WHERE OID=" . sqlq($zo) . " ORDER BY EnteredDtTm";
 $s2 = $db->query($s1);
 $s2->setFetchMode(PDO::FETCH_ASSOC); // fetches associative array, indexed by column name

 $subtotal = 0;
 $shipping = 0;
 $knt = 1;
 while ($row = $s2->fetch()) {
  $dbPID = $row["PID"];
  $dbProdName = $row["ProdName"];
  $dbProdCode = $row["ProdCode"];
  $dbCatName = $row["CatName"];
  $dbMfrName = $row["MfrName"];
  $dbDscrp = $row["Dscrp"];
  $dbQuantity = $row["Quantity"];
  $dbPrice = $row["Price"];
  $dbShipping = $row["Shipping"];

  $subtotal = $subtotal + ($dbPrice * $dbQuantity);
  $shipping = $shipping + ($dbShipping * $dbQuantity);

  if (rqgpIsSet("qty")) { $qty=rqgp("qty"); } else { $qty=$dbQuantity; }

  $bgc = "#ffffff";
  if (rqgp("SelPID")==$dbPID || rqgp("qtyPID")==$dbPID) { $bgc="#ffffa0"; }
?>
     <?php if (rqgpIsSet("ErrorQty") && rqgp("qtyPID")==$dbPID) { ?>
       <tr class="errMsg">
        <td valign="top" align="right"><?php echo $knt."."; ?></td>
        <td valign="top" colspan="6"><?php echo rqgp("ErrorQty"); ?></td>
       </tr>
     <?php } ?>

     <tr bgcolor="<?php echo $bgc; ?>">
      <td valign="top" align="right"><?php echo $knt."."; ?></td>
      <td valign="top"><?php echo $dbMfrName; ?></td>
      <td valign="top"><?php echo $dbDscrp."<br />(S&H $".$dbShipping.")"; ?></td>
      <td valign="top"><?php echo $dbProdCode; ?></td>

      <form method="post" action="qtyChk.php">
       <td valign="top" align="center">
        <input type="text" name="qty" value="<?php echo $qty; ?>" size="5" maxlength="5"/><br />
        <input type="submit" value="change"/>
       </td>
       <input type="hidden" name="qtyPID" value="<?php echo $dbPID; ?>"/>
       <input type="hidden" name="s" value="<?php echo $s; ?>"/>
      </form>

      <td valign="top" align="right"><?php echo "$".number_format($dbPrice,2); ?></td>
      <td valign="top" align="right"><?php echo "$".number_format($dbPrice*$dbQuantity,2); ?></td>
     </tr>
<?php
  $knt = $knt + 1;
 } // while ($row = $s2->fetch())...
?>
     <tr>
      <td colspan="3" rowspan="2"></td>
      <td valign="top" align="right" colspan="3">Sub-total</td>
      <td valign="top" align="right"><?php echo "$".number_format($subtotal,2); ?></td>
     </tr>
     <tr>
      <td valign="top" align="right" colspan="3">Shipping & Handling</td>
      <td valign="top" align="right"><?php echo "$".number_format($shipping,2); ?></td>
     </tr>
    </table>

    <table border="0" cellpadding="0" cellspacing="0"><tr>
     <form method="post" action="bagDel.php">
      <td><input class="formBtn" type="submit" value="Empty the Shopping Cart"/>&nbsp; </td>
      <input type="hidden" name="s" value="<?php echo $s; ?>"/>
     </form>
     <form method="post" action="pch.php">
      <td><input class="formBtn" type="submit" value="Create/Edit My Order"/></td>
      <input type="hidden" name="s" value="<?php echo $s; ?>"/>
     </form>
    </tr></table>
<?php } // if ($hmny <= 0)... ?>

    <?php include("fdaleFtr.inc.php"); ?>
   </div><!--mainBlock-->
  </td>
 </tr></table>

 <br /><br />
 <?php include("dbCLose.inc.php"); ?>
</body>
</htmL>