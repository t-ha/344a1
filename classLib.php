<?php
class User {
	private $username;
	private $password;

	function __construct($user, $pass) {
		$this->username = $user;
		$this->password = $pass;
	}

	public function getUsername() {
		return $this->username;
	}
	
	function getPassword() {
		return $this->password;
	}
}
?>