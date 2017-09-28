<?php
define("FSP", 1);
# setting.php contain MySQL database setting and other setting it contain also the FSP UNIT SETTING
require("FsPadmin/setting.php");			
# common.php do the connexion to MySQL the value $databaseconnexion is set to true if the connexion is okay
require("FsPadmin/common.php");			



//////////////////////////////////////////////////////////////////
// FsP Asked connexion                                            
// -------------------                                            
// When the user call the menu FsP check the connexion            
// it's time to check username, password and give unit setup      
//////////////////////////////////////////////////////////////////
if($_POST['FsPAskConnexion']=="yes")
{
	// the value "$databaseconnexion" is set to true in common.php if the SQL connexion is ok
	if($databaseconnexion==FALSE)
	{
		echo "#Answer# Error - unable to connect to mySQL database;";
		return;
	}

	// check username and password 
	if($query = "SELECT * FROM user_profile WHERE UserName='$_POST[UserName]' and Password='$_POST[Password]'")
    $result=@mysql_query($query);if(!$result){echo "#Answer# SQL Error - ".mysql_error();return;}
	if(mysql_num_rows($result)==0)
	{
		echo "#Answer# Error - Username don't exist or wrong password;";
		return;
	}
	
	//If we are here, username, password and connexion to SQL database is ok so we reply it's ok and we give the units we want
	//that FsP send to us, those unit are defined in the setting.php, you can modify them while going to ADMIN part.
	// this will also send the welcome message to the user's FSP export dialog.
	echo "#Answer# Ok - connected;";
	echo "Weight=$cfg[WeightUnit] Dist=$cfg[DistanceUnit] Speed=$cfg[SpeedUnit] Alt=$cfg[AltUnit] Liqu=$cfg[LiquidUnit]";
	printf("#welcome#%s#endwelcome#",$cfg['welcome_message']);
	WriteDebug();
	exit();
}



