<?php
header('Content-Type: application/json');

//upload actual video to server INTO ./videos directory
$target_path  = "./videos/";
$target_path = $target_path . basename( $_FILES['uploadedfile']['name']);
echo "Target path " . $target_path . "<br/>";
echo "_Files " . $_FILES['uploadedfile']['error'];
if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
 echo "The file ".  basename( $_FILES['uploadedfile']['name']).
 " has been uploaded";
} else{
 echo "false";
}

//upload of video complete


//update video tables in DB




////////////////////////////////////////
///////// DB CONNECTION SETUP /////////
//////////////////////////////////



$link = mysql_connect("localhost", "root", "");// access AMAZON server

if(!$link)  die('Was unable to connect to Amazon Server!');

if(!mysql_select_db("climbuddy", $link)) die("Was unable to connect to database!");


////////////////////////////////////////
/////// SETUP COMPLETE ////////////////
////////////////////////////////////

$username = $_REQUEST['username'];//"anvay"; //hardcoded
$climbID = $_REQUEST['climbID'];//1;//hardcoded
$rating = $_REQUEST['rating'];//1;//hardcoded

echo "'$username'    '$climbID'       '$rating'";

$dateAdded = time();



$videoURL = basename( $_FILES['uploadedfile']['name']);//$_REQUEST["filename"];//POTENTIAL PROBLEM AREA
echo "'$videoURL' <br /><br />";

//INSERT QUERY

mysql_query("INSERT INTO BetaVideos (climbID, videoURL, username, dateAdded, rating)
VALUES ('$climbID', '$videoURL', '$username', NOW(), '$rating')");


mysql_close($link);
?>


