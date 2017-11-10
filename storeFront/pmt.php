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

<?php if ($hmny > 0) { ?>
<?php
 $subtotal = rqgp("p1");
 $taxRate = rqgp("p2");
 $tax = rqgp("p3");
 $shipping = rqgp("p4");
 $OrderDtTm = rqgp("p5");

 $SelOID = $zo;

 // Make OrderType=='P' now, order is paid.
 $s2 = "UPDATE orderHeader SET OrderType='P', PmtMethod='cc', ccPmtAttmpDtTm=" . sqlt(GetNowDtTm());
 $s2 = $s2 . ", ccRefNumber='111', Subtotal=" . $subtotal . ", TaxRate=" . $taxRate . ", Tax=" . $tax;
 $s2 = $s2 . ", TotalSH=" . $shipping . " WHERE OID=" . sqlq($zo) . " AND CID=" . sqlq($zc);
 $db->exec($s2);

 // Idempotent operations: Part 1
 $s2 = "DELETE FROM orderDetail WHERE OID=" . sqlq($zo) . " AND CID=" . sqlq($zc);
 $db->exec($s2);

 // Idempotent operations: Part 2 -- transfer from shopCart to orderDetail table
 $s1 = "SELECT PID, ProdName, ProdCode, CATID, CatName, MFRID, MfrName, Dscrp, Quantity, Cost, Price, ";
 $s1 = $s1 . "Markup, Weight, Shipping FROM shopCart WHERE OID=" . sqlq($zo) . " AND CID=" . sqlq($zc);
 $s2 = $db->query($s1);
 $s2->setFetchMode(PDO::FETCH_ASSOC);
 while ($row = $s2->fetch()) {
  $dbPID = $row["PID"];
  $dbProdName = $row["ProdName"];
  $dbProdCode = $row["ProdCode"];
  $dbCATID = $row["CATID"];
  $dbCatName = $row["CatName"];
  $dbMFRID = $row["MFRID"];
  $dbMfrName = $row["MfrName"];
  $dbDscrp = $row["Dscrp"];
  $dbQuantity = $row["Quantity"];
  $dbCost = $row["Cost"];
  $dbPrice = $row["Price"];
  $dbMarkup = $row["Markup"];
  $dbWeight = $row["Weight"];
  $dbShipping = $row["Shipping"];

  $s5 = "INSERT INTO orderDetail (OID, CID, OrderDtTm, PID, ProdName, ProdCode, CATID, CatName, ";
  $s5 = $s5 . "MFRID, MfrName, Dscrp, Quantity, Cost, Price, Markup, Weight, Shipping) VALUES (";
  $s5 = $s5 . sqlq($zo) . "," . sqlq($zc) . "," . sqlt($OrderDtTm) . "," . sqlq($dbPID) . ",";
  $s5 = $s5 . sqlq($dbProdName) . "," . sqlq($dbProdCode) . "," . sqlq($dbCATID) . ",";
  $s5 = $s5 . sqlq($dbCatName) . "," . sqlq($dbMFRID) . "," . sqlq($dbMfrName) . "," . sqlq($dbDscrp);
  $s5 = $s5 . "," . $dbQuantity . "," . $dbCost . "," . $dbPrice . "," . $dbMarkup . "," . $dbWeight;
  $s5 = $s5 . "," . $dbShipping . ")";
  $db->exec($s5);
 }

 // Empty the shopCart for this $zo
 $s2 = "DELETE FROM shopCart WHERE OID=" . sqlq($zo) . " AND CID=" . sqlq($zc);
 $db->exec($s2);

 // Make a new $zo, and build a new $s string
 $zo = CreateNewRndSt();
 while(isUsedOID($zo,$db)) {
  $zo = CreateNewRndSt();
 }
 $s = $zo . "@1@" . $zc;
?>
  <form method="post" name="frmNxp" action="lso.php">
   <input type="hidden" name="SelOID" value="<?php echo $SelOID; ?>"/>
   <input type="hidden" name="s" value="<?php echo $s; ?>"/>
  </form>
  <script>document.frmNxp.submit();</script>
<?php } ?>

<?php include("dbCLose.inc.php"); ?>
</body>
</htmL>