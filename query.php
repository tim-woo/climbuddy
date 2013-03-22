<?php

header('Content-Type: application/json');

if (!($db_connection = mysql_connect("localhost","root","")))
		die('Could not connect: ' . mysql_error());
if (!($db_selected = mysql_select_db("climbuddy", $db_connection))) 
		die ('Can\'t use CS143: ' . mysql_error());

$param = $_GET["thequery"];
if($_GET["thequery"]) {
	echo "<h3>$param</h3>";
}

$rs = mysql_query($param, $db_connection);

while($row = mysql_fetch_row($rs)){
	echo "<p>$row[0] | $row[1] | $row[3]</p>";
}
mysql_close($db_connection);

?>
