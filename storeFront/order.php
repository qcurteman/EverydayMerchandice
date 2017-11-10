<?php
 // http://127.0.110.1/110_myStore/storeFront/order.php
 // http://csci.jessup.edu/csci110/110_myStore/storeFront/order.php

 include("../myStore_func.inc.php");
 include("dbOpen.inc.php");
 include("fdaleGlob.inc.php");
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
    $lftNavLnk = "lso";
  ?>
  <td valign="top" bgcolor="<?php echo $bgcLNav; ?>" width="<?php echo $widLNav; ?>">
   <?php include("fdaleLNav.inc.php"); ?>
  </td>
  <td valign="top" width="100%">
   <?php include("fdaleHdr.inc.php"); ?>
   <div id="mainBlock">

 <?php 
  $orderNum = rqgp("vw");

  $s1 = "SELECT OrderDtTm, PmtMethod, Shipper, ShippedDtTm, isShipped, TrackingID, NotesFromCust FROM orderHeader WHERE OID=" . sqlq($orderNum) . " AND CID=" . sqlq($zc);
  $s2 = $db->query($s1);
  $row = $s2->fetch(PDO::FETCH_ASSOC);
  $dbOrderDtTm = $row["OrderDtTm"];
  $dbPmtMethod = $row["PmtMethod"];
  $dbShipper = $row["Shipper"];
  $dbShippedDtTm = $row["ShippedDtTm"];
  $dbisShipped = $row["isShipped"];
  $dbTrackingID = $row["TrackingID"];
  $dbNotesFromCust = $row["NotesFromCust"];

  $s1 = "SELECT BillToFName, BillToLName, Email, Address, City, AbRegion, Zip, Phone ";
  $s1 = $s1 . "FROM orderBillTo WHERE OID=" . sqlq($orderNum) . " AND CID=" . sqlq($zc);
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

    // FETCH ONE ROW OF DATA
  $s1 = "SELECT ShipToFName, ShipToLName, Email, Address, City, AbRegion, Zip, Phone, SameAsBillTo ";
  $s1 = $s1 . "FROM orderShipTo WHERE OID=" . sqlq($orderNum) . " AND CID=" . sqlq($zc);
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

  if($dbPmtMethod == "cc") $dbPmtMethod="Credit Card";
  else $dbPmtMethod="Debit Card";

 if ($dbShAbRg==$storeHomeState) { $theTaxRate=$storeTaxRate; } else { $theTaxRate=0; }
 ?>

   <div id="mainBlock">
    <div class="bcrumb">&#10017;
     <a href="javascript:document.frmPch.submit()">My Orders</a> &gt;
     Order # <?php echo $orderNum; ?>
    </div>
    <form method="post" name="frmShc" action="pch.php">
     <input type="hidden" name="s" value="<?php echo $s; ?>"/>
    </form>
<div style="margin-top:5px;border:1px solid #202020;padding:5px 8px">
 <table border="0" cellpadding="0" cellspacing="0" width="100%"><tr>
  <td valign="top"><h3>My Order</h3></td>
  <td valign="top" width="60%">
   <table border="0" cellpadding="0" cellspacing="3">
    <tr>
     <td valign="top" style="font-size:0.88em">SEND TO:</td>
     <td valign="top">
      <?php echo $storeName; ?><br /><?php echo $storeAddr; ?><br />      <span style="font-size:0.88em">E-MAIL:</span> <?php echo $storeEMail; ?><br />      <span style="font-size:0.88em">PHONE:</span> <?php echo $storePhone; ?><br />      <span style="font-size:0.88em">FAX:</span> <?php echo $storeFAX; ?><br />     </td>
    </tr>
    <tr>
     <td style="font-size:0.88em">ORDER DATE:</td>
     <td><?php echo $dbOrderDtTm; ?></td>
    </tr>
    <tr>
     <td style="font-size:0.88em">ORDER NUMBER:&nbsp;</td>
     <td><?php echo $orderNum; ?></td>
    </tr>
    <tr>
     <td style="font-size:0.88em">PAYMENT METHOD:</td>
     <td><?php echo $dbPmtMethod; ?></td>
    </tr>
   </table>
  </td>
 </tr></table>

 <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:8px"><tr>
  <td valign="top" width="38%"
	style="border-top:1px solid #202020;border-right:1px solid #202020">
   <b>BILL-TO:</b><br />
   &nbsp;&nbsp; <?php echo $dbBiFNm; ?> <?php echo $dbBiLNm; ?><br />   &nbsp;&nbsp; <?php echo $dbBiAddr; ?>, 
   <?php echo $dbBiCity; ?>, <?php echo $dbBiAbRg; ?>  <?php echo $dbBiZip; ?><br />   
   &nbsp;&nbsp; <span style="font-size:0.88em">E-MAIL:</span> <?php echo $dbBiEml; ?><br />   
   &nbsp;&nbsp; <span style="font-size:0.88em">PHONE:</span> <?php echo $dbBiPhn; ?>  </td>
  <td valign="top" width="38%"
	style="border-top:1px solid #202020;border-right:1px solid #202020;padding-left:5px">
   <b>SHIP-TO:</b><br />
   &nbsp;&nbsp; <?php echo $dbShFNm; ?> <?php echo $dbShLNm; ?><br />   &nbsp;&nbsp; <?php echo $dbShAddr; ?>, 
   <?php echo $dbShCity; ?>, <?php echo $dbShAbRg; ?>  <?php echo $dbShZip; ?><br />   
   &nbsp;&nbsp; <span style="font-size:0.88em">E-MAIL:</span> <?php echo $dbShEml; ?><br />   
   &nbsp;&nbsp; <span style="font-size:0.88em">PHONE:</span> <?php echo $dbShPhn; ?>  </td>
  <td valign="top" style="border-top:1px solid #202020;padding-left:5px">
   <b>NOTES:</b><br /><?php echo $dbNotesFromCust; ?></td>
 </tr></table>

 <table class="tbStyl" cellpadding="3" cellspacing="0" width="100%" style="margin-top:8px">
  <tr bgcolor="#efefef">
   <td>&nbsp;</td>
   <th>Mfr.</th>
   <th>Description</th>
   <th>P/N</th>
   <th>Qty.</th>
   <th>Price</th>
   <th>Ext. Price</th>
  </tr>
