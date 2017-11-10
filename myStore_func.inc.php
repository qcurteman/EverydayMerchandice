
<?php /*Global utility functions*/

// Fn CreateNewRndSt() returns a string in the form of integer-integer-integer.
 function CreateNewRndSt() {
  $n1 = mt_rand(999,999999);
  $n2 = mt_rand(999,999999);
  $n3 = mt_rand(999,999999);
  $nnic = $n1."-".$n2."-B".$n3;
  return $nnic;
 }

// Fn IsAfter() returns True if dt1 is after dt2.
 function IsAfter($dt1,$dt2) {
  $i_dt1 = strtotime($dt1);
  $i_dt2 = strtotime($dt2);
  if ($i_dt1 > $i_dt2) { $rs=True; } else { $rs=False; } 
  return $rs;
 }

// Fn ShwDtTm() returns formatted datetime string.
 function ShwDtTm($dt,$boolTm,$boolBrk) {
  $dtStr = date("j-M-Y",strtotime($dt));
  if ($boolTm == "1") {
   if ($boolBrk == "1") {
    $dtStr = $dtStr."<br />".date("g:i:s a",strtotime($dt));
   } else {
    $dtStr = date("j-M-Y g:i:s a",strtotime($dt));
   }
  }
  return $dtStr;
 }

// Fn GetNowDtTm() returns timestring now.
 function GetNowDtTm() {
  return date("Y-m-d H:i:s");
 }

//---------------------
 function GetNumOfRowsODBC($qRslt) {
  $num_rows = 0;
  while ($temp = odbc_fetch_into($qRslt,$counter)) {
   $num_rows++;
  }
  @odbc_fetch_row($qRslt,0); //reset cursor
  return $num_rows;
 }

//---------------------
// Equivalent to SMX %sql-quote() macro.
 function sqlq($strg) {
  if (!isset($strg)) { $strg=""; }
  $qstrg = "'" . str_ireplace("'","''",$strg) . "'";
  return $qstrg;
 }

// Assumes strg is a well-formed PHP date string.
 function sqlt($strg) {
  if (!isset($strg)) { $strg=""; }
  $qstrg = "#" . $strg . "#";
  return $qstrg;
 }

//---------------------
// Replacement for $_REQUEST[].  Avoids accepting cookies entered as $rqpar.
 function rqgp($rqpar) {
  if (isset($_GET["$rqpar"]) && isset($_POST["$rqpar"])) {
   return array_merge($_GET["$rqpar"],$_POST["$rqpar"]);
  } elseif (isset($_GET["$rqpar"])) {
   return $_GET["$rqpar"];
  } elseif (isset($_POST["$rqpar"])) {
   return $_POST["$rqpar"];
  } else {
   return "";
  }
 }

 function rqgpIsSet($rqpar) {
  if (isset($_GET["$rqpar"]) || isset($_POST["$rqpar"])) {
   return TRUE;
  } else {
   return FALSE;
  }
 }
?>
