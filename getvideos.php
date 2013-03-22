<?php
//this script returns the list of videos for a specified climbID
//SAMPLE TEST: http://54.235.158.91/getvideos.php?climbID=1


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


$cid = $_REQUEST["climbID"];

//we want the android to call this script with the specified climbID

$output = array(); // JSON response array
$result = mysql_query("SELECT videoURL, username, dateAdded, rating FROM BetaVideos WHERE climbID = '$cid'") or die(mysql_error());

if(mysql_num_rows($result) > 0)
{
		//loop through results....
		$output["videos"] = array();
		while($row = mysql_fetch_array($result))
		{
			$video_info = array();
			$video_info["videoURL"] = $row["videoURL"];
			$video_info["username"] = $row["username"];
			$video_info["dateAdded"] = $row["dateAdded"];
			$video_info["rating"] = $row["rating"];
			
			//push single video information into final output array
			array_push($output["videos"], $video_info);
		}//end while
		
		$output["success"] = 1; //success!
		echo json_encode($output); // echoing JSON response which will be the list of videos
		
}//end if

else
{ // no climbs found
	$output["success"] = 0; // NO SUCCESS!
	echo json_encode($output); //we still want to echo something so Android can react appropriately if no videos exist!
}


mysql_close($link);
?>


