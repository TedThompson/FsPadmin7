<?php
///////////////////////NEEDED STUFF USUALLY YOU WILL NOT NEED TO CHANGE THIS///////////////////////////////////
define("FSP", 1);
# setting.php contain MySQL database setting and other setting it contain also the FSP UNIT SETTING
require("FsPadmin/setting.php");			
# common.php do the connexion to MySQL the value $databaseconnexion is set to true if the connexion is okay
require("FsPadmin/common.php");			
// the value "$databaseconnexion" is set to true in common.php if the connexion is ok
if($databaseconnexion==FALSE){echo "Error - unable to connect to mySQL database;";return;}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////

// get global for server that have register global OFF
$listflight=$_GET['listflight'];

$backlink=$_SERVER['HTTP_REFERER'];

///////////////////// EDIT THE TABLE DESIGN HERE //////////////////////////////////////////////////////////////
$ListStart	="<table style=\"width: 280px;\">\n";
$TDTitStyle	='<td align="center" nowrap style="background-color: #5F7EEB; color: #FFFFFF; font-size: 9pt;  padding: 2px 7px 2px 7px;">';
$TableTitle	='<tr>'.$TDTitStyle.'Id</td>'.$TDTitStyle.'Date</td>'.$TDTitStyle.'Airline</td>'.$TDTitStyle.'Pilot</td>'.$TDTitStyle.'From</td>'.$TDTitStyle.'To</td>'.$TDTitStyle.'Pass</td>'.$TDTitStyle.'AC</td>'.$TDTitStyle.'Time</td>'.$TDTitStyle.'Result</td>';
$TDListOdd	='<td class="pirepcell" align="center" nowrap style="background-color: #D5E4FD; font-size: 9pt;  padding: 2px 7px 2px 7px;">';
$TDListEven	='<td class="pirepcell" align="center" nowrap style="background-color: #7CADDE; font-size: 9pt;  padding: 2px 7px 2px 7px;">';
$TRList		='<tr>';
$ListStop	='</table>';
///////////////////////////////////////////////////////////////////////////////////////////////////////////////

