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

if (!isset($_COOKIE['currProblem'])) 
	echo "Error, cannot select problem";
else
	$probNum=$_COOKIE['currProblem']; 
	
if (! isset($_COOKIE['currChainSolve'])) 
	echo "No chain selected.";
else
{
	$currChainSolve=$_COOKIE['currChainSolve'];
	
	$query1="SELECT * FROM chains WHERE chainID='$currChainSolve'";
	$result1=mysql_query($query1,$db_server);
	$row=mysql_fetch_row($result1);
	$chainTitle=$row[1];
	
	$query="SELECT * FROM problems WHERE chainID='$currChainSolve' AND probNum='$probNum'";
	$result=mysql_query($query,$db_server);
	$problem=mysql_fetch_row($result);
}

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
	
	<script type="text/x-mathjax-config">
  MathJax.Hub.Config({
	tex2jax: {
	  inlineMath: [['$','$'], ['\\(','\\)']],
	  processEscapes: true
	}
});
</script>

<script type="text/javascript"
  src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
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
<h1> <?php echo "$chainTitle: <span style='color: white'>$probNum. <i>$problem[2]</i> </span>"?></h1>
</section>

<div class="problem">
<?php echo "$problem[3]"; ?>
</div>

<div class="problem">
<?php echo "$problem[4]"; ?>
</div>






<footer>
          <br><br>
          <p style="float: right">&copy; Copyright 2013 <span style="color: #FF7400;"> Gausschain</p>
          <p style="float: left;">Founded by <span style="color: #FF7400;"> Brevin Wankine </span> </p>
</footer>

</body>

</html>

