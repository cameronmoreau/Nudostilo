<?php require_once('php/core/init.php'); ?>

<?php
	$user = new User();
	$user->logout();
	Redirect::to('index.php');
?>