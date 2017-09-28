<?
if(!defined("FSP")) return;
#
# common.php  this file do the SQL database connexion
#
######### FOR CONFIGURATION SEE SETTING.PHP #########
//////////////////////////////////////////////////////////
// DATABASE CONNEXION
//////////////////////////////////////////////////////////

if($cfg['DebugTestonLocalHost']==false)
{
	$db = mysqli_connect($cfg['mysql_server'],$cfg['user'],$cfg['passwordbase']); //,$cfg['database'],null,null);
}
else
{
	$db = mysqli_connect("localhost","","");
}

if (mysqli_connect_errno()) 
{
	printf("Connect failed: %s\n", mysqli_connect_error());
	$databaseconnexion=false;
	//exit();
}
else
{
	$databaseconnexion=true;
}

mysqli_select_db($db,$cfg['database']);
//////////////////////////////////////////////////////////
?>