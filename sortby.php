<?php
header('Content-Type: application/json');

//this script's purpose is to take as input an action item by which to sort the climbs by
//REQUIRES AS INPUT: action = difficulty OR tapeColor .....  gymID = 1,2,etc.. .......  tapeColor = yellow OR red OR etc...difficulty = 1 or 2...

//SAMPLE TEST:   http://54.235.158.91/sortby.php?action=difficulty&gymID=1&tapeColor=yellow&difficulty=1
//SAMPLE TEST2:  http://54.235.158.91/sortby.php?action=tapeColor&gymID=1&tapeColor=yellow&difficulty=1


////////////////////////////////////////
///////// DB CONNECTION SETUP /////////
//////////////////////////////////


$link = mysql_connect("localhost", "root", "");// access AMAZON server

if(!$link)  die('Was unable to connect to Amazon Server!');

if(!mysql_select_db("climbuddy", $link)) die("Was unable to connect to database!");


////////////////////////////////////////
/////// SETUP COMPLETE ////////////////
////////////////////////////////////



$action = $_REQUEST['action']; //get action item
$gymID = $_REQUEST['gymID']; //get the gym that we are looking at
$tapeColor = $_REQUEST['tapeColor'];
$difficulty = $_REQUEST['difficulty'];

//next steps are dependent on what kind of action the user requires
if($action == "difficulty")
{
	$output = array(); // JSON response array
	$result = mysql_query("SELECT climbID, name FROM Climbs WHERE gymID = '$gymID' and difficulty = '$difficulty'") or die(mysql_error());

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

}//end if
else if($action == "tapeColor")
{
	$output = array(); // JSON response array
	$result = mysql_query("SELECT climbID, name FROM Climbs WHERE tapeColor = '$tapeColor' AND gymID = '$gymID'") or die(mysql_error());

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

}//end elseif


//end connection
mysql_close($link);



?>  
