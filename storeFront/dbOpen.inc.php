
<?php
 // Define the database using ODBC DSN
 $odbcDSN = "myOnlineStore_2017"; // DSN of myStore_2017.accdb
 $loginID = "";
 $psswd = "";
 try {
  $db = new PDO("odbc:$odbcDSN","$loginID","$psswd");
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 }
 catch(PDOException $e) {
  die("[ERROR: " . $e->getMessage() . "]");
 }
?>