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
	
if (! isset($_COOKIE['currChainSolve'])) 
	echo "No chain selected.";
else
{
	$chainID=$_COOKIE['currChainSolve'];
	$query="SELECT * FROM chains WHERE chainID='$chainID'";
	$result=mysql_query($query,$db_server);
	$row=mysql_fetch_row($result);
	$chainTitle=$row[1];
}
	
	
?>

<html>
<head>	
	<link rel="stylesheet" href="default.css">
	<title>Gausschain</title>
	<script>
	function select(number)
	{
		document.cookie='currProblem=' + number + '; expires=time()+3600*24; path=/'
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
<h1> <?php echo $chainTitle; ?> </h1>

<table>
	<tr>
		<th>#</th>
		<th class="title">Title</th>
		<th>Solves</th>
	</tr>
	
<?php 

	$query="SELECT * FROM problems WHERE chainID='$chainID' ORDER BY probNum ASC";
	if (!mysql_query($query,$db_server)) echo "fail";
	else
	{
		$result=mysql_query($query,$db_server);
		$rows=mysql_num_rows($result);
	}
	
	for ($j=0; $j<$rows; $j++)
	{
		$problem=mysql_fetch_row($result);
		$number=$problem[1];
		$title=$problem[2];
		$solves=$problem[6];
		$extra='';
		if ($j%2==0)
			$extra=' class="even"';
					
		echo <<<_END

		<tr $extra>
			<td class="num">$number</td>
			<td class="words"><a href="problem.php" onclick=select("$number")><span style="color: #FF7400">$title</span></a></td>
			<td class="num">$solves</td>
		</tr>
_END;

	}
?>
</table>



</section>


</body>
</html>
