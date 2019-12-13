 <?php
if (!defined("FSP"))
    return;
/**
 * common.php  this file does the SQL database connexion
 *
 * ######### FOR CONFIGURATION SEE SETTING.PHP #########
 *
 * DATABASE CONNEXION
 */
$databaseconnexion = true; // assume we will be connected
if ($cfg['DebugTestonLocalHost'] == false) {
    $db = mysqli_connect($cfg['mysql_server'], $cfg['user'], $cfg['passwordbase'], $cfg['database']);
} else {
    $db = mysqli_connect("localhost", "", "", $cfg['databaselocalhost']);
}
if (!$db) {
    //echo 'Could Not Connect! <br>';
    $databaseconnexion = false;
}
?> 