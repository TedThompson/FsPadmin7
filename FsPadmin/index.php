<?php
/**
 * index.php (admin)
 *
 * *******************************************************
 * *                                                     *
 * *   FsPassengers 1.0 - for PHP/MySQL                  *
 * *                                                     *
 * *                 [ may 25, 2005 ]                    *
 * *                                                     *
 * *******************************************************
 *
 * Copyright 2005 Daniel Polli. All rights reserved.
 * You are free to modify and distribute those source
 * given that you include the copyright text
 *
 * Extensive refactoring and updating by T. Thompson 
 * 2017, 2019
 *
 * -- Updated to be PHP7 compatible 2017-19
 */
session_start();
header("Cache-control: private");
define("FSP", 1);
define("FSP_ADMIN", 1);
$adminview = 1;
// include file setting that contain the SQL database setting
@include("setting.php");
// common is in charge to connect you to the SQL database
require("common.php");
require("login.php");
// Get the external value
$Ext_page    = removedangerous($_REQUEST[page]);
$Ext_action  = removedangerous($_REQUEST[action]);
$name        = removedangerous($_REQUEST[name]);
$Ext_message = removedangerous($_SESSION[message]);
// destroy session message
if ($Ext_message == "")
    $Ext_message = "<br />";
else
    $_SESSION[message] = FALSE;
// do action page
if (isset($Ext_action)) {
    if ($Ext_action == "logout") {
        $_SESSION = array();
        session_destroy();
        header("Location: index.php");
    } else if ($Ext_action == "action_writesetting.php") {
        include "action_writesetting.php";
    } else if ($Ext_action == "action_createtables.php") {
        include "action_createtables.php";
    }
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>FsPassengers admin</title>
    <link href="admin.css" rel="stylesheet" type="text/css" />
  </head>
  <body bgcolor="#C0C0C0">
    <table align="center" width="900" cellspacing="2" cellpadding="2" border="0">
      <tr>
        <td>
          <table align="center" width="900" cellspacing="2" cellpadding="2" border="0">
            <tr align="center">
              <td align="center" colspan="3">
                <strong style="font-size: 20px;">
                  <u>
                    <em>FsPadmin for PHP7 v2.0</em>
                  </u>
                </strong>
				<br />Original code &copy;2005 by Daniel Polli
				<br />Updated 2017-19 by Ted Thompson
              </td>
            </tr>
            <tr align="center">
              <td align="center" colspan="3" style="color: Blue;">
                <strong><?php echo $Ext_message; ?></strong>
              </td>
            </tr>
            <tr>
              <td width="200" valign="top">
<?php
// first tab ############################################################################
include "left_menu.php";
?>
              </td>
			  <td valign="top">
<!-- Begin Dynamic Content -->
<?php
// middle tab ############################################################################
// display the pages in the middle panel
if ($Ext_page == "") {
    include "welcome.php";
} else if ($Ext_page == "setting") {
    include "setting_form.php";
} else if ($Ext_page == "user_admin") {
    include "user_admin.php";
}
?>
<!-- End Dynamic Content -->
			  </td>
              <td width="200" align="center" valign="top">
                <table class="WithTitle" align="center" width="200" cellspacing="2" cellpadding="2" border="0" bgcolor="#4444FF">
                  <tr>
                    <td align="center">
                      <strong>FsPassengers 1.5 status</strong>
                    </td>
                  </tr>
                </table>
                <table class="TinyFrame" width="200" border="0" cellspacing="2" cellpadding="2" align="center" bgcolor="#DDDDFF">
                  <tr>
                    <td align="center">
                      <br />
                      <table align="center">
                        <tr>
                          <td>
<!-- Begin Dynamic Status Box -->
<?php
$spacer = "\n                            ";
echo "                            ";
echo ($databaseconnexion == true) ? "<strong class=\"Green\">Connected</strong>" : "<strong class=\"Red\">Not connected</strong> ";
echo $spacer;
echo ($cfg['DebugTestonLocalHost'] == true) ? "to<br /><br /> localhost server$spacer<br /><br />Database:<br />$cfg[databaselocalhost]<br />" : "to<br /><br />Server:<br />$cfg[mysql_server]$spacer<br /><br />Database:<br />$cfg[database]<br />";
echo ($databaseconnexion == false) ? "$spacer<br /><strong class=\"Red\">mySql error: <br />" . mysqli_error($db) . "</strong><br />" : "";
// warn if no table
if ($databaseconnexion == true) {
    $tablenotexist = 0;
    $tablenotexist = (mysqli_query($db, "SELECT * FROM flights") == false) ? $tablenotexist = 1 : $tablenotexist;
    $tablenotexist = (mysqli_query($db, "SELECT * FROM user_profile") == false) ? $tablenotexist = $tablenotexist + 2 : $tablenotexist;
    switch ($tablenotexist) 
	{
        case 1:
            echo '<br /><br />The table ' . $spacer . '<strong class="Red">flights</strong> does not exist in this database, click here "<a href="index.php?action=action_createtables.php&table=1">create table</a>" if you want to create it.' . $spacer . '<br />';
            break;
        case 2:
            echo '<br /><br />The table ' . $spacer . '<strong class="Red">user_profile</strong> does not exist in this database, click here "<a href="index.php?action=action_createtables.php&table=2">create table</a>" if you want to create it.' . $spacer . '<br />';
            break;
        case 3:
            echo '<br /><br />The table ' . $spacer . '<strong class="Red">flights</strong> and $spacer<strong class="Red">user_profile</strong> does not exist in this database, click here "<a href="index.php?action=action_createtables.php&table=3">create table</a>" if you want to create them.' . $spacer . '<br />';
            break;
    }
}
echo "\n";
?>
<!-- End Dynamic Status Box -->
                            <br />
                            <br />
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </body>
</html>
<?php
function removedangerous($input)
{
    $input = preg_replace("[^A-Za-z0-9יטאüצהך_@.* -]", "", $input);
    return $input;
}
// DEBUG DEBUG DEBUG
if ($_SERVER['REMOTE_ADDR'] == "127.0.0.1") {
    echo '<br /><br /><br /><br /><table align="center" bgcolor="#D9FFDE" width="95%" cellspacing="2" cellpadding="2" border="0"><tr><td>';
    echo '<div align="center"><hr><strong>DEBUG VALUES</strong><hr></div>';
    echo '<br /><u>print_r($_SESSION) Session:</u><br />';
    print_r($_SESSION);
    echo '<br /><br /><br /><u>print_r($_COOKIE) Cookie:</u><br />';
    print_r($_COOKIE);
    echo '<br /><br /><br /><u>print_r($_POST) Post:</u><br />';
    print_r($_POST);
    echo '<br /><br /><br /><u>print_r($_GET) Get:</u><br />';
    print_r($_GET);
    //echo '<br /><br /><br /><u>print_r($cfg) Config:</u><br />'; print_r($cfg);
    echo '<br /><br />$Ext_Page:' . $Ext_page;
    echo '<br />$Ext_action:' . $Ext_action;
    echo '<br />$Ext_message:' . $Ext_message;
    echo '</td></tr></table>';
}
// DEBUG DEBUG DEBUG
?>