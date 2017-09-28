<?php
if(!defined("FSP_ADMIN")) return;

# Define Form
 $startof_form 				='<form action="index.php?action=action_writesetting.php" method="post">';
 $uselocalhostinput 		=($cfg['DebugTestonLocalHost']==true)?'<input type="checkbox" name="uselocalhost" value="true" checked> (use database below)':'<input type="checkbox" name="uselocalhost" value="true">';
 $mysql_serverinput			='<input type="text" name="mysql_server" value="'.$cfg[mysql_server].'" size="25" maxlength="25">';
 $databaseinput				='<input type="text" name="database" value="'.$cfg[database].'" size="25" maxlength="25">';
 $databaselocalhostinput	='<input type="text" name="databaselocalhost" value="'. $cfg[databaselocalhost].'" size="25" maxlength="25">';
 $userinput					='<input type="text" name="user" value="'.$cfg[user].'" size="25" maxlength="25">';
 $passwordbaseinput			='<input type="text" name="passwordbase" value="'.$cfg[passwordbase].'" size="25" maxlength="25">';
 $AdminUserinput			='<input type="text" name="admin_user" value="'. $cfg[admin_user].'" size="25" maxlength="25">';
 $Adminpassinput			='<input type="text" name="admin_pass" value="'. $cfg[admin_pass].'" size="25" maxlength="25">';
 $WelcomeMessage			='<textarea cols="55" rows="7" name="welcome_message" style="font-family: Microsoft Sans Serif; font-size: 8pt;">'. $cfg[welcome_message].'</textarea>';
 $submitbutton      		='<input type="submit" name="submit" value="Write settings">';
 $end_of_form				='</FORM>';


 
 # Output table and form
echo '<br><br><br><table class="WithTitle" align="center" width="400" cellspacing="2" cellpadding="2" border="0" bgcolor="#4444FF" ><tr><td align="center">';
echo "<strong>EDIT SETTINGS</strong>";
echo '</td></tr></table>';
echo '<table class="TinyFrame" width="400" border="0" cellspacing="2" cellpadding="2" align="center" bgcolor="#FFFFFF">';
echo $startof_form;
echo "<tr><td align=\"center\" colspan=\"2\"><br><strong><u>General setting</u></strong></td></tr>";
echo "<tr><td align=\"right\">Debug, use localhost:&nbsp;</td><td>$uselocalhostinput</td></tr>";
echo "<tr><td align=\"right\">Localhost database:&nbsp;</td><td>$databaselocalhostinput</td></tr>";
echo "<tr></tr>";
echo "<tr><td align=\"center\" colspan=\"2\"><strong><u>Online SQL Server setting</u></strong></td></tr>";
echo "<tr></tr>";
echo "<tr><td align=\"right\">Server:&nbsp;</td><td>$mysql_serverinput</td></tr>";
echo "<tr><td align=\"right\">Database:&nbsp;</td><td>$databaseinput</td></tr>";
echo "<tr><td align=\"right\">Database UserName:&nbsp;</td><td>$userinput</td></tr>";
echo "<tr><td align=\"right\">Database Password:&nbsp;</td><td>$passwordbaseinput</td></tr>";
echo "<tr></tr>";
echo "<tr><td align=\"center\" colspan=\"2\"><strong><u>Admin setting</u></strong></td></tr>";
echo "<tr><td align=\"right\">FsP Admin Login:&nbsp;</td><td>$AdminUserinput</td></tr>";
echo "<tr><td align=\"right\">FsP Admin password:&nbsp;</td><td>$Adminpassinput</td></tr>";
echo "<tr></tr>";
echo "<tr><td align=\"center\" colspan=\"2\"><strong><u>FsPassengers export unit</u></strong></td></tr>";
echo "<tr><td align=\"right\">Weight Units:&nbsp;</td><td>"?>
<select name="WeightUnit" maxlength="25">
<option value="0" <? if($cfg['WeightUnit']=="0") echo "selected";?> >Kilogram</option>
<option value="1" <? if($cfg['WeightUnit']=="1") echo "selected";?> >Lbs</option>
</select>
<? echo "</td></tr>";
echo "<tr><td align=\"right\">Distance Units:&nbsp;</td><td>"?>
<select name="DistanceUnit">
<option value="0" <? if($cfg['DistanceUnit']=="0") echo "selected";?> >Km</option>
<option value="1" <? if($cfg['DistanceUnit']=="1") echo "selected";?> >Miles</option>
<option value="2" <? if($cfg['DistanceUnit']=="2") echo "selected";?> >Nautical Miles</option>
</select>
<? echo "</td></tr>";
echo "<tr><td align=\"right\">Speed Units:&nbsp;</td><td>"?>
<select name="SpeedUnit">
<option value="0" <? if($cfg['SpeedUnit']=="0") echo "selected";?> >Km/H</option>
<option value="1" <? if($cfg['SpeedUnit']=="1") echo "selected";?> >Kts</option>
</select>
<? echo "</td></tr>";
echo "<tr><td align=\"right\">Altitude Units:&nbsp;</td><td>"?>
<select name="AltUnit">
<option value="0" <? if($cfg['AltUnit']=="0") echo "selected";?> >Meter</option>
<option value="1" <? if($cfg['AltUnit']=="1") echo "selected";?> >Feet</option>
</select>
<? echo "</td></tr>";
echo "<tr><td align=\"right\">Liquid Units (fuel):&nbsp;</td><td>"?>
<select name="LiquidUnit">
<option value="0" <? if($cfg['LiquidUnit']=="0") echo "selected";?> >Liter</option>
<option value="1" <? if($cfg['LiquidUnit']=="1") echo "selected";?> >Gallon</option>
<option value="2" <? if($cfg['LiquidUnit']=="2") echo "selected";?> >Kilogram</option>
<option value="3" <? if($cfg['LiquidUnit']=="3") echo "selected";?> >Lbs</option>
</select>
<? echo "</td></tr>";
echo "<tr></tr>";
echo "<tr><td align=\"center\" colspan=\"2\"><strong><u>Your Welcome message when FsP connect</u></strong><br><br>This below will be displayed into user's export dialog when he connect to your site (max 255 characters)</td></tr>";
echo "<tr><td align=\"center\" colspan=\"2\">$WelcomeMessage</td></tr>";


echo "<tr><td colspan=\"2\" align=\"center\"><br>$submitbutton<br><br></td></tr>";
echo  $end_of_form;
echo "<tr></tr>";
echo '</table>';
?>