///////////////////// THIS IS THE LIST TABLE OUTPUT ///////////////////////////////////////////////////////////
if(!isset($listflight))
{
// THE TITLE
echo '<!DOCTYPE html>
<html>
	<head>
		<meta content="text/html;charset=ISO-8859-1" http-equiv="Content-Type">
	  	<link rel="stylesheet" href="list.css" type="text/css">
		<title>VA Flight List</title>
	</head>
	<body>
		<table style="auto;padding:2px;margin:2px;"><tr><td><h2>FsPassengers VA Flight List</h2></td></tr></table><br><br>';


$CompanyFlightTime="00:00:00";
$TotalPassengers=0;
$TotalCargo=0;
	
echo $ListStart.$TableTitle;
	if($query = "SELECT * FROM flights WHERE 1 ORDER BY id desc")
    $result=@mysqli_query($db,$query);if(!$result){echo "SQL Error - ".mysqli_error();return;}
	$NrfFlights=mysqli_num_rows($result);
	if($NrfFlights==0){echo "No flights to display";return;}
	$Line=0;
	while ($row = mysqli_fetch_assoc($result)) 
	{
		echo $TRList;
		if($Line==0)echo $TDListOdd;else echo $TDListEven;
		echo "<a href=\"/FsP/FsPlistflight.php?action=va&listflight=$row[id]\" target=\"_blank\">".$row["FlightId"]."</a>";
		if($Line==0)echo $TDListOdd;else echo $TDListEven;
	    echo $row["FlightDate"];
		if($Line==0)echo $TDListOdd;else echo $TDListEven;
	    echo $row["CompanyName"];
		if($Line==0)echo $TDListOdd;else echo $TDListEven;
	    echo $row["PilotName"];
		if($Line==0)echo $TDListOdd;else echo $TDListEven;
	    echo substr($row["DepartureIcaoName"],0,4);
		if($Line==0)echo $TDListOdd;else echo $TDListEven;
	    echo substr($row["ArrivalIcaoName"],0,4);
		if($Line==0)echo $TDListOdd;else echo $TDListEven;
    	    echo $row["NbrPassengers"];
		$TotalPassengers+=$row["NbrPassengers"];
		if($Line==0)echo $TDListOdd;else echo $TDListEven;
    	    echo $row["AircraftType"];
		if($Line==0)echo $TDListOdd;else echo $TDListEven;
	    echo $row["TotalBlockTime"];
		$CompanyFlightTime=AddTime($row["TotalBlockTime"],$CompanyFlightTime);
		if($Line==0)echo $TDListOdd;else echo $TDListEven;
	    echo $row["FlightResult"];
		echo "</td></tr>\n";
		$Line=!$Line;
		settype($row["CargoWeight"],"integer");
		$TotalCargo+=$row["CargoWeight"];
	}
echo $ListStop;

echo "<br><br>".$ListStart."<tr>".$TDListOdd."Total Flight made: $NrfFlights<br>total flight time: $CompanyFlightTime<br>Total passengers carried: $TotalPassengers<br>Total Cargo: $TotalCargo kg</td></tr>".$ListStop;
echo '</body></html>';
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////

if(!isset($listflight))return;
///////////////////// THIS IS THE LIST TABLE OUTPUT ///////////////////////////////////////////////////////////

	if($query = "SELECT * FROM flights WHERE id=$listflight ORDER BY id desc LIMIT 0,30")
    $result=@mysqli_query($db,$query);if(!$result){echo "SQL Error - ".mysqli_error();return;}

	$NrfFlights=mysqli_num_rows($result);

	if($NrfFlights==0){echo "No flights to display";return;}

	$Line=0;
	$row = mysqli_fetch_assoc($result);

	$darray = explode(" ",$row["DepartureIcaoName"],2);
	$aarray = explode(" ",$row["ArrivalIcaoName"],2);

	$dicao = $darray[0];
	$aicao = $aarray[0];
	$dname = $darray[1];
	$aname = $aarray[1];	

	$usedFuelWeight = ((int)$row["StartFuelQuantity"] - (int)$row["EndFuelQuantity"]);
	$usedFuelWeight = (int)$usedFuelWeight;

	echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<meta content="text/html;charset=ISO-8859-1" http-equiv="Content-Type">
	  	<link rel="stylesheet" href="pirep.css" type="text/css">
		<title>Flight Details - Flight Id: '.$row["FlightId"].'</title>
	</head>
	<body>
		<div style="margin: 0 auto;">
			<h3>Flight Details - Flight Id: '.$row["FlightId"].'</h3>
		</div>
		<table class="pireptable" cellspacing="0">
			<tr><td colspan="2" class="pirepheader"><strong>Company Call Sign&nbsp;</strong>'.$row["CompanyName"].'<br><strong>Flight Id&nbsp;</strong>'.$row["FlightId"].'<br><strong>Flight Date</strong>&nbsp;'.$row["FlightDate"].'</td></tr>
			<tr><td class="pirepcell">Aircraft</td><td class="pirepdata">'.$row["AircraftName"].'</td></tr>
			<tr><td class="pirepcell">Origin</td><td class="pirepdata"><a href="http://gc.kls2.com/airport/'.$dicao.'">'.$dicao.'</a> '.$dname.'</td></tr>
			<tr><td class="pirepcell">Destination</td><td class="pirepdata"><a href="http://gc.kls2.com/airport/'.$aicao.'">'.$aicao.'</a> '.$aname.'</td></tr>
			<tr><td class="pirepcell">Departure</td><td class="pirepdata">'.$row["DepartureLocalHour"]." (".$row["DepartureGmtHour"].' ZULU)</td></tr>
			<tr><td class="pirepcell">Arrival</td><td class="pirepdata">'.$row["ArrivalLocalHour"]." (".$row["ArrivalGmtHour"].' ZULU)<br></td></tr>
			<tr><td class="pirepcell">Passengers</td><td class="pirepdata">'.$row["NbrPassengers"].'</td></tr>
			<tr><td class="pirepcell">Take-Off Weight</td><td class="pirepdata">'.$row["StartAircraftWeight"].'</td></tr>
			<tr><td class="pirepcell">Landing Weight</td><td class="pirepdata">'.$row["EndAircraftWeight"].'</td></tr>
			<tr><td class="pirepcell">Take-Off fuel</td><td class="pirepdata">'.(int)($row["StartFuelQuantity"]).' lbs</td></tr>
			<tr><td class="pirepcell">Landing Fuel</td><td class="pirepdata">'.(int)($row["EndFuelQuantity"]).' lbs</td></tr>
			<tr><td class="pirepcell">Total Fuel Used</td><td class="pirepdata">'.$usedFuelWeight.' lbs</td></tr>
			<tr><td class="pirepcell">Block Time</td><td class="pirepdata">'.$row["TotalBlockTime"].'</td></tr>
			<tr><td class="pirepcell">Airborn Time</td><td class="pirepdata">'.$row["TotalAirbornTime"].'</td></tr>
			<tr><td class="pirepcell">Time On Ground</td><td class="pirepdata">'.$row["TotalTimeOnGround"].'</td></tr>
			<tr><td class="pirepcell">Altitude</td><td class="pirepdata">'.$row["MaxAltitude"].'</td></tr>
			<tr><td class="pirepcell">Speed</td><td class="pirepdata">'.$row["CruiseSpeed"].'s</td></tr>
			<tr><td class="pirepcell">Mach Speed</td><td class="pirepdata">'.$row["CruiseMachSpeed"].'</td></tr>
			<tr><td class="pirepcell">Landing Speed</td><td class="pirepdata">'.$row["LandingSpeed"].'s</td></tr>
			<tr><td class="pirepcell">Landing Pitch</td><td class="pirepdata">'.$row["LandingPitch"].'&deg;</td></tr>
			<tr><td class="pirepcell">Touch Down V/S</td><td class="pirepdata">'.$row["TouchDownVertSpeedFt"].' fpm</td></tr>
			<tr><td class="pirepcell">Passengers Rating</td><td class="pirepdata">'.$row["PassengersOpinion"].'%</td></tr>
		</table>
		
		<a href="http://www.gcmap.com/mapui?P='.$dicao.'-'.$aicao.'&amp;MS=bm"><img class="map" src="http://www.gcmap.com/map?P='.$dicao.'-'.$aicao.'&amp;MS=bm" alt="Great Circle Route Map"></a>
		<div class="pirepdata" style="border: none !important;">
			Maps generated by the <a href="http://www.gcmap.com">Great Circle Mapper</a>&nbsp;<br>-copyright &#169; <a href="http://www.kls2.com/~karl/">Karl L. Swartz</a>.
		</div>
  <p>
    <a href="http://validator.w3.org/check?uri=referer"><img
        src="http://www.w3.org/Icons/valid-html401-blue"
        alt="Valid HTML 4.01 Transitional" height="31" width="88"></a>
  </p>

		<br style="clear: both;"><br><p style="text-align: right;"><a href="http://www.federalproductions.com">home</a> | <a href="'. $backlink .'">Return to Previous Page</a></p>
	</body>
</html>';
		
/*******************************************************************************************************************/
//                                                                                                                   
// Those below are fonction to help you to deal with the value returned by FsP, as they contain already the unit     
// (ie: 1400 ft instead of 1400) you might not be able to do mathematical operation with them so those function      
// below will help you.                                                                                              
/*******************************************************************************************************************/

// this add two hours of FsP and return them in hour format also
// ( 12:30:45+02:05:06=14:35:51 for example)
function AddTime($Time1,$Time2)
{
	$timea=explode(":",$Time1);
	$timeb=explode(":",$Time2);
	$secondes=($timea[0]+$timeb[0])*3600;
	$secondes+=($timea[1]+$timeb[1])*60;
	$secondes+=$timea[2]+$timeb[2];
    $hours = floor($secondes / 3600);
    $minute = floor(($secondes - ($hours * 3600)) / 60);
    $secconde = $secondes - ($hours * 3600) - ($minute * 60);
  return sprintf("%02d:%02d:%02d", $hours, $minute, $secconde);
}
?>
