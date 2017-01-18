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

function printDBHead($conn) {
	$cols = $conn->prepare("DESCRIBE Players");
    $cols->execute();
   	$colHeaders = $cols->fetchAll(PDO::FETCH_COLUMN);
   	for($i = 0; $i < count($colHeaders); $i++) {
        echo("<th>" . $colHeaders[$i] . "</th>");
    }
}

// function playerInfo($results) {
// 	foreach($result as $row) {
//                     echo "<tr>";
//                     for($i = 0; $i < count($row) / 2; $i++) {
//                         echo("<td><br/>");
//                         if ($i == 0) {
//                             $pName = explode(" ", $row[$i]);
//                             $headURL = '"https://nba-players.herokuapp.com/players/' . $pName[1] . '/' . $pName[0] . '"';
//                             echo('<img src=');
//                             echo($headURL);
//                             echo('alt="');
//                             echo($row[$i]);
//                             echo('" width="175" height="127">');
//                         }
//                         echo("<br/>" . $row[$i]);
//                         echo("<br/></td>");
//                     }
//                     echo "</tr>";
//         		}
// }
?>