<?php

	session_start();
	require('header.php');           //include_once('header.php')
	require('db_fns.php'); 
  
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
	
	$_SESSION['referer']="leaveView";
?>
<!------------------------------------------------------------------------------------------------>


<html>
<body>
	<div style="width:100%;height:100%; text-align:center;">
		<div style="width:100%;height:200px; text-align:center;">
			<div style="width:600px;height:150px; margin:20px;">
				<a href='leaveView.php'><img src='images/home.png' alt='Back to Home'></a>
			</div>
		</div>
		<?php
			displayMyApprovedLeave();
			displayMyLeavePendingApproval();
		?>
	</div>
</body>
</html>
<!------------------------------------------------------------------------------------------------>


<?php
	function displayMyApprovedLeave()
	{
		$result = getMyApprovedLeave($_SESSION['user']);
		$rows = mysql_num_rows($result);
					
		echo "<h3>MY APPROVED LEAVE</h3>";
		echo "<table cellspacing=0 align='middle'>";
		echo "<tr>";
		echo "<th align='left' width='120'>APPLIED ON</th>";
		echo "<th align='left' width='120'>LEAVE FROM</th>";
		echo "<th align='left' width='120'>LEAVE TO </th>";
		echo "<th align='left' width='420'>NO OF DAYS</th>";
		echo "</th>";

		if ($rows > 0)
		{
			for ($j = 0 ; $j < $rows ; ++$j)
			{
				$row = mysql_fetch_assoc($result);
				echo "<tr>";
				echo "<td>".$row['dateApply']."</td>";
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
			echo "<td colspan='4' style='background:#e0ffff;'>You don't have approved leave days remaining</td>";
			echo "</tr>";
			echo "</table>";
		}
	}
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------		
			
		
	function displayMyLeavePendingApproval()
	{
			
		$result = getMyLeavePendingApproval($_SESSION['user']);
		$rows = mysql_num_rows($result);
			
		echo "<h3>MY LEAVE REQUESTS PENDING APPROVAL</h3>";
		echo "<TABLE cellspacing=0 align='middle'>";
		echo "<TR>";
		echo "<TH align='left' width='120'>APPLIED ON</TH>";
		echo "<TH align='left' width='120'>LEAVE FROM</TH>";
		echo "<TH align='left' width='120'>LEAVE TO </TH>";
		echo "<TH align='left' width='120'>NO OF DAYS</TH>";
		echo "<TH align='left' width='150'>RELIEF 1</TH>";
		echo "<TH align='left' width='150'>RELIEF 2</TH>";
		echo "</TR>";
		
		$rows = mysql_num_rows($result);
		
		if ($rows == 0)
		{
			echo "<tr>";
			echo "<td colspan='6' style='background:#e0ffff;'>You haven't applied for any leave lately</td>";
			echo "</tr>";
		}
		
		if ($rows == 1)
		{
			$row  = mysql_fetch_assoc($result);
			genPendingStaffLeaveGrid ($row,"", 0);
		}

		if ($rows > 1)
		{
			$i=0;
			$j=0;
		
			while ($j < $rows)
			{
				$row  = mysql_fetch_assoc($result);
				$rownext = mysql_fetch_assoc($result);
				if($row['leaveRef'] == $rownext['leaveRef'])
				{
					genPendingStaffLeaveGrid ($row, $rownext, $i);
					$j = $j + 2;
					$i++;
				}
				else
				{
					mysql_data_seek($result,$j);
					$row  = mysql_fetch_assoc($result);
					genPendingStaffLeaveGrid ($row, "", $i);
					$j++;
				}
			}
		}
		echo "</table>";	
	}
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	
	
	function genPendingStaffLeaveGrid ($row, $rownext, $rowId)
	{
		if ($rowId%2==1)
		{
			echo "<tr style='background:#c1f0f6;color:black;'>";
		}
		else
		{
			echo"<tr class='datarow'>";
		}
		echo "<td>".$row['dateApply']."</td>";
		//echo "<td>".$row['requestor']."</td>";
		echo "<td>".$row['dateFrom']."</td>";
		echo "<td>".$row['dateTo']."</td>";
		echo "<td>".$row['numDays']."</td>";
			
		if($row['agree'] == "N")
		{
			echo "<td><img src='images/orange.jpg' alt='Yet to Agree'> ".$row['cname']." (".$row['relStaffNo'].")</td>";
		}
		else
		{
			echo "<td><img src='images/green.jpg' alt='Agreed'> ".$row['cname']." (".$row['relStaffNo'].")</td>";
		}
			
		if($rownext=="")
		{
			echo "<td></td>";
		}

		if($rownext!="")
		{
			if($rownext['agree'] == 'N')
			{
				echo "<td><img src='images/orange.jpg' alt='Yet to Agree'> ".$rownext['cname']." (".$rownext['relStaffNo'].")</td>";
			}
			else
			{
				echo "<td><img src='images/green.jpg' alt='Agreed'> ".$rownext['cname']." (".$rownext['relStaffNo'].")</td>";
			}
		}
				
		//echo "<td><a href='leaveApprove.php?staffNo=$_SESSION[staffNo] & leaveRef=".$row['leaveRef']."'>Approve</a></td>";
		echo "</tr>";
	}
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
?>