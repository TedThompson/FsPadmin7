<?php
if(!defined("FSP_ADMIN")) return;
/**
 * left_menu.php  generates the table of links on the left side
 * no dynamic content at present
 *
 */
 
echo '<!-- Begin left_menu.php -->
				<table class="WithTitle" align="center" width="200" cellspacing="2" cellpadding="2" border="0" bgcolor="#4444FF">
				  <tr>
					<td align="center">
					  <strong>Admin Menu</strong>
					</td>
				  </tr>
				</table>
				<table class="TinyFrame" width="200" border="0" cellspacing="2" cellpadding="2" align="center" bgcolor="#FFFFFF">
				  <tr>
					<td align="center" class="Link">
					  <br />
					  <table align="center" cellspacing="2" cellpadding="2" border="0">
						<tr>
						  <td valign="top">
							<a href="index.php">Home</a>
							<br />
							<a href="index.php?page=setting">Edit general settings</a>
							<br />
							<a href="index.php?page=user_admin">User admin</a>
							<br />
							<a href="index.php?action=logout">Logout</a>
							<br />
							<br />
						  </td>
						</tr>
					  </table>
					</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
				  </tr>
				</table>
<!-- End left_menu.php -->
';

?>