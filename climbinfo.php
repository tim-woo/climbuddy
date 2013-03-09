<?php
//this script retrieves the requested climb with all of its information
//specifically from the Climbs table
//TESTING:  http://54.235.158.91/climbinfo.php?climb_id=1



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


//$gym = $_REQUEST["climb"];
$cid = $_REQUEST["climb_id"];

//we want the android to call this script with the specified CLIMB and CLIMB_ID

$output = array(); // JSON response array
$result = mysql_query("SELECT * FROM Climbs WHERE climbID = '$cid'") or die(mysql_error());

if(mysql_num_rows($result) > 0)
{
		//loop through results....
		$output["climb"] = array();
		while($row = mysql_fetch_array($result))
		{
			$climb_info = array();
			$climb_info["difficulty"] = $row["difficulty"];
			$climb_info["tapeColor"] = $row["tapeColor"];
			$climb_info["pictureURL"] = $row["pictureURL"];
			$climb_info["name"] = $row["name"];
			
			//push single climbs information into final output array
			array_push($output["climb"], $climb_info);
		}//end while
		
		$output["success"] = 1; //success!
		echo json_encode($output); // echoing JSON response which will be info of climb
		
}//end if

else
{ // no climbs found
	$output["success"] = 0; // NO SUCCESS!
	echo json_encode($output); //we still want to echo something so Android can react appropriately if no climbs exist!
}

?>
