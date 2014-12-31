<?php

session_start();

$GLOBALS['config'] = array(
	'mysql' => array(
		'host' => '127.0.0.1',
		'username' => 'root',
		'password' => 'root',
		'db' => 'nudostilo'
	),
	'remember' => array(
		'cookie_name' => 'hash',
		'cookie_expire' => 604800
	),
	'session' => array(
		'session_name' => 'user',
		'token_name' => 'token'
	)
);

spl_autoload_register(function($class) {
	require_once('php/classes/'.$class.'.php');
});

require_once('php/functions/sanitize.php');