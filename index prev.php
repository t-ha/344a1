<!DOCTYPE html>
<html>
  <head>
    <title>NBA Stats</title>
  </head>

  <body>
    <?php
    echo "these are stats<br/>";
    $host = "ha344.c4zq7nel7nn5.us-west-2.rds.amazonaws.com";
    $port = "3306";
    $dbname = "NBA1516";
    $user = "info344user";
    $pass = "<password>";
    $name = '\'Stephen Curry\'';
    try {
    	$conn = new PDO("mysql:host={$host};port={$port};dbname={$dbname}", $user, $pass);
    	$stmt = $conn->prepare("SELECT * FROM Players WHERE Name = {$name}");
    	$stmt->execute();

    	$result = $stmt->fetchAll();
    	if(count($result)) {
    		foreach($result as $row) {
    			// print_r(implode("|", $row) . "<br/>");
    			echo json_encode($row);
    		}
    	} else {
    		echo "No rows returned.";
    	}
    } catch(PDOException $e) {
    	echo 'ERROR: ' . $e->getMessage();
    }
    ?>
    
  </body>

</html>
