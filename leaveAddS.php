<?php
			header('Expires:Sun, 01 Jan 2014 00:00:00 GMT');
			header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
			header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
			header("Cache-Control: post-check=0, pre-check=0", false);
			header("Pragma: no-cache");
		?>
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
	
	if(!($_SESSION['referer']=="home"))
	{
		header("Location:home.php");
		exit;
	}
	
	$_SESSION['referer']="leaveAddS";
?>

<html>
<body>
<div style="width:100%;height:200px; text-align:center;">
		<div style="width:600px;height:150px; margin:20px;">
		<a href='leaveView.php'><img src='images/home.png' alt='Back to Home'></a>
	</div>
	</div>

	<div style="width:100%;height:100%; text-align:center;">
<script language="javascript" type="text/javascript" src="scripts/datetimepicker.js"></script>
<div id="main">
	<h3>New Leave Request</h3>
	<form action="leaveAdd.php" method="post">
		<table>
			<tr>
				<td>From</td>
				<td><input id="startDate" type="text" name="startDate"    size="14">
						<a href="javascript:NewCal('startDate','ddmmyyyy')">
						<img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a>
				</td>	
			</tr>
			<tr>
				<td>To</td>
				<td><input id="endDate" type="text" name="endDate"    size="14">
						<a href="javascript:NewCal('endDate','ddmmyyyy')">
						<img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a>
				</td>	
			</tr>
			<tr>
				<td>No of Days</td>
				<td><input type="text" name="numDays" maxlength="2" size="10"></td>
			</tr>
			<tr>
				<td>Relief 1</td>
				<td><input type="text" name="relief1" maxlength="4" size="10"></td>
				<tr>
				<td>Relief 2</td>
				<td><input type="text" name="relief2" maxlength="4" size="10"></td>
			</tr>
			<tr>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" value="Save"></td>
			</tr>
		</table>
	</div>
	</form>

	</script>
<script language="javascript">
	function addDate()
	{
		date = new Date();
		var month = date.getMonth()+1;
		var day = date.getDate();
		var year = date.getFullYear();
		var ddt  = (day + '-' + month + '-' + year);
		//var ddt  = now.format("dd-mmm-yy");;
		 
		if (document.getElementById('demo1').value =='')
		{
			document.getElementById('demo1').value = ddt;
			//document.getElementById('demo1').value = dateFormat(date, "dddd, mmmm dS, yyyy, h:MM:ss TT");
			//document.getElementById("submit").focus();
			 //document.forms["myform"].submit();
		}
	}
	//document.forms["myform"].submit();
	 
	 
	//<body  onload="setFocus()">
</script> 
	</div>
</body>
</html>