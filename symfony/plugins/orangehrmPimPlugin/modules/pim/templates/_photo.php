<div id="profile-pic">
    
<h1>
<?php
//echo $fullName; 	

// 20160426 START
$var_holder = explode("|", $fullName);

$fullName = $var_holder[0];

echo $fullName ;
// END
?>
</h1>
  <div class="imageHolder">

<?php if ($photographPermissions->canUpdate() || $photographPermissions->canDelete()) : 
?>
  <a href="<?php echo url_for('pim/viewPhotograph?empNumber=' . $empNumber); ?>" title="<?php echo __('Change Photo'); ?>" class="tiptip">
<?php else: ?>
  <a href="#">
<?php endif; ?>

    <img alt="Employee Photo" src="<?php echo url_for("pim/viewPhoto?empNumber=". $empNumber); ?>" border="0" id="empPic" 
     width="<?php echo $width; ?>" height="<?php echo $height; ?>"/>
  </a>

  </div>    
</div> <!-- profile-pic -->


<?php
// 20160426 START
if ($var_holder[1] == 1) {
?>
<img style="margin-top:15px;margin-bottom:-5px;" border="0" width="201" height="50" alt="Confidential" src="/orange/symfony/web/images/confidential.png" id="empPic">

<?php
}
// END
?>