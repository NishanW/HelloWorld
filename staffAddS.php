
<?php
			/*header('Expires:Sun, 01 Jan 2014 00:00:00 GMT');*/
			/*header("Last-Modified: ".gmdate("D, d M Y H:i:s")." ????*/
			header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
			header("Cache-Control: post-check=0, pre-check=0", false);
			header("Pragma: no-cache");
			
		?>
<?php

  session_start();
  require('header.php') ;    //include_once('header.php')
 
?>
<?php
	if(!isset($_SESSION['referer']))
	{
		header("Location:index.php");
		exit;
	}
	
	if(!($_SESSION['referer']=="admin"))
	{
		header("Location:home.php");
		exit;
	}
	
	$_SESSION['referer']="staffAddS";
?>
<html>
<body>
	<h3>Add New Staff</h3>
	<form id="form1" action="staffAdd.php" method="post">
		<table>
			<tr>
				<td>Staff Name</td>
				<td><input type="text" name='staffName' maxlength="20" size="20"></td>
			</tr>
			<tr>
				<td>Staff ID</td>
				<td><input type="text" name='staffId' maxlength="4" size="20"></td>
			</tr>
			<tr>
				<td>Calling Name</td>
				<td><input type="text" name="callName" maxlength="20" size="20"></td>
			</tr>
			<tr>
				<td>User ID</td>
				<td><input type="text" name="uid" maxlength="20" size="20"></td>
			</tr>
			<tr>
				<td>User Role</td>
				<td><input type="text" name="role" maxlength="1" size="20"></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type="password" name="pwd" id="pwd" maxlength="8" size="20"></td>
			</tr>
			<tr>
				<td>Verify Password</td>
				<td><input type="password" name="pwd" id="v_pwd" maxlength="8" size="20"></td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" value="Save"></td>
			</tr>
		</table>
	</form>
<script src="leaveScripts.js"></script>
</body>
</html>