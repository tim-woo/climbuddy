<?php
//testing URL:  http://54.235.158.91/insert_climb.php?gymID=1&name=tinytim&difficulty=1&tapeColor=yellow&pictureURL=timsgay
header('Content-Type: application/json');

mysql_connect("localhost", "root", "") or die("Error: Unable to connect to database");
mysql_select_db("climbuddy") or die("Error: Unable to choose correct database");

$gymID = $_REQUEST["gymID"];//hardcoded
$name = $_REQUEST["name"];
$difficulty = $_REQUEST["difficulty"];
$tapeColor = $_REQUEST["tapeColor"];
$pictureURL = $_REQUEST["pictureURL"];
$nothing = NULL;


//INSERT QUERY

if( mysql_query("INSERT INTO Climbs VALUES ('$nothing', '$gymID', '$name', '$difficulty', '$tapeColor', '$pictureURL')") )
	echo "YES";
else
	echo "NO";


mysql_close($link);





?>
