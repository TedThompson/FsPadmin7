<?php
#Config File for the FSP Sig
if(!defined("FSP")) return;

#The following variables can be edited/toggle as required

#General variables
$cfg["SigName"] = "siglarge.png";	//Enter the name of your sig template
$cfg["DebugMode"] = 0;		//1 = Enable debug mode, 0 = Disable debug mode
$cfg["XOffset"] = 15;		//Number of pixels from the left side of your sig
$cfg["YOffset"] = 10;		//Number of pixels from the top of your sig
$cfg["Spacing"] = 11;		//Space between lines
$cfg["RColour"] = 0;		//Red component of the RGB text colour
$cfg["GColour"] = 0;		//Green component of the RGB text colour
$cfg["BColour"] = 0;		//Blue component of the RGB text colour
$cfg["Font"] = 2;		//[1] Small, [2] Medium, [3] Mediumm bold, [4] Large, [5] Large bold


#Last Flight Data (1 = Enabled, 0 = Disabled)
$cfg["ShowPilotName"] = 1;	//Display pilot who performed last flight
$cfg["ShowNumFlights"] = 1;	//Display total number of flights
$cfg["ShowCompanyName"] = 1;	//Display company used to perform last flight
$cfg["ShowFlightNumber"] = 1;	//Display the flight number of the last flight
$cfg["ShowLeg"] = 1;		//Display the departure and arrival ICAO codes of the last flight
$cfg["ShowLastDate"] = 1;	//Display date of last flight
$cfg["ShowLastAircraft"] = 1;	//Display the name of the aircraft used during the last flight
$cfg["ShowPax"] = 1;		//Display the number of pax last transported
$cfg["ShowDuration"] = 1;	//Display the duration of the last flight
$cfg["ShowDistance"] = 1;	//Display the distance flow at the occasion of the last flight
$cfg["ShowAltitude"] = 1;	//Display the the maximum altitude reached during the last flight
$cfg["ShowLSpeed"] = 1;		//Display the landing speed of the last flight
$cfg["ShowTDSpeed"] = 1;	//Display the touchdown speed of the last flight
$cfg["ShowResult"] = 1;		//Display the result of the last flight
$cfg["ShowOpinion"] = 1;	//Display the passenger opinion for the last flight

#Statistics (1 = Enabled, 0 = Disabled)
$cfg["ShowTotalTime"] = 1;		//Display the total time flown with FSPassengers
$cfg["ShowAverageTime"] = 1;	//Display the average time per flight
$cfg["ShowTotalDistance"] = 1;	//Display the total distance flown with FSPassengers
$cfg["ShowAverageDistance"] = 1;	//Display the average distance flown per flight
$cfg["ShowTotalPax"] = 1;		//Display the total amount of Pax transported
$cfg["ShowAverageTDS"] = 1;		//Display the average touchdown speed over all flights
$cfg["ShowMinimumTDS"] = 1;		//Display the minimum touchdown speed ever achieved
$cfg["ShowMaximumTDS"] = 1;		//Display the maximum touchdown speed ever suffered

?>