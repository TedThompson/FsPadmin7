<?php
if(!defined("FSP_ADMIN")) 
	return;

// Output table and form
?>
				<table class="WithTitle" align="center" width="400" cellspacing="2" cellpadding="2" border="0" bgcolor="#4444FF">
				  <tr>
					<td align="center">
					  <strong>User Admin</strong>
					</td>
				  </tr>
				</table>
				<table class="TinyFrame" width="400" border="0" cellspacing="2" cellpadding="8" align="center" bgcolor="#FFFFFF">
				  <tr>
					<td valign="top">
<?
if(!$databaseconnexion)
{
?>
					  <br />
					  <br />
					  <ul>
						<li>
					      You are 
						  <strong class="Red">not connected</strong> to any MySql database, please click 
						  <a href="index.php?page=setting">edit settings</a> to set the appropriate settings for your database.
						</li>
					  </ul>
					  <br />
					  <br />
					</td>
				  </tr>
				</table>
<?
	return;
}

//////////////////////////////
// if no action list the users
//////////////////////////////
if($Ext_action=="")
{
	echo '					  <a href="index.php?page=user_admin&action=new_user">Add a new user</a>';
	echo "\n";
	// List all the users 
	$query = "SELECT UserName,Password FROM user_profile WHERE 1 order by UserName asc";
    $result = @mysqli_query($db,$query);
	if(!$result)
	{
		echo "SQL Error - ".mysql_error($db);
		return;
	}
	$NrUsers = mysqli_num_rows($result);
?>
					  <br />
					  <br />
					  <div align="center">Number of Users: <? echo $NrUsers; ?></div>
					  <br />
					  <br />
					  <table align="center" width="90%" cellspacing="0" cellpadding="2" border="0">
<?
	while ($row = mysqli_fetch_assoc($result)) 
	{
?>
						<tr>
						  <td width="90%"><strong><? echo $row[UserName]; ?></strong></td>
						  <td><a href="index.php?page=user_admin&action=edit&name=<? echo $row[UserName] ?>">Edit</a>&nbsp;|&nbsp;</td>
						  <td><a href="index.php?page=user_admin&action=del&name=<? echo $row[UserName] ?>">Delete</a></td>
						</tr>
<?
	}
	echo "					  </table>";
}

///////////////////////////////////////////////////
// if action edit user show the form with user data
// and make th edit if it submited it
///////////////////////////////////////////////////
if($Ext_action=="edit")
{

	// form submited we make the update
	if($_POST['edituser']=="yes")
	{
?>
					  <div align="center">
					    <br />
						<br />
<?
		if($_POST['UserName']!=""&&$_POST['Password']!="")
		{
		
			$query = "UPDATE user_profile SET UserName='$_POST[UserName]',Password='$_POST[Password]',Email='$_POST[Email]' WHERE UserName='$_POST[UserName]'";
		    $result=@mysqli_query($db,$query);
			if(!$result)
			{
				echo "						SQL Error - " . mysqli_error($db);
			}
			echo "						User successfully updated.";
		}
		else
		{
			echo "						Error it miss somes information.";
		}
?>
					  </div>
					  <br />
					  <br />
					</td>
				  </tr>
				</table>		
<?
		return;
	}

	// edit user form
	if($query = "SELECT UserName,Password,Email FROM user_profile WHERE UserName='$name' order by UserName asc")
    $result = @mysqli_query($db,$query);
	if(!$result)
	{
		echo "SQL Error - ".mysqli_error();
		return;
	}
	$row = mysqli_fetch_assoc($result);
?>
					  <div align="center">
					    <br />
						<strong>Edit user "<? echo $row['UserName'] ?>"'s information</strong>
						<br />
						<br />
					  </div>
	
					  <form action="index.php?page=user_admin&action=edit" method="post" name="edituser">
						<input type="hidden" name="edituser" value="yes">
						<br />
						<input type="hidden" name="UserName" value="<? echo $row['UserName'] ?>">
						<br />
						<input type="text" name="Password" value="<? echo $row['Password'] ?>">&nbsp;&nbsp;Password
						<br />
						<input type="text" name="Email" value="<? echo $row['Email'] ?>">&nbsp;&nbsp;E-Mail
						<br />
						<input type="submit" value="Edit user">
					  </form>
<?
}

///////////////////////////////////////////////////
// if action delete we delete the user, one might
// add some confirmation box on this
///////////////////////////////////////////////////
if($Ext_action=="del")
{
	// DELETE user
	if($query = "DELETE FROM user_profile WHERE UserName='$name'")
    $result = @mysqli_query($db,$query);
	if(!$result){
		echo "SQL Error - ".mysqli_error();
		return;
	}
?>
					  <div align="center">
						<br />
						<br />
						User deleted.
					  </div>
					  <br />
					  <br />
					</td>
				  </tr>
				</table>
<?
	return;
}


///////////////////////////////////////////////////
// if action is new user we show the form and process
// the data if they were submited.
///////////////////////////////////////////////////
if($Ext_action=="new_user")
{

	// form submited we make the update
	if($_POST['adduser']=="yes")
	{
		// check if it exist already
		if($query = "SELECT UserName FROM user_profile WHERE UserName='$_POST[UserName]' order by UserName asc")
	    $result=@mysqli_query($db,$query);if(!$result){echo "SQL Error - ".mysqli_error();return;}
		$NrUsers=mysqli_num_rows($result);
		if($NrUsers>0)
		{
?>
					  <div align="center">
					    <br />
						<br />
						Error this user exist already.
					  </div>
					  <br />
					  <br />
					</td>
				  </tr>
				</table>
<?
			return;
		}
		else if($_POST['UserName']==""||$_POST['Password']=="")
		{
?>
					  <div align="center">
					    <br />
						<br />
						Error missing username or password.
					  </div>
					  <br />
					  <br />
					</td>
				  </tr>
				</table>
<?
			return;
		}
		else
		{
				
			$query = "INSERT INTO user_profile (id,UserName,Password,Email) VALUES('','$_POST[UserName]','$_POST[Password]','$_POST[Email]')";
		    $result = @mysqli_query($db,$query);
			if(!$result)
			{
				echo "SQL Error - ".mysqli_error();
				return;
			}
?>
					  <div align="center">
					    <br />
						<br />
						User successfully added.
					  </div>
					  <br />
					  <br />
					</td>
				  </tr>
				</table>
<?
			return;
		
		}
	}
?>
					  <div align="center">
					    <br />
						<br />
						<strong>Add new user</strong>
						<br />
						<br />
					  </div>
					  <form action="index.php?page=user_admin&action=new_user" method="post" name="new_user">
						<input type="hidden" name="adduser" value="yes"><br />
						<input type="text" name="UserName" value="<? echo $UserName ?>">&nbsp;&nbsp;User Name<br />
						<input type="text" name="Password" value="<? echo $Password ?>">&nbsp;&nbsp;Password<br />
						<input type="text" name="Email" value="<? echo $Email ?>">&nbsp;&nbsp;E-Mail (not required)<br />
						<input type="submit" value="Add user">
					  </form>
<?
}
?>
					</td>
				  </tr>
				</table>
