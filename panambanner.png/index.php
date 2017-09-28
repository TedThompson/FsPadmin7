<?php
// Get DB Details from FsP settings file
define("FSP", 1);
require("../FsPadmin/setting.php");
require("fspsigconfig.php");
$filterstring="1";

// Check Connectivity
$dbserver=$cfg['mysql_server'];
$dbuser=$cfg['user'];
$dbpassword=$cfg['passwordbase'];
$dbdatabase=$cfg['database'];
$db = mysqli_connect($dbserver, $dbuser, $dbpassword) or die("Unable to connect to database on '".$dbserver."' with the user '".$dbuser."'<br />"."Please check your settings in setting.php!");
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
mysqli_select_db($db,$dbdatabase) or die("Please create the database '".$dbdatabase."'!");

//Get Command Line Parameter
$pilot=$_GET["pilot"];
if (isset($pilot))
{
	$filterstring="PilotName='$pilot'";
}
$user=$_GET["user"];
if (isset($user))
{
	$filterstring="UserName='$user'";
}

//Set Initial Variables
$Spacing=$cfg["Spacing"];
$XOffset=$cfg["XOffset"];
$YOffset=$cfg["YOffset"];

//Get Number of Flights
$gettables = mysqli_query($db,"SELECT * FROM `flights` WHERE $filterstring");
$totalflights = mysqli_num_rows($gettables);

//Get Last Flight Info
$result=mysqli_query($db,"SELECT * FROM flights WHERE $filterstring ORDER BY id desc");
$row = mysqli_fetch_assoc($result);
$StartCity=substr($row["DepartureIcaoName"],0,4);
$EndCity=substr($row["ArrivalIcaoName"],0,4);
$LastFlightCompany=$row["CompanyName"];
$LastFlightPilot=$row["PilotName"];
$LastFlightDate=$row["FlightDate"];
$LastFlightAircraft=$row["AircraftName"];
$LastFlightPax=$row["NbrPassengers"];
$LastFlightDuration=$row["TotalBlockTime"];
$LastFlightDistance=$row["TotalDistance"];
$LastFlightAltitude=$row["MaxAltitude"];
$LastFlightLSpeed=$row["LandingSpeed"];
$LastFlightTDSpeed=$row["TouchDownVertSpeedFt"];
$LastFlightResult=$row["FlightResult"];
$LastFlightPaxOpinion=$row["PassengersOpinion"];
$LastFlightNumber=$row["FlightId"];
$PilotId = PA626;

if ($cfg["DebugMode"]!=0)
{
	echo "Pilot Name: ".$LastFlightPilot."<br />";
	echo "Number of Flights: ".$totalflights."<br />";
	echo "<br />";
	echo "LAST FLIGHT<br/>";
	echo "===========<br />";
	echo "Flight Number: ".$LastFlightNumber."<br />";
	echo "Flight Date: ".$LastFlightDate."<br />";
	echo "Leg : ".$StartCity." - ".$EndCity."<br />";
	echo "Flight Company: ".$LastFlightCompany."<br />";
	echo "Aircraft Flown: ".$LastFlightAircraft."<br />";
	echo "# of Pax Onboard: ".$LastFlightPax."<br />";
	echo "Duration: ".$LastFlightDuration."<br />";
	echo "Distance: ".$LastFlightDistance."<br />";
	echo "Max Altitude: ".$LastFlightAltitude."<br />";
	echo "Landing Speed: ".$LastFlightLSpeed."<br />";
	echo "Touchdown Speed: ".$LastFlightTDSpeed." ft/min<br />";
	echo "Flight Result: ".$LastFlightResult."<br />";
	echo "Pax Opinion: ".$LastFlightPaxOpinion."<br />";
}

