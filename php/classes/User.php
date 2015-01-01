<?php

class User {

	private $_db = null,
			$_data,
			$_sessionName,
			$_cookieName,
			$_isLoggedIn = false;

	public function __construct($user = null) {
		$this->_db = DB::getInstance();
		$this->_sessionName = Config::get('session/session_name');
		$this->_cookieName = Config::get('remember/cookie_name');

		if(!$user) {
			if(Session::exists($this->_sessionName)) {
				$user = Session::get($this->_sessionName);

				if($this->find('id', $user)) {
					$this->_isLoggedIn = true;
				} else {
					//logout
				}
			}
		} else {
			$this->find('id', $user);
		}
	}

	public function create($fields = array()) {
		if(!$this->_db->insert('users', $fields)) {
			throw new Exception('There was a problem creating an account');
		}
	}

	public function find($field, $item) {
		$data = $this->_db->get('users', array($field, '=', $item));
		if($data->count()) {
			$this->_data = $data->firstResult();
			return true;
		}
		return false;
	}

	public function login($email = null, $password = null) {
		if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$user = $this->find('email', $email);
		} else {
			$user = $this->find('handle', $email);
		}

		if(!$email && !$password && $this->exists()) {
			Session::put($this->_sessionName, $this->data()->id);
		} else {
			if($user) {
				if($this->data()->password === Hash::make($password, $this->data()->password_salt)) {
					Session::put($this->_sessionName, $this->data()->id);

					//Remember the user
					$hashCheck = $this->_db->get('users_remember', array('user_id', '=', $this->data()->id));
					if(!$hashCheck->count()) {
						$hash = Hash::unique();
						$this->_db->insert('users_remember', array(
							'user_id' => $this->data()->id,
							'hash' => $hash,
							'last_login_ip' => Server::getIP()
						));
					} else {
						$hash = $hashCheck->firstResult()->hash;
					}

					Cookie::put($this->_cookieName, $hash, Config::get('remember/cookie_expire'));

					Redirect::to('index.php');
				}
			}
		}
		return false;
	}

	public function logout() {
		$this->_db->delete('user_remember', array('user_id', '=', $this->data()->id));

		Session::delete($this->_sessionName);
		Cookie::delete($this->_cookieName);
	}

	public function data() {
		return $this->_data;
	}

	public function isLoggedIn() {
		return $this->_isLoggedIn;
	}

	public function exists() {
		return (!empty($this->_data)) ? true : false;
	}

}