//////////////////////////////////////////////////////////////////
// FsP requested to register one flight                           
// ------------------------------------                           
// you MUST reply with an #answer# as listed at end of function   
// You can add more error code but it must start with "#answer#"  
// and end with a ";" this error code will be showed to the user. 
// DON'T CHANGE the "#Answer# Ok - Saved;" and "#Answer#exist#"   
// because FsP absolutely need them.                              
//////////////////////////////////////////////////////////////////
if($_POST['FsPAskToRegister']=="yes")
{
	// the value "$databaseconnexion" is set to true in common.php if the connexion is ok
	if($databaseconnexion==FALSE)
	{
		echo "#Answer# Error - unable to connect to mySQL database;";
		return;
	}

	// check username and password again to avoid hacking
	if($query = "SELECT * FROM user_profile WHERE UserName='$_POST[UserName]' and Password='$_POST[Password]'")
    $result=@mysql_query($query);if(!$result){echo "#Answer# SQL Error - ".mysql_error();return;}
	if(mysql_num_rows($result)==0)
	{
		echo "#Answer# Error - Username don't exist or wrong password;";
		return;
	}

	// check the database to see if the flight was registered already
	if($query = "SELECT * FROM flights WHERE UserName='$_POST[UserName]' and FlightId='$_POST[FlightId]' and TotalBlockTime='$_POST[TotalBlockTime]' and ArrivalLocalHour='$_POST[ArrivalLocalHour]'")
    $result=@mysql_query($query);if(!$result){echo "#Answer# SQL Error - ".mysql_error();return;}
	if(mysql_num_rows($result)>0)
	{
		echo "#Answer#exist# Error - Flight already exist in database;";   //this message error should NOT be modified at all...
		return;
	}
	
	// add slashes for idiot server that dumbly disabled magic_quote_gpc
	if(!get_magic_quotes_gpc()) 
	{
                $_POST['PilotPenalityText']		=addslashes($_POST['PilotPenalityText']);
                $_POST['PassengersOpinionText']	=addslashes($_POST['PassengersOpinionText']);
                $_POST['FailureText']			=addslashes($_POST['FailureText']);
                $_POST['CasualtiesText']		=addslashes($_POST['CasualtiesText']);
                $_POST['PilotBonusText']		=addslashes($_POST['PilotBonusText']);
    }

	// ALL IS OK REGISTER THE FLIGHT
	$query = "INSERT INTO flights(id,datestamp,UserName,CompanyName,PilotName,FlightId,OnlineNetworkNbr,FlightDate,AircraftName,AircraftType,NbrPassengers,CargoWeight,Mtow,StartAircraftWeight,EndAircraftWeight,StartFuelQuantity,EndFuelQuantity,DepartureIcaoName,ArrivalIcaoName,DepartureLocalHour,ArrivalLocalHour,DepartureGmtHour,ArrivalGmtHour,TotalBlockTime,TotalBlockTimeNight,TotalAirbornTime,TotalTimeOnGround,TotalDistance,MaxAltitude,CruiseSpeed,CruiseMachSpeed,CruiseTimeStartSec,CruiseTimeStopSec,CruiseFuelStart,CruiseFuelStop,LandingSpeed,LandingPitch,TouchDownVertSpeedFt,CaptainSentMayday,CrashFlag,FlightResult,PassengersOpinion,PassengersOpinionText,FailureText,CasualtiesText,PilotBonusText,BonusPoints,PilotPenalityText,PenalityPoints) VALUES('',now(),'$_POST[UserName]','$_POST[CompanyName]','$_POST[PilotName]','$_POST[FlightId]','$_POST[OnlineNetworkNbr]','$_POST[FlightDate]','$_POST[AircraftName]','$_POST[AircraftType]','$_POST[NbrPassengers]','$_POST[CargoWeight]','$_POST[Mtow]','$_POST[StartAircraftWeight]','$_POST[EndAircraftWeight]','$_POST[StartFuelQuantity]','$_POST[EndFuelQuantity]','$_POST[DepartureIcaoName]','$_POST[ArrivalIcaoName]','$_POST[DepartureLocalHour]','$_POST[ArrivalLocalHour]','$_POST[DepartureGmtHour]','$_POST[ArrivalGmtHour]','$_POST[TotalBlockTime]','$_POST[TotalBlockTimeNight]','$_POST[TotalAirbornTime]','$_POST[TotalTimeOnGround]','$_POST[TotalDistance]','$_POST[MaxAltitude]','$_POST[CruiseSpeed]','$_POST[CruiseMachSpeed]','$_POST[CruiseTimeStartSec]','$_POST[CruiseTimeStopSec]','$_POST[CruiseFuelStart]','$_POST[CruiseFuelStop]','$_POST[LandingSpeed]','$_POST[LandingPitch]','$_POST[TouchDownVertSpeedFt]','$_POST[CaptainSentMayday]','$_POST[CrashFlag]','$_POST[FlightResult]','$_POST[PassengersOpinion]','$_POST[PassengersOpinionText]','$_POST[FailureText]','$_POST[CasualtiesText]','$_POST[PilotBonusText]','$_POST[BonusPoints]','$_POST[PilotPenalityText]','$_POST[PenalityPoints]')";
    if(!@mysql_query($query)){echo "#Answer# SQL Error - ".mysql_error();return;}
	
	// PENALITY DISABLED BIT
	// there is one more value that exist and is not recorded, this value contain the bit of penality disabled
	// by the config/more_option.cfg, this value can help you to check that your users don't cheat
	// if this value is not 0 there was one or more penality disabled, you can perform bit test to know wich one.
	//if($_POST[BitsPenalityDisabled]>0) // mean one penality was disabled
	

	// if we are here all is ok, reply that the fligth was registered
	echo "#Answer# Ok - Saved;";
	WriteDebug();
	exit();
}



//////////////////////////////////////////////////////////////////
// DEBUG FUNCTION                                                 
// ------------------------------------                           
// If you use localhost, FsP can also send report to your         
// localhost, in this case the $_POST value send by FsP will      
// be written in a "debug.txt" file                               
// THIS WILL NOT SHOW WHEN ONLINE                                 
// To test in localhost see directory FsPassengers/config_va/     
// create a new cfg here with any name, copy the data of the      
// VaFsPassengers.cgf into it and change the data accordingly to  
// your setting.  (ie: url like http://localhost/MyTest )         
//////////////////////////////////////////////////////////////////
function WriteDebug()
{
	if($_SERVER['REMOTE_ADDR']=="127.0.0.1")
	{
		if($fp=fopen("Debug.txt","ab"))
		{
			ob_start(); 
			print_r($_POST); 
			$text = ob_get_contents(); 
			ob_end_clean();
			$text = str_replace("\n","\r\n",$text);
			$len=strlen($text);
			fputs($fp,$text,$len);
			fclose($fp);
			echo $text;
		}
	}
}
?>
