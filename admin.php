<?php
  session_start();
  require('header.php')             //include_once('header.php')
?>
<?php
	echo '<div style="width:100%;height:200px; text-align:center;">';
	echo '<div style="width:600px;height:150px; margin:20px;">';

	if(!isset($_SESSION['referer']))
	{
		header("Location:index.php");
		exit;
	}
	
	if(!($_SESSION['referer']=="home"))
	{
		header("Location:home.php");
		exit;
	}
	
	$_SESSION['referer']="admin";
?>
<html>
<body>
	<?php
		if (isset($_SESSION['user']))
		{
			echo "<a href='leaveView.php'><img src='images/home.png' alt='Back to Home'></a>";
			echo "<a href='staffList.php'><img src='images/staff.png' alt='Staff List'></a>";
			echo "<a href='staffAddS.php'>New Staff Member</a>";
		}
			
		echo '</div>';
		echo '</div>';
	?>
</body>
</html>