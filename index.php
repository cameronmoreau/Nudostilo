<?php require_once('php/core/init.php'); ?>
Blank page

<?php
	if(Session::exists('success')) {
		echo Session::flash('success');
	}

	if(Session::exists(Config::get('session/session_name'))) {
		echo Session::get(Config::get('session/session_name'));
	}

	echo Server::getIP();

	$u = new User();
	$u2 = new User(11);

	echo $u2->data()->handle;

	if($u->isLoggedIn()) {
		echo "LOGGED IN";
	}
?>