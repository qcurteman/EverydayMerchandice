<?php
 // http://127.0.110.1/110_myStore/storeFront/bag.php
 // http://csci.jessup.edu/csci110/110_myStore/storeFront/bag.php

 include("../myStore_func.inc.php");
 include("dbOpen.inc.php");
 include("fdaleGlob.inc.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>bag.php</title>
</head>
<body>

<?php
 $PID = rqgp("pid");

 $s1 = "SELECT Count(PID) FROM shopCart WHERE PID=" . sqlq($PID) . " AND OID=" . sqlq($zo);
 $hmny = $db->query($s1)->fetchColumn();

 if ($hmny <= 0 )
 {
    $s2 = "SELECT ProdName, ProdCode, CATID, MFRID, Dscrp, Cost, Price, Markup, Weight, Shipping FROM product WHERE PID=" . sqlq($PID);
    $s3 = $db->query($s2);
    $row = $s3->fetch(PDO::FETCH_ASSOC);

    $dbProdName = $row["ProdName"];
    $dbProdCode = $row["ProdCode"];
    $dbCATID    = $row["CATID"];
    $dbMFRID    = $row["MFRID"];
    $dbDscrp    = $row["Dscrp"];
    $dbCost     = $row["Cost"];
    $dbPrice    = $row["Price"];
    $dbMarkup   = $row["Markup"];
    $dbWeight   = $row["Weight"];
    $dbShipping = $row["Shipping"];

    $s5 = "SELECT CatName FROM cat WHERE CATID=" . sqlq($dbCATID);
    $s6 = $db->query($s5);
    $row2 = $s6->fetch(PDO::FETCH_ASSOC);
    $dbCatName  = $row2["CatName"];

    $s5 = "SELECT MfrName FROM mfr WHERE MFRID=" . sqlq($dbMFRID);
    $s6 = $db->query($s5);
    $row3 = $s6->fetch(PDO::FETCH_ASSOC);
    $dbMfrName  = $row3["MfrName"];

    $s4 = "INSERT INTO shopCart (OID, CID, EnteredDtTm, PID, ProdName, ProdCode,";
    $s4 = $s4 . " CATID, CatName, MFRID, MfrName, Dscrp, Quantity, Cost, Price, Markup, Weight, Shipping)";
    $s4 = $s4 . " VALUES (" . sqlq($zo) . ", " . sqlq($zc) . ", " . sqlt(GetNowDtTm()) . ", " . sqlq($PID) . ", " . sqlq($dbProdName);
    $s4 = $s4 . ", " . sqlq($dbProdCode) . ", " . sqlq($dbCATID) . ", " . sqlq($dbCatName) . ", " . sqlq($dbMFRID) . ", " . sqlq($dbMfrName) . ", " . sqlq($dbDscrp);
    $s4 = $s4 . ", 1, " . $dbCost . ", " . $dbPrice . ", " . $dbMarkup . ", " . $dbWeight . ", " . $dbShipping . ")";
    $db->exec($s4);
 }
?>

 <form method="post" name="frmNxp" action="shc.php">
  <input type="hidden" name="SelPID" value="<?php echo $PID; ?>"/>
  <input type="hidden" name="s" value="<?php echo $s; ?>"/>
 </form>
 <script>document.frmNxp.submit();</script>

 <?php include("dbCLose.inc.php"); ?>
</body>
</html>