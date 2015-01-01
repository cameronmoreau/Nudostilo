<?php

session_start();
ob_start();

$GLOBALS['config'] = array(
	'mysql' => array(
		'host' => '127.0.0.1',
		'username' => 'root',
		'password' => 'root',
		'db' => 'nudostilo'
	),
	'remember' => array(
		'cookie_name' => 'hash',
		'cookie_expire' => 432000
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

if(Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name'))) {
	$hash = Cookie::get(Config::get('remember/cookie_name'));
	$hashCheck = DB::getInstance()->get('users_remember', array('hash', '=', $hash));

	if($hashCheck->count()) {
		$last_ip = $hashCheck->firstResult()->last_login_ip;
		$user = new User($hashCheck->firstResult()->user_id);
		if($last_ip == Server::getIP()) {
			$user->login();
		} else {
			DB::getInstance()->delete('users_remember', array('hash', '=', $hash));
			$user->logout();
		}
		
	}
}