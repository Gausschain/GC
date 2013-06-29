<?php

require_once 'login.php';

$db_server=mysql_connect($db_hostname,$db_username, $db_password);

if (!$db_server)
  die("Unable to connect to server.");

mysql_select_db($db_database)
	or die("Unable to select database.");
	
$username="";
if (! isset($_COOKIE['username'])) echo "You must be logged in to build a chain.";
else $username=$_COOKIE['username'];

$query="SELECT * FROM chains WHERE author='$username'";
$result=mysql_query($query,$db_server);
$rows=mysql_num_rows($result);

?>


<html>
<head>
	<link rel="stylesheet" type="text/css" href="default.css">
	<title>Gausschain</title>
	
	<script>
		function select(chainID)
		{
			document.cookie='currChain=' + chainID + '; expires=time()+3600*24; path=/'
		}	
	</script>
	
</head>

<body>
 <div id="banner">

  GAUSSCHAIN
  
 </div>




<ul id="contents">
  <li class="top"> <a href="home.php" style="text-decoration: none"> Home </a> </li>
  <li class="top"> <a href="solve.php"> Solve </a>  </li>
  <li class="top"> <span style="color: #FF7400";> Build </span> </li>
  <li class="top"> <a href="ranks.php" style="text-decoration: none"> Ranks </a> </li>
  <li class="top"> Forum </li>
</ul>

<section>

<h1>MY CHAINS</h1>

	<a href="newChain.php"> <span style="font-size: 20px"> BUILD NEW CHAIN </span></a>
	<br/><br/>

<?php 
	$query = "SELECT * FROM chains WHERE author='$username'";
	$result = mysql_query($query,$db_server);
	$rows = mysql_num_rows($result);

for ($j=0; $j < $rows; $j++)
{
	$row=mysql_fetch_row($result);
	$title=$row[1];
	$id=$row[0];
	
	echo <<<_END
	
	<div class="box">
		<a href="editChain.php" onclick=select("$id")> <span style="color: #FF7400"> $title </span> </a>
	</div>
	
	
	
_END;

}

?>

</section>


</body>

</html>

