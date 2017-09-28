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

$CompanyFlightTime="00:00:00";
$TotalPassengers=0;
$TotalCargo=0;

	if($query = "SELECT * FROM flights WHERE 1 ORDER BY id desc")
	$result=@mysql_query($query);
	if(!$result){echo "SQL Error - ".mysql_error();return;}
	$NrfFlights=mysql_num_rows($result);
	if($NrfFlights==0){echo "No flights to display";return;}
	$row=mysql_fetch_assoc($result);

	echo "

<html>
	<head>
		<title>Redirect</title>
	<META http-equiv=\"refresh\" content=\"5;URL=http://www.federalproductions.com/FsP/FsPlistflight.php?action=va&amp;listflight=$row[id]\">
	</head>
	<body>
		<center>
			<img style=\"border:none;\" src=\"loading.gif\" alt=\"Loading Animation\"><br />
			<a href=\"http://www.federalproductions.com/FsP/FsPlistflight.php?action=va&amp;listflight=$row[id]\"
				<small>Click If Page Does Not Load...</small>
			</a>
		</center>
	</body>
</html>";