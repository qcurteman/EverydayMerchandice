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
    <?php //include("../storeBackOffice/about.inc.php"); 
?>

<div id="mainBlock">
    <h4>About Flamingdale Mercantile, Inc.</h4>
       <p class="halfpad"><?php echo $storeName; ?></p>
   <p class="quarterpad"><?php echo $storeAddr; ?></p>
   <p class="quarterpad">Business hours: 10:00am &ndash; 5:00pm</p>
   <p class="quarterpad">Phone: <?php echo $storePhone; ?></p>
   <p class="quarterpad">E-mail: <?php echo $storeEMail; ?></p>


    <?php include("fdaleFtr.inc.php"); ?>
   </div><!--mainBlock-->
  </td>
 </tr></table>

 <br /><br />
 <?php include("dbCLose.inc.php"); ?>
</body>
</htmL>
