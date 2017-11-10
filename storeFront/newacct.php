<?php
 // http://127.0.110.1/110_myStore/storeFront/newacct.php
 // http://csci.jessup.edu/csci110/110_myStore/storeFront/newacct.php

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
    $lftNavLnk = "lgn";
  ?>
  <td valign="top" bgcolor="<?php echo $bgcLNav; ?>" width="<?php echo $widLNav; ?>">
   <?php include("fdaleLNav.inc.php"); ?>
  </td>
  <td valign="top" width="100%">
   <?php include("fdaleHdr.inc.php"); ?>


 <?php 
  $dbCstFNm = rqgp("fnm");
  $dbCstLNm = rqgp("lnm");
  $dbCstEml = rqgp("eml");
  $dbCstLgnPswd = rqgp("pswd");
  $dbCstAddr = rqgp("addr");
  $dbCstCity = rqgp("city");
  $dbCstAbRg = rqgp("abrg");
  $dbCstZip = rqgp("zip");


  $Ph1 = rqgp("ph1");
  $Ph2 = rqgp("ph2");
  $Ph3 = rqgp("ph3");

  $s1 = "SELECT LModiDtTm FROM customer WHERE CID=" .sqlq($zc);
  $s2 = $db->query($s1);
  $row = $s2->fetch(PDO::FETCH_ASSOC);
  $dbCstLastMod = $row["LModiDtTm"];

  $tgPg = rqgp("tgPg");
  if ($tgPg == "") $tgPg="home";
  
 ?>

 <div id="mainBlock">
    <div class="bcrumb" style="border-bottom:1px solid #202020">&#10017;
     <a href="javascript:document.frmLgn.submit()">Login</a> &gt; Create...
    </div>
    <form method="post" name="frmLgn" action="lgn.php">
     <input type="hidden" name="s" value="<?php echo $s; ?>"/>
     <input type="hidden" name="tgPg" value="<?php echo $tgPg; ?>"/>
    </form>

    <h4>Create A New Flamingdale Account</h4>


