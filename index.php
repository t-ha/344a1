<!DOCTYPE html>
<html>
  <head>
    <title>NBA Stats</title>
    <link rel="stylesheet" href="style.css">
  </head>

  <body>
    <form action="" method="post">
        Search Player: 
        <input type="search" name="playerSearch">
        <input type="submit" value="Search">
    </form>
    
    <?php
    require "classLib.php";

    if(isset($_POST["playerSearch"])) {
        $host = "ha344.c4zq7nel7nn5.us-west-2.rds.amazonaws.com";
        $port = "3306";
        $dbname = "NBA1516";

        $user = "info344user";
        $pass = "<password>";
        $dbUser = new User($user, $pass);


        $searchStr = strtoupper('\'%' . $_POST["playerSearch"] . '%\'');
        try {
        	$conn = new PDO("mysql:host={$host};port={$port};dbname={$dbname}", $dbUser->getUsername(), $dbUser->getPassword());
        	$stmt = $conn->prepare("SELECT * FROM Players WHERE upper(Name) LIKE {$searchStr}");
        	$stmt->execute();

        	$result = $stmt->fetchAll();
        	if(count($result)) {
        		$cols = $conn->prepare("DESCRIBE Players");
        		$cols->execute();
        		$colHeaders = $cols->fetchAll(PDO::FETCH_COLUMN);
    ?>
    <table style="width:100%">
    <tr>
    <?php
                for($i = 0; $i < count($colHeaders); $i++) {
                        echo("<th>" . $colHeaders[$i] . "</th>");
                    }
    ?>
    </tr>
    <?php
        		foreach($result as $row) {
                    echo "<tr>";
                    for($i = 0; $i < count($row) / 2; $i++) {
                        echo("<td><br/>");
                        if ($i == 0) {
                            $pName = explode(" ", $row[$i]);
                            $headURL = '"https://nba-players.herokuapp.com/players/' . $pName[1] . '/' . $pName[0] . '"';
                            echo('<img src=');
                            echo($headURL);
                            echo('alt="');
                            echo($row[$i]);
                            echo('" width="175" height="127">');
                        }
                        echo("<br/>" . $row[$i]);
                        echo("<br/></td>");
                    }
                    echo "</tr>";
        		}
        	} else {
        		echo "No rows returned.";
        	}
        } catch(PDOException $e) {
        	echo 'ERROR: ' . $e->getMessage();
        }
    }
    ?>
    </table>
  </body>
</html>