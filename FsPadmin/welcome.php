<?php
if(!defined("FSP_ADMIN")) return;
# Output table and form
echo '<br><br><br><table class="WithTitle" align="center" width="400" cellspacing="2" cellpadding="2" border="0" bgcolor="#4444FF" ><tr><td align="center">';
echo "<strong>Welcome</strong>";
echo '</td></tr></table>';
echo '<table class="TinyFrame" width="400" border="0" cellspacing="2" cellpadding="8" align="center" bgcolor="#FFFFFF">';
echo "<tr><td valign=\"top\">";
echo "<br><strong>Welcome on FsPassengers Admin pages</strong>,";
if($cfg['admin_user']=="demo")
{
	echo '<br><br>This is certainly your first visit in the admin part, the first things you will need to do is to click on <a href="index.php?page=setting">edit settings</a> in the left menu ';
	echo 'to select your Sql database. Once done, the admin will take care for you to create the needed tables.<br><br>';
	echo 'Notice that you can switch easily beetween localhost or your online database using the admin setting.<br><br>';
	echo '<strong class="Red">DON\'T forget to change the admin password and username, you can\'t leave it on the "Demo" default setting.</strong><br><br>';
}
else if(!$databaseconnexion)
{
	echo '<br><br>You are <strong class="Red">not connected</strong> to any MySql database, please click <a href="index.php?page=setting">edit settings</a> to set the appropriate settings for your database.</LI><br><br>';
}
else 
{
	$tablenotexist=0;
	$tablenotexist=(mysqli_query($db,"SELECT * FROM flights")==false)? $tablenotexist=1:$tablenotexist;
	$tablenotexist=(mysqli_query($db,"SELECT * FROM user_profile")==false)? $tablenotexist=$tablenotexist+2:$tablenotexist;
	switch($tablenotexist)
	{
	case 0:
		echo '<br><br><strong class="Green">All is running fine</strong>, choose an option in the left menu.</LI><br><br>';
	if($cfg['admin_user']==""||$cfg['admin_pass']=="")
			echo '<LI>I remind you that leaving the admin password or user on <strong class="Red">default setting</strong> is not a good idea at all, please change that in the <a href="index.php?page=setting">edit settings</a> on the left menu.</LI><br><br>';			
		break;
	case 1:
		echo '<br><br><LI>The table <strong class="Red">flights</strong> does not exist in this database, click here "<a href="index.php?action=action_createtables.php&table=1">create table</a>" if you want to create it.</LI><br><br>';
		break;
	case 2:
		echo '<br><br><LI>The table <strong class="Red">user_profile</strong> does not exist in this database, click here "<a href="index.php?action=action_createtables.php&table=2">create table</a>" if you want to create it.</LI><br><br>';
		break;
	case 3:
		echo '<br><br><LI>The table <strong class="Red">flights</strong> and <strong class="Red">user_profile</strong> does not exist in this database, click here "<a href="index.php?action=action_createtables.php&table=3">create table</a>" if you want to create them.</LI><br><br>';
		break;
	}
}
echo '</td></tr></table>';
?>