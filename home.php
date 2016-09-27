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
	
	$_SESSION['referer']="home";
?>
<html>
<body>
	<div style="width:100%;height:100%; text-align:center;">
	
	<?php
		
		echo '<div style="width:100%;height:200px; text-align:center;">';
		echo '<div style="width:600px;height:150px; margin:20px;">';
		
		if (isset($_SESSION['user']) && isset($_SESSION['role']))
		{
			if($_SESSION['role']=='A')
			{
				echo "<a href='admin.php'><img src='images/admin.png' alt='Sys Admin'></a>";
			}
			
			if($_SESSION['role']=='M')
			{
				echo "<a href='staffList.php'><img src='images/staff.png' alt='Staff List'></a>";
				echo "<a href='leaveApproveS.php'><img src='images/approve.png' alt='Approve Leave'></a>";
			}
		
		
		
		
			echo "<a href='leaveAddS.php'><img src='images/leaveInput.png' alt='Request Leave'></a>";
			echo "<a href='leaveView.php'><img src='images/view.png' alt='View Status'></a>";
			
			echo '</div>';
			echo '</div>';
		
		
			$db_server = mysql_connect('localhost', 'general',"123123");
			if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());
			mysql_select_db('ccl', $db_server)
			or die("Unable to select database: " . mysql_error());
		
      
			$query = "SELECT users.cname, L. * FROM users INNER JOIN (SELECT leavedata. * , relief.leaveRef AS relLeaveRef
							FROM relief INNER JOIN leavedata ON relief.leaveRef = leavedata.leaveRef
							WHERE relief.staffNo = '$_SESSION[staffNo]' AND relief.agree = 'N') AS L ON users.staffNo = L.StaffNo";

			$result = mysql_query($query);
			if (!$result) die ("Database access failed: " . mysql_error());
			$rows = mysql_num_rows($result);
			
			echo "<h3>RELIEF REQUESTS</h3>";
				echo "<TABLE cellspacing=0 align='middle'>";
				echo "<TR>";
				echo "<TH align='left' width='120'>DATE</TH>";
				echo "<TH align='left' width='120'>REQUESTED BY</TH>";
				echo "<TH align='left' width='120'>FROM</TH>";
				echo "<TH align='left' width='120'>TO </TH>";
				echo "<TH align='left' width='120'>NO OF DAYS</TH>";
				echo "<TH align='left' width='120'>&nbsp</TH>";
				echo "</TR>";
				
			if ($rows > 0)
			{
				for ($j = 0 ; $j < $rows ; ++$j)
				{
					$row = mysql_fetch_assoc($result);
					if ($j%2==1)
					{
						echo "<tr style='background:98f5ff;color:black;'>";
					}
					else
					{
						echo "<tr style='background:#e0ffff;color:black;'>"; /*#8beff7*/
					}
					/*echo "<td><a href='staffDetail.php?staff=$row[1]'>$row[1]</a></td>";*/
					echo "<td>".$row['dateApply']."</td>";
					echo "<td>".$row['cname']."</td>";
					echo "<td>".$row['dateFrom']."</td>";
					echo "<td>".$row['dateTo']."</td>";
					echo "<td>".$row['numDays']."</td>";		
					echo "<td><a href='leaveAgree.php?staffNo=$_SESSION[staffNo] & leaveRef=".$row['leaveRef']."'><img src='images/green.jpg' alt='Agree'></a></td>";
					
					echo "</tr>";
				}
				echo "</table>";
			}
			else
			{
				echo "<tr>";
				echo "<td colspan='6' style='background:#e0ffff;'>Currently there are no more relief requests from your colleagues!</td>";
				echo "</tr>";
				echo "</table>";
			}
			
			$query = "SELECT users.cname, L. * FROM users INNER JOIN (SELECT leavedata. * , relief.leaveRef AS relLeaveRef
							FROM relief INNER JOIN leavedata ON relief.leaveRef = leavedata.leaveRef
							WHERE relief.staffNo = '$_SESSION[staffNo]' AND relief.agree = 'A') AS L ON users.staffNo = L.StaffNo";

			$result = mysql_query($query);
			if (!$result) die ("Database access failed: " . mysql_error());
			$rows = mysql_num_rows($result);
			
				echo "<h3>MY RELIEF ASSIGNMENTS</h3>";
				echo "<TABLE cellspacing=0 align='middle'>";
				echo "<TR>";
				echo "<TH align='left' width='360'>STANDING FOR</TH>";
				echo "<TH align='left' width='120'>FROM</TH>";
				echo "<TH align='left' width='120'>TO </TH>";
				echo "<TH align='left' width='120'>NO OF DAYS</TH>";
				echo "</TR>";
			
			if ($rows > 0)
			{
				for ($j = 0 ; $j < $rows ; ++$j)
				{
					$row = mysql_fetch_assoc($result);
					if ($j%2==1)
					{
						echo "<tr style='background:98f5ff;color:black;'>";
					}
					else
					{
						/*#8beff7*/
						echo "<tr style='background:#e0ffff;color:black;'>";
					}
					/*echo "<td><a href='staffDetail.php?staff=$row[1]'>$row[1]</a></td>";*/
					echo "<td>".$row['cname']."</td>";
					echo "<td>".$row['dateFrom']."</td>";
					echo "<td>".$row['dateTo']."</td>";
					echo "<td>".$row['numDays']."</td>";			
					echo "</tr>";
				}
				echo "</table>";
			}
			else
			{
				echo "<tr>";
				echo "<td colspan='4' style='background:#e0ffff;'>Hi you don't have pending relief assignments at the moment!</td>";
				echo "</tr>";
				echo "</table>";
			}
			
			mysql_close($db_server);
		}
	?>  
	</div>
</body>
</html>