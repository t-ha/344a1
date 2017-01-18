<?php

// User class
class User {
	private $username;
	private $password;

	function __construct($user, $pass) {
		$this->username = $user;
		$this->password = $pass;
	}
	// returns the username
	function getUsername() {
		return $this->username;
	}
	// returns the password
	function getPassword() {
		return $this->password;
	}
}

// Database class
class Database {
	private $host; // host
	private $port; // port number 
	private $dbName; // database name

	function __construct($host, $port, $dbName) {
		$this->host = $host;
		$this->port = $port;
		$this->dbName = $dbName;
	}
	//returns the host
	function getHost() {
		return $this->host;
	}
	//returns the port number
	function getPort() {
		return $this->port;
	}
	//returns the database name
	function getDBName() {
		return $this->dbName;
	}
}

// reverses the order of a empty space separated string
function reverseString($string) {
	$parts = explode(" ", $string);
	$reverse = "";
	for($i = count($parts) - 1; $i >= 0; $i--) {
		if ($i < (count($parts) - 1)) {
			$reverse = $reverse . ' ';
		}
		$reverse = $reverse . $parts[$i];
	}
	return $reverse;
}

// returns an array that is prepped for SQL query comparison
function getSearchStrings($string) {
	$str1 = strtoupper('\'%' . $_POST["playerSearch"] . '%\'');
	$str2 = strtoupper('\'%' . reverseString($_POST["playerSearch"]) . '%\'');
	return array($str1, $str2);
}

// displays table row headers 
function showDBHead($conn) {
	$cols = $conn->prepare("DESCRIBE Players");
    $cols->execute();
   	$colHeaders = $cols->fetchAll(PDO::FETCH_COLUMN);
   	for($i = 0; $i < count($colHeaders); $i++) {
        echo('<th id="tblHead">' . $colHeaders[$i] . "</th>");
    }
}

// displays table row stats for players
function showPlayerInfo($result) {
	foreach($result as $row) {
                    echo "<tr>";
                    for($i = 0; $i < count($row) / 2; $i++) {
                        echo("<td>");
                        if ($i == 0) {
                            getPlayerHeadshots($row, $i);
                        }
                        echo($row[$i]);
                        echo("</td>");
                    }
                    echo("</tr>");
        		}
}

// displays NBA player headshots
function getPlayerHeadshots($row, $index) {
	$pName = explode(" ", $row[$index]);
    $headURL = '"https://nba-players.herokuapp.com/players/' . $pName[1] . '/' . $pName[0] . '"';
    echo('<img src=');
    echo($headURL);
    echo(' width="175" height="127">');
    echo("<br/>");
}
?>