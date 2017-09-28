<?
if(!defined("FSP_ADMIN")) return;

// update the data
$cfg['DebugTestonLocalHost']	=($_REQUEST[uselocalhost]==true)? "true":"false";
$cfg['mysql_server']			=$_REQUEST[mysql_server];
$cfg['database']				=$_REQUEST[database];
$cfg['databaselocalhost']       =$_REQUEST[databaselocalhost];
$cfg['user']					=$_REQUEST[user];
$cfg['passwordbase']			=$_REQUEST[passwordbase];
$cfg['admin_user']				=$_REQUEST[admin_user];
$cfg['admin_pass']				=$_REQUEST[admin_pass];
$cfg['admin_user']  = htmlspecialchars($cfg['admin_user']);
$cfg['admin_pass']  = htmlspecialchars($cfg['admin_pass']);
$cfg['WeightUnit']				=$_REQUEST[WeightUnit];;		
$cfg['DistanceUnit']			=$_REQUEST[DistanceUnit];
$cfg['SpeedUnit']				=$_REQUEST[SpeedUnit];
$cfg['AltUnit']					=$_REQUEST[AltUnit];
$cfg['LiquidUnit']				=$_REQUEST[LiquidUnit];	
$cfg['welcome_message']			=$_REQUEST[welcome_message];	
$cfg['welcome_message']=str_replace("\r\n", "\r",$cfg['welcome_message']);
//limit to 255 characters
//$cfg['welcome_message']=substr($cfg['welcome_message'],0,255);


// create the data to be saved
$data="<?php\n";
$data.="# DO NOT EDIT THIS FILE.  USE THE ADMIN\n";
$data.="if(!defined(\"FSP\")) return;\n\n";
$data.="#general\n";
$data.="\$cfg['DebugTestonLocalHost']=$cfg[DebugTestonLocalHost];\n";
$data.="\$cfg['databaselocalhost']='$cfg[databaselocalhost]';\n";
$data.="\n";
$data.="#database\n";
$data.="\$cfg['mysql_server']='$cfg[mysql_server]';\n";
$data.="\$cfg['database']='$cfg[database]';\n";
$data.="\$cfg['user']='$cfg[user]';\n";
$data.="\$cfg['passwordbase']='$cfg[passwordbase]';\n";
$data.="\n";
$data.="#administration\n";
$data.="if(defined(\"FSP_ADMIN\"))\n{\n";
$data.="\$cfg['admin_user']='$cfg[admin_user]';\n";
$data.="\$cfg['admin_pass']='$cfg[admin_pass]';\n";
$data.="}\n";
$data.="\n";
$data.="#units settings\n";
$data.="\$cfg['WeightUnit']		='$cfg[WeightUnit]';   //0=Kg 1=lbs\n";			
$data.="\$cfg['DistanceUnit']	='$cfg[DistanceUnit]';   //0=KM 1= Miles 2=NMiles\n";			
$data.="\$cfg['SpeedUnit']		='$cfg[SpeedUnit]';   //0=Km/H 1=Kts\n";			
$data.="\$cfg['AltUnit']			='$cfg[AltUnit]';   //0=Meter 1=Feet \n";			
$data.="\$cfg['LiquidUnit']		='$cfg[LiquidUnit]';   //0=liter 1=gal 2=kg 3=lbs\n";			
$data.="\n";
$data.="#Welcome message\n";
$data.="\$cfg['welcome_message']	='$cfg[welcome_message]';";
$data.="\n";
$data.="?>";

// save the file
if($fp = fopen("setting.php", "w"))
{
   $size=fputs($fp, $data);
   fclose($fp);
   $message="setting succesfully updated $size records written";
 
	// change the session password if it was changed
	if($_SESSION['user']!=$cfg['admin_user']||$_SESSION['pass']!=$cfg['admin_pass'])
	{
		// c'est bon mets la session
		$_SESSION['user']=$cfg['admin_user'];
		$_SESSION['pass']=$cfg['admin_pass'];
		$message="setting succesfully updated, admin user or password changed";
	}  
  
} 
else 
{
   $message="Could not open file setting.php.  Please check the file permissions.";
}

$_SESSION['message']=$message;

header("Location: index.php?page=setting");
?>
