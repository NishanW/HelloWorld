<?php
  session_start();
  require('header.php')             //include_once('header.php')
?>

<?php
	if(!isset($_SESSION['referer']))
	{
		header("Location:index.php");
		exit;
	}
	
	if(!$_SESSION['referer']=="home")
	{
		header("Location:home.php");
		exit;
	}
?>
  
<?php
	  
	  $staffNo=$_GET['staffNo'];
	   $leaveRef=$_GET['leaveRef'];
	   
			$db_server = mysql_connect('localhost', 'general',"123123");
			if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());
			mysql_select_db('ccl', $db_server)
			or die("Unable to select database: " . mysql_error());

			$query = "UPDATE leavedata SET status='A', approver=$staffNo, approveDate=CURDATE() WHERE leaveRef=$leaveRef";
			$result = mysql_query($query);
			if (!$result) die ("Database access failed: " . mysql_error());
			
			mysqli_close($conn);												/*$conn->close();*/
			header("Location:leaveApproveS.php"); 


?>