<div style="padding:0 5px;background:#a36c00;color:navy;border-bottom:2px solid red;text-align:right">
 <a href="javascript:document.frmAbout.submit()">About</a> &#149;
 <a href="javascript:document.frmTerms.submit()">Terms of Use</a> &#149;
 <a href="javascript:document.frmPriv.submit()">Privacy Policy</a> &nbsp;&nbsp;&nbsp;
 <span style="font-size:1.66em"><b><?php echo $storeName; ?></b></span>
</div>

<form method="post" name="frmAbout" action="about.php">
 <input type="hidden" name="s" value="<?php echo $s; ?>"/>
</form>
<form method="post" name="frmTerms" action="terms.php">
 <input type="hidden" name="s" value="<?php echo $s; ?>"/>
</form>
<form method="post" name="frmPriv" action="privacy.php">
 <input type="hidden" name="s" value="<?php echo $s; ?>"/>
</form>



