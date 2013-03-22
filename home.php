<?php
header('Content-Type: application/json');

//this script deals with the intent fired on the home screen of the android app


//TESTING:  http://54.235.158.91/home.php?action=browse
//output will be the list of gyms and gym id's


////////////////////////////////////////
///////// DB CONNECTION SETUP /////////
//////////////////////////////////


$link = mysql_connect("localhost", "root", "");// access AMAZON server

if(!$link)  die('Was unable to connect to Amazon Server!');
if(!mysql_select_db("climbuddy", $link)) die("Was unable to connect to database!");



////////////////////////////////////////
/////// SETUP COMPLETE ////////////////
////////////////////////////////////



//assume we are now connected to DB with access to tables
$action = $_REQUEST['action']; // set local string to action item

if($action == "capture") die("invalid request at this time!");
else if($action == "browse")
 {
	
	$output = array(); // JSON response array
	$result = mysql_query("SELECT gymID, name FROM Gyms") or die(mysql_error());

	//check for empty results
	if(mysql_num_rows($result) > 0)
	{
		//loop through results....
		$output["gyms"] = array();
		while($row = mysql_fetch_array($result))
		{
			$gym_info = array();
			$gym_info["gymID"] = $row["gymID"];
			$gym_info["name"] = $row["name"];
			
			//push single gym information into final output array
			array_push($output["gyms"], $gym_info);
		}//end while
		
		$output["success"] = 1; //success!
		echo json_encode($output); // echoing JSON response which will be the list of gyms
		
	}//end if

	else
	{ // no gyms found
		$output["success"] = 0; // NO SUCCESS!
		echo json_encode($output); //we still want to echo something so Android can react appropriately if no gyms exist!
	}
 }


?> 
