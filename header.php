<html>
<head>
	<title>Seylan Bank</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<META HTTP-EQUIV="Pragma" CONTENT="no-cache" />
	<META HTTP-EQUIV="expires" CONTENT="0"/>
	<!--<meta http-equiv="expires" content="Sun, 01 Jan 2014 00:00:00: GMT" />
	<meta http-equiv="cache-control" content="no-cache" />
	<meta http-equiv="expires" content="-1" />
	<meta http-equiv="pragma" content="no-cache" />-->

	<script  language="javascript" src="scripts/jquery-1.11.2.min.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="css/styles.css" />
	
	<?php
		//header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
		//header("Cache-Control: post-check=0, pre-check=0", false);
		//header("Pragma: no-cache");
		/*header('Expires:Sun, 01 Jan 2014 00:00:00 GMT');*/
		/*header("Last-Modified: ".gmdate("D, d M Y H:i:s")." ????*/
	?>

	<div id="topNavBar">
		<div id="navBarItem" style="text-align:left;padding:3px;">
			<img src="images/logo.gif" style="vertical-align:middle;"/>
		</div>
		<div id="navBarItem" style="float:right;">
			<div style="width:200px; height:20px; float:right;padding:5px;">
				<?php
					echo "<p>Hello ".$_SESSION['uname']." welcome back!</p>";
				?>
			</div>
			<div style="width:200px; float:right;">
				<a href='logout.php'><img src="images/logout.jpg"></a>
			</div>
		</div>
	</div>
</head>
</html>