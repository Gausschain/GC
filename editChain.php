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

if (! isset($_COOKIE['currChain'])) echo "There was an error.  I don't know which chain you are trying to edit.";
else
{
	$currChain=$_COOKIE['currChain'];
	$query="SELECT * FROM chains WHERE chainID='$currChain'";
	$result=mysql_query($query,$db_server);
	$chain=mysql_fetch_row($result);
	
}

if (isset($_POST['submitChain']))
{
	$query="UPDATE chains SET isLive='1' WHERE chainID='$currChain'";
	if (!mysql_query($query,$db_server)) echo "submission failed";
	else echo "successful submission";
}

/*
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
	function select(number)
	{
		document.cookie='currProb=' + number + '; expires time()+3600*24; path=/'
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

<h1><i>edit</i> <?php echo "$chain[1]"?></h1>

<a href="newProblem.php"> <span style="font-size: 20px"> NEW PROBLEM </span></a>
<br/><br/>

<?php 
$query="SELECT * FROM problems WHERE chainID='$currChain' ORDER BY probNum ASC";
$result=mysql_query($query,$db_server);
$rows=mysql_num_rows($result);

for ($j=0; $j < $rows; $j++)
{
	$problem=mysql_fetch_row($result);
	
	echo <<<_END
	
	<a href="editProblem.php" onclick=select("$problem[1]")>Problem $problem[1] : $problem[2] </a>
	<br/><br/>
	
_END;
}
?>

<form method="post" action="editChain.php">
	<input type="submit" name='submitChain' value='Submit Chain'/>
</form>

</section>


</body>

</html>

