<?php
if(!defined("FSP_ADMIN")) return;
?>
                <table class="WithTitle" align="center" width="400" cellspacing="2" cellpadding="2" border="0" bgcolor="#4444FF">
                  <tr>
                    <td align="center">
                      <strong>Welcome</strong>
                    </td>
                  </tr>
                </table>
                <table class="TinyFrame" width="400" border="0" cellspacing="2" cellpadding="8" align="center" bgcolor="#FFFFFF">
                  <tr>
                    <td valign="top">
					  <br />
                      <strong>Welcome on FsPassengers Admin pages</strong>,
<?php
if($cfg['admin_user']=="demo")
{ ?>
                      <br />
                      <br />This seems to be your first visit in the admin page. The first things you will need to do is to click on 
					  <a href="index.php?page=setting">edit settings</a> in the left menu to enter the credentials for your Sql database. Once done, the needed tables will be generated automatically.
                      <br />
                      <br />Notice that you can switch easily beetween localhost or your online database using the &quot;Debug&quot; checkbox under the general settings.
                      <br />
                      <br />
                      <strong class="Red">DON&#39;T forget to change the admin password and username, you can&#39;t leave it on the &quot;Demo&quot; default setting.</strong>
                      <br />
                      <br />
<?php }
else if(!$databaseconnexion)
{ ?>
                      <br />
					  <br />You are 
					  <strong class="Red">not connected</strong> to any MySql database, please click 
					  <a href="index.php?page=setting">edit settings</a> to set the appropriate settings for your database.
					  <br />
					  <br /> 
<?php
}
else 
{
    $tablenotexist=0;
    $tablenotexist=(mysqli_query($db,"SELECT * FROM flights")==false)? $tablenotexist=1:$tablenotexist;
    $tablenotexist=(mysqli_query($db,"SELECT * FROM user_profile")==false)? $tablenotexist=$tablenotexist+2:$tablenotexist;
    switch($tablenotexist)
    {
    case 0:
        echo '                      <br />
		              <br />
					  <ul>
						<li>
						  <strong class="Green">All is running fine</strong>, choose an option in the left menu.
						</li>
					  ';
    if($cfg['admin_user']==""||$cfg['admin_pass']=="")
            echo '  <li>I remind you that leaving the admin password or user on 
						  <strong class="Red">default setting</strong> is not a good idea at all, please change that in the 
						  <a href="index.php?page=setting">edit settings</a> on the left menu.
						</li>
					  ';
		echo '</ul>';
        break;
    case 1:
        echo '                      <br />
		              <br />
					  <ul>
						<li>The table 
						  <strong class="Red">flights</strong> does not exist in this database, click here 
						  "<a href="index.php?action=action_createtables.php&table=1">create table</a>" if you want to create it.
						</li>
					  </ul>';
        break;
    case 2:
        echo '                      <br />
		              <br />
					  <ul>
						<li>The table 
						  <strong class="Red">user_profile</strong> does not exist in this database, click here 
						  "<a href="index.php?action=action_createtables.php&table=2">create table</a>" if you want to create it.
						</li>
					  </ul>';
        break;
    case 3:
        echo '                      <br />
		              <br />
					  <ul>
						<li>The table 
						<strong class="Red">flights</strong> and 
						<strong class="Red">user_profile</strong> does not exist in this database, click here 
						"<a href="index.php?action=action_createtables.php&table=3">create table</a>" if you want to create them.
					    </li>
					  </ul>';
        break;
    }
}
?>

					  <br />
					  <br />
					</td>
				  </tr>
				</table>
