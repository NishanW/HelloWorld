<?php
	/*function approveLeave ($staffNo, $leaveRef)
	{
	  
			$db_server = mysql_connect('localhost', 'general',"123123");
			if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());
			mysql_select_db('ccl', $db_server)
			or die("Unable to select database: " . mysql_error());

			$query = "UPDATE leavedata SET status='A', approver=$staffNo, approveDate=CURDATE() WHERE leaveRef=$leaveRef";
			$result = mysql_query($query);
			if (!$result) die ("Database access failed: " . mysql_error());
			
			mysqli_close($conn);												/*$conn->close();
			header("Location:leaveApproveS.php"); 
	}*/
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

		
	function getPendingStaffLeaveRequests()
	{
		$query = "SELECT users.cname AS requestor, M. * FROM users 
						INNER JOIN (SELECT users.cname AS relief, L. * FROM users
						INNER JOIN (SELECT leavedata. * , relief.agree, relief.staffNo AS reliefSN FROM relief
						INNER JOIN leavedata ON relief.leaveRef = leavedata.leaveRef
						WHERE leavedata.status = 'P') AS L ON users.staffNo = L.reliefSN) AS M ON users.staffNo = M.staffNo ORDER BY leaveRef";
	
		return getData($query);
	}
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

	
	function getTodayApprovedStaffLeave()
	{
		$query = "SELECT users.cname AS requestor, M. * FROM users 
							INNER JOIN (SELECT users.cname AS relief, L. * FROM users
							INNER JOIN (SELECT leavedata. * , relief.agree, relief.staffNo AS reliefSN FROM relief
							INNER JOIN leavedata ON relief.leaveRef = leavedata.leaveRef
							WHERE leavedata.status = 'A'
								AND leavedata.approveDate = CURDATE()) AS L ON users.staffNo = L.reliefSN) AS M ON users.staffNo = M.staffNo ORDER BY leaveRef";
	
		return getData($query);
	}
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

	
	function getAllApprovedStaffLeave()
	{
		$query = "SELECT users.cname AS requestor, M. * FROM users 
							INNER JOIN (SELECT users.cname AS relief, L. * FROM users
							INNER JOIN (SELECT leavedata. * , relief.agree, relief.staffNo AS reliefSN FROM relief
							INNER JOIN leavedata ON relief.leaveRef = leavedata.leaveRef
							WHERE leavedata.status = 'A') AS L ON users.staffNo = L.reliefSN) AS M ON users.staffNo = M.staffNo ORDER BY leaveRef";
	
		return getData($query);
	}
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

	
	function getMyLeavePendingApproval($user)
	{
		$query = "SELECT users.cname, L.* FROM users
						INNER JOIN (SELECT leavedata . * , relief.staffNo AS relStaffNo, agree FROM leavedata
						INNER JOIN relief ON relief.leaveRef = leavedata.leaveRef
						WHERE leavedata.staffNo = ( SELECT users.staffNo FROM users WHERE uid = '$user' ) 
							AND STATUS = 'P') AS L ON users.staffNo = L.relStaffNo ORDER BY leaveRef";
	
		return getData($query);
	}
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


	function getMyApprovedLeave($user)
	{
		$query = "SELECT * FROM leavedata WHERE staffNo = (SELECT staffNo FROM users WHERE uid = '$user') AND status = 'A'";
		
		return getData($query);
	}
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

	
	function getData ($query)
	{
		$db_server = mysql_connect('localhost', 'general',"123123");
		if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());
		mysql_select_db('ccl', $db_server)
			or die("Unable to select database: " . mysql_error());
	
		$result = mysql_query($query);
				if (!$result) die ("Database access failed: " . mysql_error());
				$rows = mysql_num_rows($result);
		mysql_close($db_server);
			return $result;
	}
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
		
		
?>