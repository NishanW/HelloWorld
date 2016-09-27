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
	
	if(!($_SESSION['referer']=="staffAddS"))
	{
		header("Location:home.php");
		exit;
	}
	
	$_SESSION['referer']="staffAdd";
?>
<html>
<body>
	<h3>Add New Staff</h3>
	<?php
	$staffName=$_POST['staffName'];
	
	$staffId=$_POST['staffId'];
	$callName=$_POST['callName'];
	$pwd=$_POST['pwd'];
	$uid=$_POST['uid'];
	$role=$_POST['role'];
	
	if (!$staffName || !$staffId || !$callName || !$pwd || !$uid || !$role)
	{
		echo "You need to enter all details";
		exit;
	}
		
	if (!get_magic_quotes_gpc())
	{
		$staffName= addslashes($staffName);
		$staffId = addslashes($staffId);
		$callName = addslashes($callName);
		$pwd = addslashes($pwd);
		$uid = addslashes($uid);
		$role = addslashes($role);
	}
	
	$pwd = sha1($pwd);
	
	$db_server = mysql_connect('localhost', 'general',"123123");
      if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());
      mysql_select_db('ccl', $db_server)
      or die("Unable to select database: " . mysql_error());
	
	$query = "INSERT INTO users(name, staffNo, cname, pwd, uid, role) VALUES ('$staffName', '$staffId', '$callName', '$pwd', '$uid', 'role')";
	
	$result = mysql_query($query);
	if (!$result) die ("Database access failed: " . mysql_error());
		
	if($result)
	{
		echo 'Record successfully inserted into database<br/>';
		echo '<a href="staffAddS.php">Add another</a><br/>';
		echo '<a href="home.php">Back to home</a><br/>';
	}
	
	mysql_close($db_server);
	?>
</body>
</html>