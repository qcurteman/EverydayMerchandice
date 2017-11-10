
<?php
 function getBgColr($p1,$p2,$p3) {
  if ($p1==$p2) { $bgColr="#5070ff"; } else { $bgColr=$p3; }
  return $bgColr;
 }

 $s1 = "SELECT Count(PID) FROM shopCart WHERE OID=" . sqlq($zo);
 $hmnyInShc = $db->query($s1)->fetchColumn();
 if ($hmnyInShc <= 0) {
  $hmnyInShcLb = "(empty)";
 } elseif ($hmnyInShc==1) {
  $hmnyInShcLb = "(1 item)";
 } else {
  $hmnyInShcLb = "(".$hmnyInShc." items)";
 }
?>

<style>
 #leftNav a:link {color:#ffff9b; text-decoration:none;}
 #leftNav a:visited {color:#ffff9b; text-decoration:none;}
 #leftNav a:hover {color:#ff2020; text-decoration:underline;}
 #leftNav a:active {color:#ffff9b; text-decoration:none;}
 #leftNav p {color:#ffffff;padding-bottom:5px;border-bottom:1px solid #b0b0b0}
 #leftNav .sm {font-size:0.85em;font-style:normal}
</style>

<div id="leftNav" style="background:<?php echo $bgcLNav; ?>;width:<?php echo $widLNav; ?>">
 <div style="width:97%">
  <p align="right" class="quarterpad"><?php echo $custName; ?></p>
  <p class="quarterpad" style="background:<?php echo getBgColr('home',$lftNavLnk,$bgcLNav); ?>">
	&#149; <a href="javascript:document.navHome.submit()">Home</a></p>

  <p class="quarterpad" style="background:<?php echo getBgColr('shc',$lftNavLnk,$bgcLNav); ?>">
	&#149; <a href="javascript:document.navShc.submit()">Shopping Cart</a><br />
        &nbsp; <span style="font-style:normal;font-size:0.8em"><?php echo $hmnyInShcLb; ?></span></p>

  <?php if ($hasPch) { ?>
    <p class="quarterpad" style="background:<?php echo getBgColr('pch',$lftNavLnk,$bgcLNav); ?>">
     &nbsp;&nbsp; <a href="javascript:document.navPch.submit()"><span class="sm">Create / Edit
		My Order</span></a></p>

    <p class="quarterpad" style="background:<?php echo getBgColr('osum',$lftNavLnk,$bgcLNav); ?>">
     &nbsp;&nbsp; <a href="javascript:document.navOSum.submit()"><span class="sm">My Order
		Summary</span></a></p>
  <?php } ?>

  <?php if ($zn=="1" && $zc <> $anonCID) { ?>
    <p class="quarterpad" style="background:<?php echo getBgColr('lgo',$lftNavLnk,$bgcLNav); ?>">
	&#149; <a href="javascript:document.navLgo.submit()">LOGOUT</a><br />
        &nbsp; <span style="font-style:normal;font-size:0.8em">(YOU ARE LOGGED IN)</span></p>
  <?php } else { ?>
    <p class="quarterpad" style="background:<?php echo getBgColr('lgn',$lftNavLnk,$bgcLNav); ?>">
	&#149; <a href="javascript:document.navLgn.submit()">Login</a></p>
  <?php } ?>

  <p class="quarterpad" style="background:<?php echo getBgColr('lso',$lftNavLnk,$bgcLNav); ?>">
	&#149; <a href="javascript:document.navLso.submit()">My Orders</a></p>

  <p class="quarterpad" style="background:<?php echo getBgColr('myacct',$lftNavLnk,$bgcLNav); ?>">
	&#149; <a href="javascript:document.navMyAcct.submit()">My Account</a></p>
 </div>
 <br /><br />
</div>

<form method="post" name="navHome" action="home.php">
 <input type="hidden" name="s" value="<?php echo $s; ?>"/>
</form>
<form method="post" name="navShc" action="shc.php">
 <input type="hidden" name="s" value="<?php echo $s; ?>"/>
</form>
<form method="post" name="navPch" action="pch.php">
 <input type="hidden" name="s" value="<?php echo $s; ?>"/>
</form>
<form method="post" name="navOSum" action="osum.php">
 <input type="hidden" name="s" value="<?php echo $s; ?>"/>
</form>
<form method="post" name="navLgn" action="lgn.php">
 <input type="hidden" name="s" value="<?php echo $s; ?>"/>
</form>
<form method="post" name="navLgo" action="lgo.php">
 <input type="hidden" name="s" value="<?php echo $s; ?>"/>
</form>
<form method="post" name="navLso" action="lso.php">
 <input type="hidden" name="s" value="<?php echo $s; ?>"/>
</form>
<form method="post" name="navMyAcct" action="myacct.php">
 <input type="hidden" name="s" value="<?php echo $s; ?>"/>
</form>