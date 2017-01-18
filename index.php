<!DOCTYPE html>
<html>
  <head>
    <title>NBA Stats</title>
    <link rel="stylesheet" href="style.css">
  </head>

  <body>
    <!-- search form -->
    <form action="" method="post">
        Search Player:
        <input type="search" name="playerSearch" id="searchbar">
        <input type="submit" value="Search" id="search">
    </form>
    <?php
    require "classLib.php";

    // if user has searched continue
    if(isset($_POST["playerSearch"])) {
        // create instance of Database
        $db = new Database("ha344.c4zq7nel7nn5.us-west-2.rds.amazonaws.com", "3306", "NBA1516");
        // create instance of User
        $dbUser = new User("info344user", "<password>");
        try {
            //try to connect to database
        	$conn = new PDO("mysql:host=" . $db->getHost() . ";port=" . $db->getPort() . ";dbname=" . $db->getDBName(), $dbUser->getUsername(), $dbUser->getPassword());
            // prep query string
            $searchStr = getSearchStrings($_POST["playerSearch"]);
            // query the database
        	$stmt = $conn->prepare("SELECT * FROM Players WHERE (upper(Name) LIKE {$searchStr[0]} OR upper(Name) LIKE {$searchStr[1]})");
        	$stmt->execute();

        	$result = $stmt->fetchAll();

            // if 1 or more players matched the search, continue to display their stats
        	if(count($result)) {
                echo("<div><table><tr>");
                showDBHead($conn);
                echo("</tr>");
                showPlayerInfo($result);
            	} else {
            		echo "No rows returned.";
            	}
            } catch(PDOException $e) {
            	echo 'ERROR: ' . $e->getMessage();
            }
        } else {
            ?>
            <div id="beforeSearch">
                <p>NBA Player Stats Page!</p>
                <p>Search for your favorite players of the 2015-16 season.</p>
            </div>
            <?php
        }
        ?>
        </table>
    </div>
  </body>
</html>