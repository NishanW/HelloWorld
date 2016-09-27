<?php

  session_start();
  require('header.php')             //include_once('header.php')
  
?>

<html>
<body>

<?php
      //require_once 'login.php';
	  
	  $staff=$_GET['staff'];
	  
      $db_server = mysql_connect('localhost', 'general',"123123");
      if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());
      mysql_select_db('ccl', $db_server)
      or die("Unable to select database: " . mysql_error());

      
$query = "SELECT * FROM users WHERE staffNo='$staff'";
$result = mysql_query($query);
if (!$result) die ("Database access failed: " . mysql_error());
$rows = mysql_num_rows($result);
$row = mysql_fetch_row($result);

echo "<table border=1 cellspacing=0 align='middle'>";
echo "<tr>";
echo "<th align='left' width='50'>NAME</th>";
echo "<td>$row[0]</td>";
echo "</tr>";
echo "<tr>";
echo "<th align='left' width='120'>USER ID</th>";
echo "<td>$row[1]</td>";
echo "</tr>";
echo "<tr>";
echo "<th align='left' width='200'>CALLING NAME</th>";
echo "<td>$row[2]</td>";
echo "</tr>";
echo "<tr>";
echo "<th align='left' width='50'>STAFF ID</th>";
echo "<td>$row[4]</td>";
echo "</tr>";

echo "</table>";
mysql_close($db_server);
?>
    
</body>
</html>