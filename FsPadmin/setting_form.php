<?php
if(!defined("FSP_ADMIN")) 
    return;

// Define Form
 $startof_form              ='<form action="index.php?action=action_writesetting.php" method="post">';
 $uselocalhostinput         =($cfg['DebugTestonLocalHost']==true)?'<input type="checkbox" name="uselocalhost" value="true" checked> (use database below)':'<input type="checkbox" name="uselocalhost" value="true">';
 $mysql_serverinput         ='<input type="text" name="mysql_server" value="'.$cfg[mysql_server].'" size="25" maxlength="50">';
 $databaseinput             ='<input type="text" name="database" value="'.$cfg[database].'" size="25" maxlength="50">';
 $databaselocalhostinput    ='<input type="text" name="databaselocalhost" value="'. $cfg[databaselocalhost].'" size="25" maxlength="50">';
 $userinput                 ='<input type="text" name="user" value="'.$cfg[user].'" size="25" maxlength="50">';
 $passwordbaseinput         ='<input type="text" name="passwordbase" value="'.$cfg[passwordbase].'" size="25" maxlength="50">';
 $AdminUserinput            ='<input type="text" name="admin_user" value="'. $cfg[admin_user].'" size="25" maxlength="50">';
 $Adminpassinput            ='<input type="text" name="admin_pass" value="'. $cfg[admin_pass].'" size="25" maxlength="50">';
 $WelcomeMessage            ='<textarea cols="55" rows="7" name="welcome_message" style="font-family: Microsoft Sans Serif; font-size: 8pt;">'. $cfg[welcome_message].'</textarea>';
 $submitbutton              ='<input type="submit" name="submit" value="Write settings">';
 $end_of_form               ='</form>';
 
// Output table and form
?>
              <table class="WithTitle" align="center" width="400" cellspacing="2" cellpadding="2" border="0" bgcolor="#4444FF" >
                <tr>
                  <td align="center">
                    <strong>EDIT SETTINGS</strong>
                  </td>
                </tr>
              </table>
              <table class="TinyFrame" width="400" border="0" cellspacing="2" cellpadding="2" align="center" bgcolor="#FFFFFF">
                <? echo $startof_form; ?>
                
                  <tr>
                    <td align="center" colspan="2" style="padding-top: 0px"><br /><strong><u>General setting</u></strong></td>
                  </tr>
                  <tr>
                    <td align="right">Debug, use localhost:&nbsp;</td>
                    <td><? echo $uselocalhostinput; ?></td>
                  </tr>
                  <tr>
                    <td align="right">Localhost database:&nbsp;</td>
                    <td><? echo $databaselocalhostinput; ?></td>
                  </tr>
                  <tr>
                    <td align="center" colspan="2"><strong><u>Online SQL Server setting</u></strong></td>
                  </tr>
                  <tr>
                    <td align="right">Server:&nbsp;</td>
                    <td><? echo $mysql_serverinput; ?></td>
                  </tr>
                  <tr>
                    <td align="right">Database:&nbsp;</td>
                    <td><? echo $databaseinput; ?></td>
                  </tr>
                  <tr>
                    <td align="right">Database UserName:&nbsp;</td>
                    <td><? echo $userinput; ?></td>
                  </tr>
                  <tr>
                    <td align="right">Database Password:&nbsp;</td>
                    <td><? echo $passwordbaseinput; ?></td>
                  </tr>
                  <tr>
                    <td align="center" colspan="2"><strong><u>Admin setting</u></strong></td>
                  </tr>
                  <tr>
                    <td align="right">FsP Admin Login:&nbsp;</td>
                    <td><? echo $AdminUserinput; ?></td>
                  </tr>
                  <tr>
                    <td align="right">FsP Admin password:&nbsp;</td>
                    <td><? echo $Adminpassinput; ?></td>
                  </tr>
                  <tr>
                    <td align="center" colspan="2"><strong><u>FsPassengers export unit</u></strong></td>
                  </tr>
                  <tr>
                    <td align="right">Weight Units:&nbsp;</td>
                    <td>
                      <select name="WeightUnit" maxlength="50">
                        <option value="0" <? if($cfg['WeightUnit']=="0") echo "selected";?> >Kilogram</option>
                        <option value="1" <? if($cfg['WeightUnit']=="1") echo "selected";?> >Lbs</option>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td align="right">Distance Units:&nbsp;</td>
                    <td>
                      <select name="DistanceUnit">
                        <option value="0" <? if($cfg['DistanceUnit']=="0") echo "selected";?> >Km</option>
                        <option value="1" <? if($cfg['DistanceUnit']=="1") echo "selected";?> >Miles</option>
                        <option value="2" <? if($cfg['DistanceUnit']=="2") echo "selected";?> >Nautical Miles</option>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td align="right">Speed Units:&nbsp;</td>
                    <td>
                      <select name="SpeedUnit">
                        <option value="0" <? if($cfg['SpeedUnit']=="0") echo "selected";?> >Km/H</option>
                        <option value="1" <? if($cfg['SpeedUnit']=="1") echo "selected";?> >Kts</option>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td align="right">Altitude Units:&nbsp;</td>
                    <td>
                      <select name="AltUnit">
                        <option value="0" <? if($cfg['AltUnit']=="0") echo "selected";?> >Meter</option>
                        <option value="1" <? if($cfg['AltUnit']=="1") echo "selected";?> >Feet</option>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td align="right">Liquid Units (fuel):&nbsp;</td>
                    <td>
                      <select name="LiquidUnit">
                        <option value="0" <? if($cfg['LiquidUnit']=="0") echo "selected";?> >Liter</option>
                        <option value="1" <? if($cfg['LiquidUnit']=="1") echo "selected";?> >Gallon</option>
                        <option value="2" <? if($cfg['LiquidUnit']=="2") echo "selected";?> >Kilogram</option>
                        <option value="3" <? if($cfg['LiquidUnit']=="3") echo "selected";?> >Lbs</option>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td align="center" colspan="2">
                      <strong><u>Your Welcome message when FsP connect</u></strong>
                      <br />
                      <br />The following text will be show in all users&apos; export dialog when they connect to your site (max 255 characters)
                    </td>
                  </tr>
                  <tr>
                    <td align="center" colspan="2"><? echo $WelcomeMessage; ?></td>
                  </tr>
                  <tr>
                    <td colspan="2" align="center">
                      <br />
                      <? echo $submitbutton; ?>
                        
                      <br />
                      <br />
                    </td>
                  </tr>
                <? echo  $end_of_form; ?>
                
              </table>