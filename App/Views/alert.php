<?php

use System\Core\Session;

if(Session::has('success')){
?>

<div class="alert alert-success" role="alert">
  <?=Session::get('success');?>
  <?=Session::remove('success');?>
</div>

<?php }

if(Session::has('error')){ ?>

<div class="alert alert-danger" role="alert">
<?=Session::get('error');?>
<?=Session::remove('error');?>
</div>

<?php } ?>