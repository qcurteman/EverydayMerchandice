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
<script>
 function jsVw(p) {
  document.frmVw.vw.value = p;
  document.frmVw.submit();
 }
 function jsReBuy(p) {
  document.frmReBuy.reBuy.value = p;
  document.frmReBuy.submit();
 }
 function jsDel(p) {
  document.frmDel.del.value = p;
  document.frmDel.submit();
 }
</script>
</head>
<body>

<?php if ($zn <> "1") { ?>
 <form method="post" name="frmLgn" action="lgn.php">
  <input type="hidden" name="tgPg" value="lso"/>
  <input type="hidden" name="s" value="<?php echo $s; ?>"/>
 </form>
 <script>document.frmLgn.submit();</script>
<?php } ?>

<?php if ($zn=="1") { ?>
<?php
 if (rqgpIsSet("delFin")) {
  $delFin = rqgp("delFin");
  $s2 = "DELETE FROM orderHeader WHERE OID=" . sqlq($delFin) . " AND CID=" . sqlq($zc);
  $db->exec($s2);
  $s2 = "DELETE FROM orderBillTo WHERE OID=" . sqlq($delFin) . " AND CID=" . sqlq($zc);
  $db->exec($s2);
  $s2 = "DELETE FROM orderShipTo WHERE OID=" . sqlq($delFin) . " AND CID=" . sqlq($zc);
  $db->exec($s2);
  $s2 = "DELETE FROM shopCart WHERE OID=" . sqlq($delFin) . " AND CID=" . sqlq($zc);
  $db->exec($s2);
 }
?>
 <table border="0" cellpadding="0" cellspacing="0" width="100%"><tr>
  <?php
    $lftNavLnk = "lso";
  ?>
  <td valign="top" bgcolor="<?php echo $bgcLNav; ?>" width="<?php echo $widLNav; ?>">
   <?php include("fdaleLNav.inc.php"); ?>
  </td>
  <td valign="top" width="100%">
   <?php include("fdaleHdr.inc.php"); ?>
   <div id="mainBlock">
    <table border="0" cellpadding="0" cellspacing="0" width="100%"><tr>
     <td><h4>My Orders</h4></td>
     <td align="right" style="font-size:0.77em">
      <a href="javascript:document.frmRfs.submit()">REFRESH</a>
     </td>
    </table>
    <form method="post" name="frmRfs" action="lso.php">
     <input type="hidden" name="s" value="<?php echo $s; ?>"/>
    </form>

    <table class="tbStyl" cellpadding="3" cellspacing="0" width="100%">
     <tr bgcolor="#efefef">
      <td width="1%">&nbsp;</td>
      <th width="25%">Order Date</th>
      <th width="44%">Order Number</th>
      <th width="15%">Total</th>
      <th width="15%">Shipped?</th>
     </tr>
<?php
 // DOES THERE EXIST ...?
 $s1 = "SELECT Count(OID) FROM orderHeader WHERE CID=" . sqlq($zc) . " AND OrderType='P'";
 $hmnyP = $db->query($s1)->fetchColumn();
?>
   <?php if ($hmnyP <= 0) { ?>
     <tr>
      <td></td>
      <td colspan="4" style="color:brown">No orders found.</td>
     </tr>
   <?php } ?>

   <?php if ($hmnyP > 0) { ?>
<?php
 $s1 = "SELECT OID, OrderDtTm, PmtMethod, Subtotal, Tax, TotalSH, ShippedDtTm FROM orderHeader ";
 $s1 = $s1 . "WHERE CID=" . sqlq($zc) . " AND OrderType='P' ORDER BY OrderDtTm DESC";
 $s2 = $db->query($s1);
 $s2->setFetchMode(PDO::FETCH_ASSOC);

 $knt = 1;
 while ($row = $s2->fetch()) {
  $dbOID = $row["OID"];
  $dbOrderDtTm = $row["OrderDtTm"];
  $dbPmtMethod = $row["PmtMethod"];
  $dbSubtotal = $row["Subtotal"];
  $dbTax = $row["Tax"];
  $dbTotalSH = $row["TotalSH"];
  $dbShippedDtTm = $row["ShippedDtTm"];

  $total = $dbSubtotal + $dbTax + $dbTotalSH;

  $shpLb = "No";
  if (IsAfter($dbShippedDtTm,"1969/12/31")) { $shpLb=ShwDtTm($dbShippedDtTm,0,0); }

  $bgc = "#ffffff";
  if (rqgp("SelOID")==$dbOID) { $bgc="#ffffc0"; }
?>
     <tr bgcolor="<?php echo $bgc; ?>">
      <td valign="top" align="right"><?php echo $knt."."; ?></td>
      <td valign="top" style="font-size:0.92em"><?php echo ShwDtTm($dbOrderDtTm,1,0); ?></td>
      <td valign="top">
       <a href="javascript:jsVw('<?php echo $dbOID; ?>')">View Order</a>
		<nobr><?php echo $dbOID; ?></nobr>
      </td>
      <td valign="top" align="right"><?php echo "$".number_format($total,2); ?></td>
      <td valign="top" align="right"><?php echo $shpLb; ?></td>
     </tr>
<?php
  $knt = $knt + 1;
 } // while ($row = $s2->fetch())...
?>
   <?php } // if ($hmnyP > 0)...?>
    </table>

    <br /><h4>My <i>Incomplete</i> Orders</h4>

    <table class="tbStyl" cellpadding="3" cellspacing="0" width="100%">
     <tr bgcolor="#efefef">
      <td width="1%">&nbsp;</td>
      <th width="25%">Order Date</th>
      <th width="44%">Order Number</th>
      <th width="15%">Total</th>
      <th width="15%">Delete</th>
     </tr>
<?php
 // DOES THERE EXIST ...?
 $s1 = "SELECT Count(OID) FROM orderHeader ";
 $s1 = $s1 . "WHERE CID=" . sqlq($zc) . " AND OrderType='Q' AND OID <> " . sqlq($zo);
 $hmnyQ = $db->query($s1)->fetchColumn();
?>
   <?php if ($hmnyQ <= 0) { ?>
     <tr>
      <td></td>
      <td colspan="4" style="color:brown">No incomplete orders found.</td>
     </tr>
   <?php } ?>

   <?php if ($hmnyQ > 0) { ?>
<?php
 $s1 = "SELECT OID, OrderDtTm, PmtMethod, Subtotal, Tax, TotalSH, ShippedDtTm FROM orderHeader ";
 $s1 = $s1 . "WHERE CID=" . sqlq($zc) . " AND OrderType='Q' AND OID <> " . sqlq($zo) . " ";
 $s1 = $s1 . "ORDER BY OrderDtTm DESC";
 $s2 = $db->query($s1);
 $s2->setFetchMode(PDO::FETCH_ASSOC);

 $knt = 1;
 while ($row = $s2->fetch()) {
  $dbOID = $row["OID"];
  $dbOrderDtTm = $row["OrderDtTm"];
  $dbPmtMethod = $row["PmtMethod"];
  $dbSubtotal = $row["Subtotal"];
  $dbTax = $row["Tax"];
  $dbTotalSH = $row["TotalSH"];
  $dbShippedDtTm = $row["ShippedDtTm"];

  $total = $dbSubtotal + $dbTax + $dbTotalSH;

  $bgc = "#ffffff";
  if (rqgp("SelOID")==$dbOID) { $bgc="#ffffc0"; }
?>
   <?php if (rqgp("del")==$dbOID) { ?>
     <tr style="color:red;background:yellow">
      <td valign="top" align="right"><?php echo $knt."."; ?></td>
      <td valign="top" colspan="4">
       <table class="noStyl" cellpadding="3" cellspacing="0"><tr>
        <td valign="top">Delete this incomplete order?</td>
        <form method="post" action="lso.php">
         <td valign="top"><input class="formBtn" type="submit" value="YES"/></td>
         <input type="hidden" name="delFin" value="<?php echo $dbOID; ?>"/>
         <input type="hidden" name="s" value="<?php echo $s; ?>"/>
        </form>
        <form method="post" action="lso.php">
         <td valign="top"><input class="formBtn" type="submit" value="NO"/></td>
         <input type="hidden" name="s" value="<?php echo $s; ?>"/>
        </form>
       </tr></table>
      </td>
     </tr>
   <?php } ?>
     <tr bgcolor="<?php echo $bgc; ?>">
      <td valign="top" align="right"><?php echo $knt."."; ?></td>
      <td valign="top" style="font-size:0.92em"><?php echo ShwDtTm($dbOrderDtTm,1,0); ?></td>
      <td valign="top">
       <a href="javascript:jsReBuy('<?php echo $dbOID; ?>')">Restart incomplete order</a>
		<nobr><?php echo $dbOID; ?></nobr>
      </td>
      <td valign="top" align="right"><?php echo "$".number_format($total,2); ?></td>
      <td valign="top" align="center">
       <a href="javascript:jsDel('<?php echo $dbOID; ?>')">Delete</a>
      </td>
     </tr>
<?php
  $knt = $knt + 1;
 } // while ($row = $s2->fetch())...
?>
   <?php } // if ($hmnyQ > 0)...?>
    </table>

    <?php include("fdaleFtr.inc.php"); ?>
   </div><!--mainBlock-->
  </td>
 </tr></table>

 <form method="post" name="frmVw" action="order.php">
  <input type="hidden" name="vw"/>
  <input type="hidden" name="s" value="<?php echo $s; ?>"/>
 </form>
 <form method="post" name="frmReBuy" action="rebuy.php">
  <input type="hidden" name="reBuy"/>
  <input type="hidden" name="s" value="<?php echo $s; ?>"/>
 </form>
 <form method="post" name="frmDel" action="lso.php">
  <input type="hidden" name="del"/>
  <input type="hidden" name="s" value="<?php echo $s; ?>"/>
 </form>
<?php } ?>

 <br /><br />
 <?php include("dbCLose.inc.php"); ?>
</body>
</htmL>