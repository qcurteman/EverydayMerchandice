<?php
 include("../myStore_func.inc.php");
 include("dbOpen.inc.php");
 include("fdaleGlob.inc.php");

 if ((trim($zo)=="") || (isUsedOID(trim($zo),$db))) {
  die('<script>window.location=\''.$storeURL.'\';</script>');
 }

 $tgPg = rqgp("tgPg");

 $lgnFirst = "<span style='font-weight:normal'>&ndash; Please login first</span>";
 if ($tgPg=="pch") {
  $titleLb = "Create / Edit My Order " . $lgnFirst;
 } elseif ($tgPg=="lso") {
  $titleLb = "My Orders " . $lgnFirst;
 } elseif ($tgPg=="myacct") {
  $titleLb = "My Account " . $lgnFirst;
 } else {
  $titleLb = "Login";
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
    $lftNavLnk = "lgn";
  ?>
  <td valign="top" bgcolor="<?php echo $bgcLNav; ?>" width="<?php echo $widLNav; ?>">
   <?php include("fdaleLNav.inc.php"); ?>
  </td>
  <td valign="top" width="100%">
   <?php include("fdaleHdr.inc.php"); ?>
   <div id="mainBlock">
    <h4><?php echo $titleLb; ?></h4>

<table border="0" cellpadding="0" cellspacing="0" width="100%"><tr>
 <td valign="top" width="50%">
  <p class="halfpad" style="background:#5070ff;color:#ffff9b">&#10148; <b>Returning Customer</b></p>
  <div style="border:1px solid brown;padding:2px 5px;height:150px">
   <i style="color:brown">Login to My Account</i>
   <table border="0" cellpadding="0" cellspacing="3">
    <?php if (rqgpIsSet("ErrorLgn")) { ?>
      <tr class="errMsg">
       <td align="right">
        <img src="imgs/arotrired.gif" border="0"/><img src="imgs/arotrired.gif" border="0"/>
       </td>
       <td><?php echo(rqgp("ErrorLgn")); ?></td>
      /tr>
    <?php } ?>
    <form method="post" action="lgnChk.php">
     <tr>
      <td valign="top">E-mail Address </td>
      <td valign="top">&nbsp;
       <input type="text" name="eml" value="<?php echo(rqgp("eml")); ?>"
		size="35" maxlength="255"/>
      </td>
     </tr>
     <tr>
      <td valign="top">Password</td>
      <td valign="top">&nbsp;
       <input type="password" name="pwd" value="<?php echo(htmlentities(rqgp("pwd"))); ?>"
		size="30" maxlength="50"/>
      </td>
     </tr>
     <tr>
      <td>&nbsp;</td>
      <td><input class="formBtn" type="submit" value="Submit"/></td>
     </tr>
     <input type="hidden" name="tgPg" value="<?php echo $tgPg; ?>"/>
     <input type="hidden" name="s" value="<?php echo $s; ?>"/>
    </form>
   </table>
  </div>
 </td>
 <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
 <td valign="top" width="50%">
  <p class="halfpad" style="background:#5070ff;color:#ffff9b">&#10148; <b>New Customer</b></p>
  <div style="border:1px solid brown;padding:2px 5px;height:150px">
   <i style="color:brown">Create A New Account</i><br />
   <form method="post" action="newacct.php">
    Please click <input class="formBtn" type="submit" value="New Account"/> to start creating
    a new <?php echo $storeNameAbbrv; ?> account.
    <input type="hidden" name="tgPg" value="<?php echo $tgPg; ?>"/>
    <input type="hidden" name="s" value="<?php echo $s; ?>"/>
   </form>
  </div>
 </td>
</tr></table>

    <?php include("fdaleFtr.inc.php"); ?>
   </div><!--mainBlock-->
  </td>
 </tr></table>

 <br /><br />
 <?php include("dbCLose.inc.php"); ?>
</body>
</htmL>