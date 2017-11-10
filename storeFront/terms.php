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
<title>Everyday Merchandice</title>
<link rel="stylesheet" type="text/css" href="../myStore_style.css">
</head>
<body>
 <table border="0" cellpadding="0" cellspacing="0" width="100%"><tr>
  <?php
    $lftNavLnk = "";
  ?>
  <td valign="top" bgcolor="<?php echo $bgcLNav; ?>" width="<?php echo $widLNav; ?>">
   <?php include("fdaleLNav.inc.php"); ?>
  </td>
  <td valign="top" width="100%">
   <?php include("fdaleHdr.inc.php"); ?>
   <div id="mainBlock">
    <h4>Terms of Use</h4>
    <?php include("terms.inc.php"); ?>

    <?php include("fdaleFtr.inc.php"); ?>
   </div><!--mainBlock-->
  </td>
 </tr></table>

 <br /><br />
 <?php include("dbCLose.inc.php"); ?>
</body>
</htmL>
