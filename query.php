<?php

header('Content-Type: application/json');

mysql_connect("localhost", "root", "") or die("Error: Unable to connect to database");
mysql_select_db("climbuddy") or die("Error: Unable to choose correct database");

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
