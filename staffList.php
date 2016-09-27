<?php

  session_start();
  require('header.php');           //include_once('header.php')
  
?>
<?php
	if(!isset($_SESSION['referer']))
	{
		header("Location:index.php");
		exit;
	}
	
	if(!($_SESSION['referer']=="home" || $_SESSION['referer']=="admin"))
	{
		header("Location:home.php");
		exit;
	}
	
	$_SESSION['referer']="staffList";
?>

<html>
<body>
<div style="width:100%;height:100%; text-align:center;">
<?php
	echo '<div style="width:100%;height:200px; text-align:center;">';
	echo '<div style="width:600px;height:150px; margin:20px;">';
	echo "<a href='home.php'><img src='images/home.png' alt='Back to Home'></a>";			
	echo '</div>';
	echo '</div>';

	if (isset($_SESSION['user']))
		{
      //require_once 'login.php';
      $db_server = mysql_connect('localhost', 'general',"123123");
      if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());
      mysql_select_db('ccl', $db_server)
      or die("Unable to select database: " . mysql_error());

      
$query = "SELECT name, staffNo FROM users";
$result = mysql_query($query);
if (!$result) die ("Database access failed: " . mysql_error());
$rows = mysql_num_rows($result);

echo "<TABLE border=1 cellspacing=0 align='middle'>";
echo "<TR>";
echo "<TH align='left' width='50'>STAFF NO</TH>";
echo "<TH align='left' width='120'>NAME</TH>";
echo "</TR>";

for ($j = 0 ; $j < $rows ; ++$j)
{
$row = mysql_fetch_row($result);


echo "<tr>";
echo "<td><a href='staffDetail.php?staff=$row[1]'>$row[1]</a></td>";
echo "<td>$row[0]</td>";
echo "</tr>";

}

echo "</table>";
mysql_close($db_server);
}
?>
   </div>
</body>
</html>