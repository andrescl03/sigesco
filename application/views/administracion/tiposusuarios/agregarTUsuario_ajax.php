<?php
if(isset($mensaje["error"])) { 
?>
	<div class="alert alert-danger" role="alert"><?php echo $mensaje["error"]; ?></div>
<?php }else{ ?>	
	<div class="alert alert-success" role="alert"><?php echo $mensaje["success"]; ?></div>
<?php }  ?>