<?php
  session_start();
  require('header.php');             //include_once('header.php')
  require('db_fns.php'); 
?>

<?php
	if(!isset($_SESSION['referer']) || !isset($_SESSION['user']) || !isset($_SESSION['role']))
	{
		header("Location:index.php");
		exit;
	}
	
	if($_SESSION['role']!='M')
	{
		header("Location:index.php");
		exit;
	}
	
	$_SESSION['referer']="leaveApproveS";
?>
<!------------------------------------------------------------------------------------------------>


<html>
<body>
	<div style="width:100%;height:100%; text-align:center;">
		<div style="width:100%;height:200px; text-align:center;">
			<div style="width:600px;height:150px; margin:20px;">
				<a href="leaveView.php"><img src="images/home.png" alt="Back to Home"></a>
			</div>
		</div>
		
		<?php
			$result = getPendingStaffLeaveRequests();
			displayPendingStaffLeave ($result);
				
			$result2 = getAllApprovedStaffLeave();
			displayApprovedStaffLeave ($result2);
		?>
	</div>
</body>
</html>
<!------------------------------------------------------------------------------------------------>


<?php
	function displayPendingStaffLeave ($result)
	{
		echo "<h3>PENDING STAFF LEAVE REQUESTS</h3>";
		echo "<table cellspacing=0 align='middle'>";
		echo "<tr>";
		echo "<th align='left' width='120'>DATE</th>";
		echo "<th align='left' width='120'>REQUESTED BY</th>";
		echo "<th align='left' width='120'>FROM</th>";
		echo "<th align='left' width='120'>TO </th>";
		echo "<th align='left' width='120'>NO OF DAYS</th>";
		echo "<th align='left' width='120'>RELIEF 1</th>";
		echo "<th align='left' width='120'>RELIEF 2</th>";
		echo "<th align='left' width='120'></th>";
		echo "</tr>";
		
		$rows = mysql_num_rows($result);
		
		if ($rows == 0)
		{
			echo "<tr class='datarow'>";
			echo "<td colspan='8'>No Pending Records to display</td>";
			echo "</td>";
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


	function displayApprovedStaffLeave ($result)
	{
		echo "<h3>APPROVED STAFF LEAVE</h3>";
		echo "<TABLE cellspacing=0 align='middle'>";
		echo "<TR>";
		echo "<TH align='left' width='120'>NAME</TH>";
		echo "<TH align='left' width='120'>FROM</TH>";
		echo "<TH align='left' width='120'>TO </TH>";
		echo "<TH align='left' width='120'>NO OF DAYS</TH>";
		echo "<TH align='left' width='120'>RELIEF 1</TH>";
		echo "<TH align='left' width='120'>RELIEF 2</TH>";
		echo "</TR>";
		
		$rows = mysql_num_rows($result);
		
		if ($rows == 0)
		{
			echo "<tr class='datarow'>";
			echo "<td colspan='6'>No Pending Records to display</td>";
			echo "</td>";
		}
		
		if ($rows == 1)
		{
			$row  = mysql_fetch_assoc($result);
			genApprovedStaffLeaveGrid($row, "",1);
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
					genApprovedStaffLeaveGrid($row, $rownext,$i);
					$j = $j + 2;
					$i++;
				}
				else
				{
					mysql_data_seek($result,$j);
					$row  = mysql_fetch_assoc($result);
					genApprovedStaffLeaveGrid($row, "",1);
					$j++;
					$i++;
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
			echo "<td>".$row['requestor']."</td>";
			echo "<td>".$row['dateFrom']."</td>";
			echo "<td>".$row['dateTo']."</td>";
			echo "<td>".$row['numDays']."</td>";
			
			if($row['agree'] == "N")
			{
				echo "<td><img src='images/orange.jpg' alt='Yet to Agree'> ".$row['relief']." (".$row['reliefSN'].")</td>";
			}
			else
			{
				echo "<td><img src='images/green.jpg' alt='Agreed'> ".$row['relief']." (".$row['reliefSN'].")</td>";
			}
			
			if($rownext=="")
			{
				echo "<td></td>";
			}

			if($rownext!="")
			{
				if($rownext['agree'] == 'N')
				{
					echo "<td><img src='images/orange.jpg' alt='Yet to Agree'> ".$rownext['relief']." (".$rownext['reliefSN'].")</td>";
				}
				else
				{
					echo "<td><img src='images/green.jpg' alt='Agreed'> ".$rownext['relief']." (".$rownext['reliefSN'].")</td>";
				}
			}
				
			echo "<td><a href='leaveApprove.php?staffNo=$_SESSION[staffNo] & leaveRef=".$row['leaveRef']."'>Approve</a></td>";
			echo "</tr>";
	}
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

	
	function genApprovedStaffLeaveGrid ($row, $rownext, $rowId)
		{
			if ($rowId%2==1)
			{
				echo "<tr style='background:#c1f0f6;color:black;'>";
			}
			else
			{
				echo"<tr class='datarow'>";
			}
			echo "<td>".$row['requestor']."</td>";
			echo "<td>".$row['dateFrom']."</td>";
			echo "<td>".$row['dateTo']."</td>";
			echo "<td>".$row['numDays']."</td>";
			
			if($rownext=="")
			{
				echo "<td>".$row['relief']." (".$row['reliefSN'].")</td>";
				echo "<td>--</td>";
			}
			else
			{
				echo "<td>".$row['relief']." (".$row['reliefSN'].")</td>";
				echo "<td>".$rownext['relief']." (".$rownext['reliefSN'].")</td>";
			}
			echo "</tr>";
		}
	?>