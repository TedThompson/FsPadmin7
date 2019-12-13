<?php
if (!defined("FSP_ADMIN"))
    return;
$message   = "";
$Ext_Table = $_REQUEST[table];
if ($Ext_Table == 2 || $Ext_Table == 3) {
    if (!@mysqli_query($db, "CREATE TABLE user_profile (
          id int(16) unsigned NOT NULL auto_increment,
          UserName varchar(22) NOT NULL default '',
          Password varchar(22) NOT NULL default '',
          Email varchar(40) NOT NULL default '',
          PRIMARY KEY  (id),
          KEY UserName (UserName)
        ) TYPE=MyISAM;")) {
        $message = "Unable to create table user_profile in this database mySql error: " . mysqli_error($db);
    }
}
if ($Ext_Table == 1 || $Ext_Table == 3) {
    if (!@mysqli_query($db, "CREATE TABLE flights (
              id int(16) unsigned NOT NULL auto_increment,
              datestamp datetime NOT NULL default '0000-00-00 00:00:00',
              UserName varchar(22) NOT NULL default '',
              CompanyName varchar(35) NOT NULL default '',
              PilotName varchar(35) NOT NULL default '',
              FlightId varchar(10) NOT NULL default '',
              OnlineNetworkNbr tinyint(4) NOT NULL default '0',
              FlightDate date NOT NULL default '0000-00-00',
              AircraftName varchar(50) NOT NULL default '',
              AircraftType varchar(5) NOT NULL default '',
              NbrPassengers smallint(2) NOT NULL default '0',
              CargoWeight varchar(15) NOT NULL default '',
              Mtow varchar(15) NOT NULL default '',
              StartAircraftWeight varchar(15) NOT NULL default '',
              EndAircraftWeight varchar(15) NOT NULL default '',
              StartFuelQuantity varchar(15) NOT NULL default '',
              EndFuelQuantity varchar(15) NOT NULL default '',
              DepartureIcaoName varchar(50) NOT NULL default '',
              ArrivalIcaoName varchar(50) NOT NULL default '',
              DepartureLocalHour time NOT NULL default '00:00:00',
              ArrivalLocalHour time NOT NULL default '00:00:00',
              DepartureGmtHour time NOT NULL default '00:00:00',
              ArrivalGmtHour time NOT NULL default '00:00:00',
              TotalBlockTime time NOT NULL default '00:00:00',
              TotalBlockTimeNight time NOT NULL default '00:00:00',
              TotalAirbornTime time NOT NULL default '00:00:00',
              TotalTimeOnGround time NOT NULL default '00:00:00',
              TotalDistance varchar(18) NOT NULL default '',
              MaxAltitude varchar(15) NOT NULL default '',
              CruiseSpeed varchar(15) NOT NULL default '',
              CruiseMachSpeed varchar(15) NOT NULL default '',
              CruiseTimeStartSec time NOT NULL default '00:00:00',
              CruiseTimeStopSec time NOT NULL default '00:00:00',
              CruiseFuelStart varchar(15) NOT NULL default '',
              CruiseFuelStop varchar(15) NOT NULL default '',
              LandingSpeed varchar(15) NOT NULL default '',
              LandingPitch varchar(15) NOT NULL default '',
              TouchDownVertSpeedFt float NOT NULL default '0',
              CaptainSentMayday tinyint(3) NOT NULL default '0',
              CrashFlag tinyint(3) NOT NULL default '0',
              FlightResult varchar(15) NOT NULL default '',
              PassengersOpinion tinyint(4) NOT NULL default '0',
              PassengersOpinionText text NOT NULL,
              FailureText text NOT NULL,
              CasualtiesText text NOT NULL,
              PilotBonusText text NOT NULL,
              BonusPoints int(10) NOT NULL default '0',
              PilotPenalityText text NOT NULL,
              PenalityPoints int(10) NOT NULL default '0',
              PRIMARY KEY  (id),
              KEY datestamp (datestamp),
              KEY UserName (UserName),
              KEY CompanyName (CompanyName),
              KEY PilotName (PilotName),
              KEY AircraftName (AircraftName)
            ) TYPE=MyISAM;")) {
        $message = $message . 'Unable to create table flights in this database mySql error: ' . mysqli_error($db);
    }
}
if ($message == "")
    $message = "table created";
$_SESSION['message'] = $message;
header("Location: index.php");
?>