//Get Averages and Totals
$result= mysqli_query($db,"SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(TotalBlockTime))) As AvgBlockTime, SEC_TO_TIME(SUM(TIME_TO_SEC(TotalBlockTime))) As SumBlockTime, ROUND(AVG(TotalDistance)) As AvgDistance, SUM(TotalDistance) As SumDistance, SUM(NbrPassengers) AS TotalPax, ROUND(AVG(TouchDownVertSpeedFt)) As AvgTDSpeed, MAX(TouchDownVertSpeedFt) As MaxTDSpeed, MIN(TouchDownVertSpeedFt) As MinTDSpeed FROM flights WHERE $filterstring");
$row = mysqli_fetch_assoc($result);
$TotalBlockTime=$row["SumBlockTime"];
$AvgBlockTime=$row["AvgBlockTime"];
$TotalDistance=$row["SumDistance"];
$AvgDistance=$row["AvgDistance"];
$TotalPax=$row["TotalPax"];
$AvgTDSpeed=$row["AvgTDSpeed"];
$MinTDSpeed=ROUND($row["MaxTDSpeed"],2);
$MaxTDSpeed=ROUND($row["MinTDSpeed"],2);
$array=preg_split( "/:/", $TotalBlockTime );
$hours=$array[0];

if ($cfg["DebugMode"]!=0)
{
	echo "<br />";
	echo "GENERAL STATS<br/>";
	echo "=============<br />";
	echo "Total Time Flown: ".$TotalBlockTime."<br/>";
	echo "Average Time per Flight: ".$AvgBlockTime."<br/>";
	echo "Total Distance Flown: ".$TotalDistance." nm<br/>";
	echo "Average Distance per Flight: ".$AvgDistance." nm<br/>";
	echo "Total Pax Transported: ".$TotalPax."<br/>";
	echo "Average Touchdown Speed: ".$AvgTDSpeed." ft/min<br/>";
	echo "Minimum Touchdown Speed: ".$MinTDSpeed." ft/min<br/>";
	echo "Maximum Touchdown Speed: ".$MaxTDSpeed." ft/min<br/>";
	echo "Hours: ".$hours."<br />";
}


//Display Sig
if ($cfg["DebugMode"]!=1)
{
	Header ("Content-type: image/png");
	$img_handle = imageCreateFromPNG($cfg["SigName"]);
	$colour = ImageColorAllocate ($img_handle, IntVal($cfg["RColour"]), IntVal($cfg["GColour"]), IntVal($cfg["BColour"]));
	$black = ImageColorAllocate ($img_handle, 0, 0, 0);
	$grey = ImageColorAllocate ($img_handle, 192, 192, 192);
	
//	ImageString ($img_handle, $cfg["Font"], $XOffset+1, $YOffset+1, "Pilot: $PilotId - $LastFlightPilot", $black);
//	ImageString ($img_handle, $cfg["Font"], $XOffset, $YOffset, "Pilot: $PilotId - $LastFlightPilot", $colour);
	ImageString ($img_handle, $cfg["Font"], $XOffset+1, $YOffset+1, "Pilot: PA626 - Ted Thompson", $black);
	ImageString ($img_handle, $cfg["Font"], $XOffset, $YOffset, "Pilot: PA626 - Ted Thompson", $colour);

	$YOffset+=$Spacing;
	ImageString ($img_handle, $cfg["Font"], $XOffset+1, $YOffset+1, "Flights: $totalflights  Hours: $hours", $black);
	ImageString ($img_handle, $cfg["Font"], $XOffset, $YOffset, "Flights: $totalflights  Hours: $hours", $colour);
	$YOffset+=$Spacing;
	ImageString ($img_handle, $cfg["Font"], $XOffset+1, $YOffset+1, "FTG Rank: Second Officer (ret)", $black);
	ImageString ($img_handle, $cfg["Font"], $XOffset, $YOffset, "FTG Rank: Second Officer (ret)", $colour);
	$YOffset+=$Spacing;
	ImageString ($img_handle, $cfg["Font"], $XOffset+1, $YOffset+1, "Last Flight: $StartCity-$EndCity", $black);
	ImageString ($img_handle, $cfg["Font"], $XOffset, $YOffset, "Last Flight: $StartCity-$EndCity", $colour);

	ImageString ($img_handle, 1, 255, 91, "*Sig created via custom script & FSPassengers", $grey);
	
	ImagePng ($img_handle);
	ImageDestroy ($img_handle);
} else
{
	echo "<br />";
	echo "PROGRAM INTERNALS<br/>";
	echo "=================<br />";
	echo "Red Component: ".$cfg["RColour"]."<br/>";
	echo "Greed Component: ".$cfg["GColour"]."<br/>";
	echo "Blue Component: ".$cfg["BColour"]."<br/>";
	echo "Colour: ".$colour."<br/>";
}
?>