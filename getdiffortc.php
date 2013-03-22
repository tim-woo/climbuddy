<?php
header('Content-Type: application/json');

//this script returns a list of difficulties OR tapeColors for the requested gym
//SAMPLE TEST:  http://54.235.158.91/getdiffortc.php?action=tapeColor&gymID=1
//SAMPLE TEST2: http://54.235.158.91/getdiffortc.php?action=difficulty&gymID=1


////////////////////////////////////////
///////// DB CONNECTION SETUP /////////
//////////////////////////////////


$link = mysql_connect("localhost", "root", "");// access AMAZON server

if(!$link)  die('Was unable to connect to Amazon Server!');

if(!mysql_select_db("climbuddy", $link)) die("Was unable to connect to database!");


////////////////////////////////////////
/////// SETUP COMPLETE ////////////////
////////////////////////////////////


$action = $_REQUEST['action'];//will be either "difficulty" OR "tapeColor"
$gymID = $_REQUEST['gymID']; //needed for query to be specific to a gym


if($action == "difficulty")
{

	$output = array(); // JSON response array
	$result = mysql_query("SELECT difficulty FROM Climbs WHERE gymID = '$gymID' GROUP BY difficulty ORDER BY difficulty") or die(mysql_error());

	if(mysql_num_rows($result) > 0)
	{
			//loop through results....
			$output["difficulties"] = array();
			while($row = mysql_fetch_array($result))
			{
				$climb_info = array();
				$climb_info["difficulty"] = $row["difficulty"];
			
				//push single climbs information into final output array
				array_push($output["difficulties"], $climb_info);
			}//end while
		
			$output["success"] = 1; //success!
			echo json_encode($output); // echoing JSON response which will be the list of climbs
		
	}//end if

	else
	{ // no climbs found
		$output["success"] = 0; // NO SUCCESS!
		echo json_encode($output); //we still want to echo something so Android can react appropriately if no climbs exist!
	}

}//end if

else if($action = "tapeColor")
{

	$output = array(); // JSON response array
	$result = mysql_query("SELECT tapeColor FROM Climbs WHERE gymID = '$gymID' GROUP BY tapeColor") or die(mysql_error());

	if(mysql_num_rows($result) > 0)
	{
			//loop through results....
			$output["tapeColors"] = array();
			while($row = mysql_fetch_array($result))
			{
				$climb_info = array();
				$climb_info["tapeColor"] = $row["tapeColor"];
			
				//push single climbs information into final output array
				array_push($output["tapeColors"], $climb_info);
			}//end while
		
			$output["success"] = 1; //success!
			echo json_encode($output); // echoing JSON response which will be the list of climbs
		
	}//end if

	else
	{ // no climbs found
		$output["success"] = 0; // NO SUCCESS!
		echo json_encode($output); //we still want to echo something so Android can react appropriately if no climbs exist!
	}


}//end else if

mysql_close($link);







?>
