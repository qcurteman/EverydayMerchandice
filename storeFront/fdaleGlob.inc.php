
<?php
 $bgcLNav = "black";
 $widLNav = "180px";

 // Storefront info
 //$storeURL = "http://127.0.110.1/110_myStore/storeFront/home.php";
 $storeURL = "http://127.0.110.1/OnlineStore/storeFront/home.php";
 $storeName = "Everyday Merchandice";
 $storeNameAbbrv = "Everyday";
 $storeAddr = "111 Main Str, Stormwind, CA 95110";
 $storeEMail = "info@everyday.com";
 $storePhone = "408-111-2222";
 $storeFAX = "408-111-2223";
 $storeHomeState = "CA";
 $storeTaxRate = "8.75";

 // Anonymous customer
 $anonCID = "95765W60187L18015H14744";

 // The s ("state" string) handler:
 // The syntax of $s string: oid@login status@cid
 if (!isset($_GET["s"]) && isset($_POST["s"]) && trim($_POST["s"]) <> "") {
  //////////// ACHTUNG!!!
  //   (a) $_POST["s"] fails if no s param exists, i.e., no s param was ever
  // "posted" by a form; therefore, isset($_POST["s"]) must precede $_POST["s"]
  // to avoid an error in case no s param was ever "posted";
  //   (b) The && boolean operator in PHP operates on short-circuit principle,
  // thus if the expression isset($_POST["s"]) is false, the entire (boolean)
  // conditional expression is also false.
  //////////// ACHTUNG!!!
  $s = rqgp("s");
  $sArr = explode('@',$s);
  $zo = $sArr[0]; /* OID+session ID */
  $zn = $sArr[1]; /* 1==is logged in, 0==is not */
  $zc = $sArr[2]; /* CID */
 } else {
  // assign default values
  $zo = "";
  $zn = 0;
  $zc = $anonCID; /* anonymous cust */
 }

 // Get custName, if logged in.
 $s1 = "SELECT firstName, lastName FROM customer WHERE CID=" . sqlq($zc);
 $s2 = $db->query($s1);
 $row = $s2->fetch(PDO::FETCH_ASSOC);
 if ($row["firstName"] || $row["lastName"]) {
  $custName = $row["firstName"] . " " . $row["lastName"];
 } else {
  $custName = ShwDtTm(date('Y-m-d'),0,0);
 }

 // DOES THERE EXIST ...?  Used in fdaleLNav.inc.php, pch.php
 $hasPch = FALSE;
 $s1 = "SELECT Count(OID) FROM orderHeader WHERE OID=" . sqlq($zo) . " AND CID=" . sqlq($zc);
 $hmny = $db->query($s1)->fetchColumn();
 if ($hmny > 0) { $hasPch=TRUE; }

/*------------------*/
/* Global functions */
/*------------------*/
 function isUsedOID($chkThisOID,$db) {
  $s1 = "SELECT Count(orderHeader.OID) FROM orderHeader,orderDetail ";
  $s1 = $s1 . "WHERE orderHeader.OID=" . sqlq($chkThisOID) . " ";
  $s1 = $s1 . "AND orderHeader.OID=orderDetail.OID ";
  $s1 = $s1 . "AND (orderHeader.orderType='P' OR orderHeader.orderType='Q')";
  $hmny = $db->query($s1)->fetchColumn();
  if ($hmny > 0) { $rs=TRUE; } else { $rs=FALSE; } 
  return $rs;
 }
?>