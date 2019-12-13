<?php
if(!defined("FSP_ADMIN")) return;

// recovered session
$user   = $_SESSION['user'];
$pass   = $_SESSION['pass'];

// ok we are in session?, continue?
if($user==$cfg['admin_user']&&$pass==$cfg['admin_pass']){
	return true;
}

// OK, that didn't work. Are we just now entering the password in the form?
$user  = $_POST['user'];
$pass  = $_POST['pass'];
$login = $_POST['login'];
$user  = htmlspecialchars($user);
$pass  = htmlspecialchars($pass);
if($login==1)
{
	if($user==$cfg['admin_user']&&$pass==$cfg['admin_pass']){
		// c'est bon mets la session
		$_SESSION['user']=$user;
		$_SESSION['pass']=$pass;
		$_SESSION['message']="user $user logged in";
		$_SESSION['wrong_password']=FALSE;
		return true;
	}
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>FsPassengers login</title>
	<link href="admin.css" rel="stylesheet" type="text/css">
</head>

<body bgcolor="#C0C0C0">

<br><br>
<table align="center" width="900" cellspacing="2" cellpadding="2" border="0">
<tr align="center"><td align="center" colspan="3"><strong style="font-size: 20px;"><u><em>FsPassengers 1.5 admin</em></u></strong></td></tr>
</table>
<br><br>
<table align="center" width="300" cellspacing="2" cellpadding="2" border="0">
<tr><td align="center">
<?
if($_SESSION['wrong_password']>0)
{
 	echo "<strong style=\"color: Red;\">wrong login, try again.</strong>"; 
}
else
{
 	echo "<strong style=\"color: Red;\">&nbsp;</strong>"; 
}
?>
 </td></tr>
<tr><td align="center">
<form action="index.php" method="post">
<table>
<tr>
  <td>User : </td>
  <td><input type="text" name="user" value="<?php echo $user;?>"></td>
</tr>
<tr>
  <td>pass : </td>
  <td><input type="password" name="pass"></td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td align="center"><input type="submit" name="submit" value="Login"></td>
</tr>
</table>
<input type="hidden" name="login" value="1">
</form>
</tr></td>
</table>
</body>
</html> 
<?php 
exit();
?>