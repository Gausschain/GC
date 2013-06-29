<?php

require_once 'login.php';

$db_server=mysql_connect($db_hostname,$db_username, $db_password);

if (!$db_server)
  die("Unable to connect to server.");

mysql_select_db($db_database)
	or die("Unable to select database.");
	
$username="";
if (isset($_COOKIE['username']))
	$username=$_COOKIE['username'];

/*
if (! isset($_COOKIE['username'])) echo "You must be logged in to build a chain.";
else $username=$_COOKIE['username'];

$query="SELECT * FROM chains WHERE author='$username'";
$result=mysql_query($query,$db_server);
$rows=mysql_num_rows($result);
*/

?>


<html>
<head>
	<link rel="stylesheet" type="text/css" href="default.css">
	<title>Gausschain</title>
	
	<script>
		function select(chainID)
		{
			document.cookie='currChainSolve=' + chainID + '; expires=time()+3600*24; path=/'
		}	
	</script>
	
</head>

<body>
 <div id="banner">

  GAUSSCHAIN
  
 </div>




<ul id="contents">
  <li class="top"> <a href="home.php" style="text-decoration: none"> Home </a> </li>
  <li class="top"> <span style="color: #FF7400";> Solve </span>  </li>
  <li class="top"> <a href="build.php"> Build </a> </li>
  <li class="top"> <a href="ranks.php" style="text-decoration: none"> Ranks </a> </li>
  <li class="top"> Forum </li>
</ul>

<section>

<?php 
	$query = "SELECT * FROM chains WHERE isLive!='0' ORDER BY rating DESC";
	$result = mysql_query($query,$db_server);
	$rows = mysql_num_rows($result);

for ($j=0; $j < $rows; $j++)
{
	$row=mysql_fetch_row($result);
	$id=$row[0];
	$title=$row[1];
	$author=$row[4];
	
	echo <<<_END
	
	<div class="box">
		<a href="solveChain.php" onclick=select("$id")> <span style="color: #FF7400; font-size: 30px; font-family: Monospace">$title</span> </a><br/>
		$author
	</div>
	
	
	
_END;

}

?>

</section>

<footer>
          <br><br>
          <p style="float: right">&copy; Copyright 2013 <span style="color: #FF7400;"> Gausschain</p>
          <p style="float: left;">Founded by <span style="color: #FF7400;"> Brevin Wankine </span> </p>
</footer>

</body>

</html>

