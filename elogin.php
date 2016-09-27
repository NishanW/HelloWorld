<?php
  require('loginHeader.php')
?>
<html>
<body>
	<div style="text-align:center; width:100%; height:100%;">
		<div style="width:240px; height:100px;position:relative;top:20%;">
		  <form method="post" action="controller.php">
			  <table style="border:2px solid #cc6645;">
					<tr style="background:#cc6645;color:white;height:15px;text-align:center;"><td colspan="2">LOG IN</td></span></tr>
					<tr><td style="width:100px">Username</td><td><input type="text" name="name"></td></tr>
					<tr><td style="width:100px">Password</td><td><input type="password" name="pwd"></td></tr>
					<tr><td style="width:100px">&nbsp</td><td style="align="center"><input type="submit" value="Log In"></td></tr>
			  </table>
		  </form>
			<p>'Username and Password is required'</p>
	  </div>
	</div>  
</body>
</html>