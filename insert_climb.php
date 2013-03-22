<?php
//testing URL:  http://54.235.158.91/insert_climb.php?gymID=1&name=tinytim&difficulty=1&tapeColor=yellow&pictureURL=timsgay


////////////////////////////////////////
///////// DB CONNECTION SETUP /////////
//////////////////////////////////


$link = mysql_connect("localhost", "root", "");// access AMAZON server

if(!$link)  die('Was unable to connect to Amazon Server!');

if(mysql_select_db("climbuddy", $link)) echo "Connected to database <br /><br />";
else die("Was unable to connect to database!");


////////////////////////////////////////
/////// SETUP COMPLETE ////////////////
////////////////////////////////////

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
