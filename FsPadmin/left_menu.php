<?php
if(!defined("FSP_ADMIN")) return;
# Output table and form
echo '<br><br><br><table class="WithTitle" align="center" width="200" cellspacing="2" cellpadding="2" border="0" bgcolor="#4444FF" ><tr><td align="center">';
echo "<strong>Admin Menu</strong>";
echo '</td></tr></table>';
echo '<table class="TinyFrame" width="200" border="0" cellspacing="2" cellpadding="2" align="center" bgcolor="#FFFFFF">';
echo '<tr><td align="center" class="Link"><br>';
echo '<table align="center" cellspacing="2" cellpadding="2" border="0"><tr><td valign="top">';
echo '<a href="index.php">Home</a><br>';
echo '<a href="index.php?page=setting">Edit general settings</a><br>';
echo '<a href="index.php?page=user_admin">User admin</a><br>';
echo '<a href="index.php?action=logout">Logout</a><br><br>';
echo '</td></tr></table>';
echo "</td></tr><tr></tr>";
echo '</table>';
?>