<?php

class Validate {

	private $_passed = false,
			$_errors = array(),
			$_db = null;

	public function __construct() {
		$this->_db = DB::getInstance();
	}

	public function check($source, $items = array()) {
		foreach($items as $item => $rules) {
			foreach($rules as $rule => $rule_value) {
				$item_name = str_replace('_', ' ', $item);
				$value = trim($source[$item]);

				if($rule === 'required' && empty($value)) {
					$this->addError("{$item_name} is required");
				} else if(!empty($value)) {
					switch($rule) {
						case 'min':
							if(strlen($value) < $rule_value) {
								$this->addError("{$item_name} must have a minimum of {$rule_value} characeters");
							}
						break;
						case 'max':
							if(strlen($value) > $rule_value) {
									$this->addError("{$item_name} must have a maximum of {$rule_value} characeters");
								}
						break;
						case 'same':
							if($value !== $source[$rule_value]) {
								$this->addError("{$item_name} must match {$rule_value}");
							}
						break;
						case 'email':
							if(!filter_var($value, FILTER_VALIDATE_EMAIL)) {
								$this->addError("A valid email address is required");
							}
						break;
						case 'unique':
							$check = $this->_db->get($rule_value, array($item, '=', $value));
							if($check->count()) {
								$this->addError("It looks like your {$item_name} is already in use");
							}
						break;
					}
				}
			}
		}

		if(empty($this->_errors)) {
			$this->_passed = true;
		}

		return $this;
	}

	private function addError($error) {
		$this->_errors[] = $error;
	}

	public function errors() {
		return $this->_errors;
	}

	public function passed() {
		return $this->_passed;
	}

}