<?php
 // FETCH MORE THAN ONE ROW OF DATA
 $s1 = "SELECT ProdName, ProdCode, CatName, MfrName, Quantity, Dscrp, Price, Shipping ";
 $s1 = $s1 . " FROM orderDetail WHERE OID=" . sqlq($orderNum) . " AND CID=" . sqlq($zc) . " ORDER BY ProdName";
 $s2 = $db->query($s1);
 $s2->setFetchMode(PDO::FETCH_ASSOC); // fetches associative array, indexed by column name

 $SubTotal = 0;
 $shipping = 0;
 $knt = 1;
 while ($row = $s2->fetch()) {
  $dbProdName = $row["ProdName"];
  $dbProdCode = $row["ProdCode"];
  $dbDscrp = $row["Dscrp"];
  $dbPrice = $row["Price"];
  $dbShipping = $row["Shipping"];
  $dbCatName = $row["CatName"];
  $dbMfrName = $row["MfrName"];
  $dbQuantity = $row["Quantity"];

  $ExtPrice = $dbPrice * $dbQuantity;
  $SubTotal = $SubTotal + $ExtPrice;
  $shipping = $shipping + ($dbShipping * $dbQuantity); 
?>
  <tr>
   <td valign="top" align="right"><?php echo $knt; ?>.</td>
   <td valign="top"><?php echo $dbMfrName; ?></td>
   <td valign="top"><?php echo $dbDscrp."<br />(S&H $".number_format($dbShipping,2).")"; ?></td>
   <td valign="top"><?php echo $dbProdCode; ?></td>
   <td valign="top" align="center"><?php echo $dbQuantity; ?></td>
   <td valign="top" align="right">$<?php echo number_format($dbPrice,2); ?></td>
   <td valign="top" align="right">$<?php echo number_format($ExtPrice,2); ?></td>
  </tr>
 <?php
   $knt = $knt + 1;
  } // while ($row = $s2->fetch())...
 ?>
  <tr>
   <td colspan="3" rowspan="4"></td>
   <td valign="top" align="right" colspan="3">Sub-total</td>
   <td valign="top" align="right">$<?php echo number_format($SubTotal,2); ?></td>
  </tr>
  <tr>
   <td valign="top" align="right" colspan="3">Tax (<?php echo number_format($theTaxRate,2); ?>%)</td>
   <td valign="top" align="right">$<?php echo number_format(($theTaxRate/100) * $SubTotal,2); ?></td>
  </tr>
  <tr>
   <td valign="top" align="right" colspan="3">Shipping & Handling</td>
   <td valign="top" align="right">$<?php echo number_format($shipping,2); ?></td>
  </tr>
  <tr>
   <td valign="top" align="right" colspan="3"><b>TOTAL</b></td>
   <td valign="top" align="right"><b>$<?php echo number_format($SubTotal + $shipping + (($theTaxRate/100) * $SubTotal),2); ?></b></td>
  </tr>
 </table>

<?php 
  if($dbisShipped == 0) $isShipped = "No";
  else $isShipped = "Yes";

  if($dbShippedDtTm == "1969-12-31 00:00:00") $ShippedDtTm = "No";
  else $ShippedDtTm = $dbShippedDtTm;

  if($dbShipper == "") $Shipper = "n/a";
  else $Shipper = $dbShipper;

  if($dbTrackingID == "") $TrackingID = "n/a";
  else $TrackingID = $dbTrackingID;
?>

<div style="margin-top:10px;padding:5px 8px 10px 8px;background:#ffffca;border:1px solid brown">
  <span style="color:brown"><b>Merchandise Shipment</b></span><br />
  <table class="noStyl" cellpadding="0" cellspacing="5">
   <tr>
    <td style="font-size:0.88em">SHIPPED?</td>
    <td><?php echo $isShipped?></td>
   </tr>
   <tr>
    <td style="font-size:0.88em">DATE SHIPPED:</td>
    <td><?php echo $ShippedDtTm?></td>
   </tr>
   <tr>
    <td style="font-size:0.88em">SHIPPER:</td>
    <td><?php echo $Shipper?></td>
   </tr>
   <tr>
    <td style="font-size:0.88em">SHIPPER PHONE:&nbsp;</td>
    <td>n/a</td>
   </tr>
   <tr>
    <td style="font-size:0.88em">TRACKING ID:</td>
    <td>
     <?php echo $TrackingID?>         </td>
   </tr>
  </table>
 </div>
</div>


 

    <?php include("fdaleFtr.inc.php"); ?>
   </div><!--mainBlock-->
  </td>
 </tr></table>

 <form method="post" name="frmPch" action="lso.php">
  <input type="hidden" name="s" value="<?php echo $s; ?>"/>
 </form>

 <br /><br />
 <?php include("dbCLose.inc.php"); ?>
</body>
</htmL>