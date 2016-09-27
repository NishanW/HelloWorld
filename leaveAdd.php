<?php

  session_start();
  require('header.php');             //include_once('header.php')
  
?>
<?php
	if(!isset($_SESSION['referer']))
	{
		header("Location:index.php");
		exit;
	}
	
	if(!($_SESSION['referer']=="leaveAddS"))
	{
		header("Location:home.php");
		exit;
	}
	
	$_SESSION['referer']="leaveAdd";
?>
<html>
<body>
	<h3>New Leave Request</h3>
	<?php
	$staffNo=$_SESSION['staffNo'];
	$startDate=$_POST['startDate'];
	$endDate=$_POST['endDate'];
	$numDays=$_POST['numDays'];
	$relief1=$_POST['relief1'];
	$relief2=$_POST['relief2'];
	
	if (!$startDate|| !$endDate || !$numDays || !$relief1)
	{
		echo "You need to enter all details";
		exit;
	}
		
	if (!get_magic_quotes_gpc())
	{
		$staffNo= addslashes($staffNo);
		$startDate= addslashes($startDate);
		$endDate = addslashes($endDate);
		$numDays= addslashes($numDays);
		$relief1 = addslashes($relief1);
		$relief2 = addslashes($relief2);
	}
	
	$db_server = mysql_connect('localhost', 'general',"123123");
      if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());
      mysql_select_db('ccl', $db_server)
      or die("Unable to select database: " . mysql_error());
	
	$query = "INSERT INTO leavedata (staffNo, dateApply, dateFrom, dateTo, numDays) VALUES ('$staffNo', CURDATE(), '$startDate', '$endDate', '$numDays')";
	
	$result = mysql_query($query);
	if (!$result) die ("Database access failed: " . mysql_error());
		
	if($result)
	{
		$leaveId = mysql_insert_id();
		$query2 = "INSERT INTO relief(staffNo, leaveRef) VALUES ($relief1, $leaveId)";
		$result2 = mysql_query($query2);
		$relId1 = mysql_insert_id();
		$query3 = "INSERT INTO relief(staffNo, leaveRef) VALUES ($relief2, $leaveId)";
		$result3 = mysql_query($query3);
		$relId2 = mysql_insert_id();
		
		echo 'Record successfully inserted into database<br/>';
		echo "<table>";
		echo "<tr>";
		echo "<td>Leave ID : $leaveId</td>";
		echo "<td>Relief-1 ID : $relId1</td>";
		echo "<td>Relief-2 ID : $relId2</td>";
		echo "</tr>";
		echo "</table>";
		echo '<a href="staffAddS.php">Add another</a><br/>';
		echo '<a href="home.php">Back to home</a><br/>';
	}
	
	mysql_close($db_server);
	?>
</body>
</html>