<table border="0" cellspacing="5" cellpadding="0">
<?php if(rqgpIsSet("ErrorAdd")) $error = rqgp("ErrorAdd");
      else $error = ""; ?>
     <tr>
      
      <td>
               <i>All data fields are required.</i>
            </tr>
       <?php if($error != "") {?>
           <tr class="errMsg">
       <td align="right">
        <img src="imgs/arotrired.gif" border="0"/><img src="imgs/arotrired.gif" border="0"/>
       </td>
       <td><?php echo $error; ?></td>
      </tr>
          <tr> <?php } ?>

              <form method="post" action="newacctchk.php">
            <td align="right">First Name:</td>
      <td>
                <input type="text" name="fnm" value="<?php echo $dbCstFNm; ?>" size="25" maxlength="50"/>
             </td>
     </tr>
     <tr>
      <td align="right">Last Name:</td>
      <td>
                <input type="text" name="lnm" value="<?php echo $dbCstLNm; ?>" size="25" maxlength="50"/>
             </td>
     </tr>
     <tr>
      <td align="right">Postal Address:</td>
      <td>
                <input type="text" name="addr" value="<?php echo $dbCstAddr; ?>" size="50" maxlength="255"/>
             </td>
     </tr>
     <tr>
      <td align="right">City:</td>
      <td>
                <input type="text" name="city" value="<?php echo $dbCstCity; ?>" size="30" maxlength="50"/>
             </td>
     </tr>
     <tr>
      <td align="right">State:</td>
      <td>
               <select name="abrg">
 	 <option value=""></option>
	 <option value="AL" <?php if( $dbCstAbRg=="AL"){?>selected<?php }?> > Alabama </option>
	 <option value="AK" <?php if( $dbCstAbRg=="AK"){?>selected><?php }?> > Alaska </option>
	 <option value="AZ" <?php if( $dbCstAbRg=="AZ"){?>selected><?php }?> > Arizona </option>
	 <option value="AR" <?php if( $dbCstAbRg=="AR"){?>selected><?php }?> > Arkansas </option>
	 <option value="CA" <?php if( $dbCstAbRg=="CA"){?>selected<?php }?> > California </option>
	 <option value="CO" <?php if( $dbCstAbRg=="CO"){?>selected<?php }?> > Colorado </option>
	 <option value="CT" <?php if( $dbCstAbRg=="CT"){?>selected<?php }?> > Connecticut </option>
	 <option value="DE" <?php if( $dbCstAbRg=="DE"){?>selected<?php }?> > Delaware </option>
	 <option value="DC" <?php if( $dbCstAbRg=="DC"){?>selected<?php }?> > District of Columbia </option>
	 <option value="FL" <?php if( $dbCstAbRg=="FL"){?>selected<?php }?> > Florida </option>
	 <option value="GA" <?php if( $dbCstAbRg=="GA"){?>selected<?php }?> > Georgia </option>
	 <option value="HI" <?php if( $dbCstAbRg=="HI"){?>selected<?php }?> > Hawaii </option>
	 <option value="ID" <?php if( $dbCstAbRg=="ID"){?>selected<?php }?> > Idaho </option>
	 <option value="IL" <?php if( $dbCstAbRg=="IL"){?>selected<?php }?> > Illinois </option>
	 <option value="IN" <?php if( $dbCstAbRg=="IN"){?>selected<?php }?> > Indiana </option>
	 <option value="IA" <?php if( $dbCstAbRg=="IA"){?>selected<?php }?> > Iowa </option>
	 <option value="KS" <?php if( $dbCstAbRg=="KS"){?>selected<?php }?> > Kansas </option>
	 <option value="KY" <?php if( $dbCstAbRg=="KY"){?>selected<?php }?> > Kentucky </option>
	 <option value="LA" <?php if( $dbCstAbRg=="LA"){?>selected<?php }?> > Louisiana </option>
	 <option value="ME" <?php if( $dbCstAbRg=="ME"){?>selected<?php }?> > Maine </option>
	 <option value="MD" <?php if( $dbCstAbRg=="MD"){?>selected<?php }?> > Maryland </option>
	 <option value="MA" <?php if( $dbCstAbRg=="MA"){?>selected<?php }?> > Massachusetts </option>
	 <option value="MI" <?php if( $dbCstAbRg=="MI"){?>selected<?php }?> > Michigan </option>
	 <option value="MN" <?php if( $dbCstAbRg=="MN"){?>selected<?php }?> > Minnesota </option>
	 <option value="MS" <?php if( $dbCstAbRg=="MS"){?>selected<?php }?> > Mississippi </option>
	 <option value="MO" <?php if( $dbCstAbRg=="MO"){?>selected<?php }?> > Missouri </option>
	 <option value="MT" <?php if( $dbCstAbRg=="MT"){?>selected<?php }?> > Montana </option>
	 <option value="NE" <?php if( $dbCstAbRg=="NE"){?>selected<?php }?> > Nebraska </option>
	 <option value="NV" <?php if( $dbCstAbRg=="NV"){?>selected<?php }?> > Nevada </option>
	 <option value="NH" <?php if( $dbCstAbRg=="NH"){?>selected<?php }?> > New Hampshire </option>
	 <option value="NJ" <?php if( $dbCstAbRg=="NJ"){?>selected<?php }?> > New Jersey </option>
	 <option value="NM" <?php if( $dbCstAbRg=="NM"){?>selected<?php }?> > New Mexico </option>
	 <option value="NY" <?php if( $dbCstAbRg=="NY"){?>selected<?php }?> > New York </option>
	 <option value="NC" <?php if( $dbCstAbRg=="NC"){?>selected<?php }?> > North Carolina </option>
	 <option value="ND" <?php if( $dbCstAbRg=="ND"){?>selected<?php }?> > North Dakota </option>
	 <option value="OH" <?php if( $dbCstAbRg=="OH"){?>selected<?php }?> > Ohio </option>
	 <option value="OK" <?php if( $dbCstAbRg=="OK"){?>selected<?php }?> > Oklahoma </option>
	 <option value="OR" <?php if( $dbCstAbRg=="OR"){?>selected<?php }?> > Oregon </option>
	 <option value="PA" <?php if( $dbCstAbRg=="PA"){?>selected<?php }?> > Pennsylvania </option>
	 <option value="RI" <?php if( $dbCstAbRg=="RI"){?>selected<?php }?> > Rhode Island </option>
	 <option value="SC" <?php if( $dbCstAbRg=="SC"){?>selected<?php }?> > South Carolina </option>
	 <option value="SD" <?php if( $dbCstAbRg=="SD"){?>selected<?php }?> > South Dakota </option>
	 <option value="TN" <?php if( $dbCstAbRg=="TN"){?>selected<?php }?> > Tennessee </option>
	 <option value="TX" <?php if( $dbCstAbRg=="RX"){?>selected<?php }?> > Texas </option>
	 <option value="UT" <?php if( $dbCstAbRg=="UT"){?>selected<?php }?> > Utah </option>
	 <option value="VT" <?php if( $dbCstAbRg=="VT"){?>selected<?php }?> > Vermont </option>
	 <option value="VA" <?php if( $dbCstAbRg=="VA"){?>selected<?php }?> > Virginia </option>
	 <option value="WA" <?php if( $dbCstAbRg=="WA"){?>selected<?php }?> > Washington </option>
	 <option value="WV" <?php if( $dbCstAbRg=="WV"){?>selected<?php }?> > West Virginia </option>
	 <option value="WI" <?php if( $dbCstAbRg=="WI"){?>selected<?php }?> > Wisconsin </option>
	 <option value="WY" <?php if( $dbCstAbRg=="WY"){?>selected<?php }?> > Wyoming </option>
        </select>
             </td>
     </tr>
     <tr>
      <td align="right">Zip:</td>
      <td>
                <input type="text" name="zip" value="<?php echo $dbCstZip; ?>" size="10" maxlength="10"/>
             </td>
     </tr>
     <tr>
      <td align="right">Telephone:</td>
      <td>
                <input type="text" name="ph1" value="<?php echo $Ph1; ?>" size="3" maxlength="3"/> &ndash;
         <input type="text" name="ph2" value="<?php echo $Ph2; ?>" size="3" maxlength="3"/> &ndash;
         <input type="text" name="ph3" value="<?php echo $Ph3; ?>" size="4" maxlength="4"/>
             </td>
     </tr>
     <tr>
      <td align="right">E-mail Address:</td>
      <td>
                <input type="text" name="eml" value="<?php echo $dbCstEml; ?>" size="50" maxlength="255"/>
             </td>
     </tr>
     <tr>
      <td align="right" nowrap>Login Password:</td>
      <td>
                <input type="text" name="pswd" value="<?php echo $dbCstLgnPswd; ?>" size="50" maxlength="255"/>
             </td>
     </tr>
            <tr><td style="height:5px"></td></tr>
       <tr bgcolor="#e0e0e0">
        <td>&nbsp;</td>
        <td>
       <table border="0" cellpadding="0" cellspacing="3"><tr>
	<td><input class="formBtn" type="submit" value="CREATE"/></td>
        <input type="hidden" name="tgPg" value="<?php echo $tgPg; ?>"/>
	<input type="hidden" name="s" value="<?php echo $s; ?>"/>
	</form>
	<form method="post" action="lgn.php">
	 <td><input class="formBtn" type="submit" value="Cancel"/></td>
         <input type="hidden" name="tgPg" value="<?php echo $tgPg; ?>"/>
	 <input type="hidden" name="s" value="<?php echo $s; ?>"/>
	</form>
       </tr></table>
      </td></table>






    <?php include("fdaleFtr.inc.php"); ?>
   </div><!--mainBlock-->
  </td>
 </tr></table>



<form method="post" name="frmRfs" action="myacct.php">
 <input type="hidden" name="s" value="<?php echo $s; ?>"/>
</form>
<form method="post" name="frmEdt" action="myacct.php">
 <input type="hidden" name="e" value="da"/>
 <input type="hidden" name="s" value="<?php echo $s; ?>"/>
</form>

 <br /><br />
 <?php include("dbCLose.inc.php"); ?>
</body>
</htmL>