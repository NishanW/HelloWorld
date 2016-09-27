<?php
  @ $name = $_POST['name'];
  @ $pwd = $_POST['pwd'];
  @ $loggedin;

	if(empty($name)||empty($pwd))
	{
		header("location:elogin.php");
	}
	else
	{
		$conn =mysqli_connect("localhost","general","123123","ccl");
		// Check connection
		if (mysqli_connect_errno())
		{
			echo "Failed to connect to the server : ".mysqli_connect_error();
		}

		$pwd = sha1($pwd);

		$query = "SELECT * FROM users WHERE uid='$name' AND pwd='$pwd'";
		$result= mysqli_query($conn, $query);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$count= mysqli_num_rows($result);
    
		if ($count==1)
		{
			session_start();
			$_SESSION ['staffNo'] = $row[staffNo];
			$_SESSION ['user'] = $row[uid];
			$_SESSION ['uname'] = $row[cname];
			$_SESSION ['role'] = $row[role];
			$_SESSION['referer']="login";
			header("location:home.php");
		}
		else
		{
			header("location:xlogin.php");
		}
		mysqli_close($conn);
	}
?>