<?php
//this script retrieves the climbs from the requested Gym
//TESTING:  http://54.235.158.91/getclimbs.php?gym_id=1



////////////////////////////////////////
///////// DB CONNECTION SETUP /////////
//////////////////////////////////


header('Content-Type: application/json');

$link = mysql_connect("localhost", "root", "");// access AMAZON server

if(!$link)  die('Was unable to connect to Amazon Server!');


if(!mysql_select_db("climbuddy", $link)) die("Was unable to connect to database!");


////////////////////////////////////////
/////// SETUP COMPLETE ////////////////
////////////////////////////////////


//$gym = $_REQUEST["gym"];
$gid = $_REQUEST["gym_id"];

//we want the android to call this script with the specified CLIMB and CLIMB_ID

$output = array(); // JSON response array
$result = mysql_query("SELECT climbID, name FROM Climbs WHERE gymID = '$gid'") or die(mysql_error());

if(mysql_num_rows($result) > 0)
{
		//loop through results....
		$output["climbs"] = array();
		while($row = mysql_fetch_array($result))
		{
			$climb_info = array();
			$climb_info["climbID"] = $row["climbID"];
			$climb_info["name"] = $row["name"];
			
			//push single climbs information into final output array
			array_push($output["climbs"], $climb_info);
		}//end while
		
		$output["success"] = 1; //success!
		echo json_encode($output); // echoing JSON response which will be the list of climbs
		
}//end if

else
{ // no climbs found
	$output["success"] = 0; // NO SUCCESS!
	echo json_encode($output); //we still want to echo something so Android can react appropriately if no climbs exist!
}

?>
