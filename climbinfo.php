<?php
//this script retrieves the requested climb with all of its information
//specifically from the Climbs table
//TESTING:  http://54.235.158.91/climbinfo.php?climb_id=1
header('Content-Type: application/json');



////////////////////////////////////////
///////// DB CONNECTION SETUP /////////
//////////////////////////////////

$link = mysql_connect("localhost", "root", "");// access AMAZON server

if(!$link)  die('Was unable to connect to Amazon Server!');
if(!mysql_select_db("climbuddy", $link)) die("Was unable to connect to database!");

////////////////////////////////////////
/////// SETUP COMPLETE ////////////////
////////////////////////////////////

//$gym = $_REQUEST["climb"];
$cid = $_REQUEST["climb_id"];

//we want the android to call this script with the specified CLIMB and CLIMB_ID

$output = array(); // JSON response array
$result = mysql_query("SELECT * FROM Climbs WHERE climbID = '$cid'") or die(mysql_error());

if(mysql_num_rows($result) > 0)
{
		$output["climb"] = array();
		$row = mysql_fetch_array($result);
		$climb_info = array();
		$climb_info["difficulty"] = $row["difficulty"];
		$climb_info["tapeColor"] = $row["tapeColor"];
		$climb_info["pictureURL"] = $row["pictureURL"];
		$climb_info["name"] = $row["name"];	
		array_push($output["climb"], $climb_info);

		$commentResults = mysql_query("SELECT * FROM Comments WHERE climbID = '$cid'") or die(mysql_error());
		$output["comments"] = array();
		if(mysql_num_rows($commentResults) > 0) {
			$comment = array();
			while ($r = mysql_fetch_array($commentResults)) {
				$comment["commentID"] = $r["commentID"];
				$comment["comment"] = $r["comments"];
				$comment["user"] = $r["username"];
				array_push($output["comments"], $comment);
			}
		}
		
		$betaVids = mysql_query("SELECT * FROM BetaVideos WHERE climbID = '$cid'") or die(mysql_error());
		$output["betaVideos"] = array();
		if(mysql_num_rows($betaVids)>0) {
			$betaVideo = array();
			while ($r = mysql_fetch_array($betaVids)) {
				$betaVideo["betaID"] = $r["betaID"];
				$betaVideo["videoURL"] = $r["videoURL"];
				$betaVideo["username"] = $r["username"];
				$betaVideo["dateAdded"] = $r["dateAdded"];
				$betaVideo["rating"] = $r["rating"];	// probably should take rating out of this and make it separate from videos
				array_push($output["betaVideos"], $betaVideo);
			}
		}
		
		$challengeStrings = mysql_query("SELECT * FROM ChallengeStrings WHERE climbID = '$cid'") or die(mysql_error());
		$output["challengeStrings"] = array();
		$output["challengeVideos"] = array();
		if(mysql_num_rows($challengeStrings)>0) {
			$cString = array();
			$challengeVideos = array();
			while ($r = mysql_fetch_array($challengeStrings)) {
				$cString["challengeID"] = $r["challengeID"];
				$cString["challenge"] = $r["challenge"];
				$cString["username"] = $r["username"];
				array_push($output["challengeStrings"], $cString);
			
				$chaID = $r["challengeID"];
				$cVidResults = mysql_query("SELECT * FROM ChallengeVideos WHERE challengeID = '$chaID'") or die(mysql_error());
				$challengeVideos["'$chaID'"] = array();
				while ($res = mysql_fetch_array($cVidResults)) {
					$video = array();
					$video["challengeID"] = $res["challengeID"];
					$video["videoID"] = $res["videoID"];
					$video["videoURL"] = $res["videoURL"];
					$video["username"] = $res["username"];

					$title = $res["challengeID"];
					array_push($challengeVideos["'$title'"], $video);
					//array_push($output["challengeVideos"], $video);
				}

				
			}
			array_push($output["challengeVideos"], $challengeVideos);
		}
		
		$output["success"] = 1; //success!
		echo json_encode($output); // echoing JSON response which will be info of climb
		
}//end if

else
{ // no climbs found
	$output["success"] = 0; // NO SUCCESS!
	echo json_encode($output); //we still want to echo something so Android can react appropriately if no climbs exist!
}

?>
