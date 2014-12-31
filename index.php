<?php require_once('php/core/init.php'); ?>
Blank page

<?php
	if(Session::exists('success')) {
		echo Session::flash('success');
	}
?>