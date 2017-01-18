<?php
class User {
	private $username;
	private $password;

	function __construct($user, $pass) {
		$this->username = $user;
		$this->password = $pass;
	}

	function getUsername() {
		return $this->username;
	}
	
	function getPassword() {
		return $this->password;
	}
}

class Database {
	private $host;
	private $port;
	private $dbName;

	function __construct($host, $port, $dbName) {
		$this->host = $host;
		$this->port = $port;
		$this->dbName = $dbName;
	}

	function getHost() {
		return $this->host;
	}
	
	function getPort() {
		return $this->port;
	}

	function getDBName() {
		return $this->dbName;
	}
}
?>