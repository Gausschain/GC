<?php

require_once 'login.php';

$db_server=mysql_connect($db_hostname,$db_username, $db_password);

if (!$db_server)
  die("Unable to connect to server.");

mysql_select_db($db_database)
	or die("Unable to select database.");
	
$username="";
	
if (! isset($_COOKIE['username'])) echo "You must be logged in to build a chain.";
else { $username=$_COOKIE['username'];  }


if (! isset($_COOKIE['currChain'])) echo "There was an error.  I don't know which problem you are trying to edit.";
else
{
	$currChain=$_COOKIE['currChain'];
	$query="SELECT * FROM chains WHERE chainID='$currChain'";
	$result=mysql_query($query,$db_server);
	$chain=mysql_fetch_row($result);
	
}

if ( isset($_POST['number']) )
{
	$chainID=$currChain;
	$probNum=mysql_real_escape_string($_POST['number']);
	$title=mysql_real_escape_string($_POST['title']);
	$expos=mysql_real_escape_string($_POST['expos']);
	$statement=mysql_real_escape_string($_POST['statement']);
	$answer=mysql_real_escape_string($_POST['answer']);
	$numSolves="0";
	
	$query="INSERT INTO problems VALUES ('$chainID','$probNum','$title','$expos','$statement','$answer','$numSolves')";
	if (!mysql_query($query,$db_server)) echo "failed to create new problem";
	else
		echo "You have successfully created a new problem.  Return to the BUILD section to continue.";
} 














?>


<html>
<head>
	<link rel="stylesheet" type="text/css" href="default.css">
	<title>Gausschain</title>
</head>

<body>
 <div id="banner">

  GAUSSCHAIN
  
 </div>




<ul id="contents">
  <li class="top"> <a href="home.php" style="text-decoration: none"> Home </a> </li>
  <li class="top"> <a href="solve.php"> Solve </a>  </li>
  <li class="top"> <a href="build.php"> <span style="color: #FF7400";> Build </span> </a></li>
  <li class="top"> <a href="ranks.php" style="text-decoration: none"> Ranks </a> </li>
  <li class="top"> Forum </li>
</ul>

<section>

<h1><?php echo "$chain[1]: New Problem" ?></h1>

Note: In order to begin a new line in the middle of your exposition or problem statement, you must type "&ltbr/&gt".  <br/>Aside from this, standard Latex works. </br></br>
<form method="post" action="newProblem.php">
<pre>
Problem Number     <input type="text" name="number" maxlength="3" size="3"/> <br/>
Problem Title      <input type="text" name="title" maxlength="30" size="30"/> <br/>
<label>Exposition</label>         <textarea name="expos" cols="80" rows="10" maxlength="2000"></textarea> <br/>
<label>Problem Statement</label>  <textarea name="statement" cols="80" rows="5" maxlength="1000"></textarea> <br/>
Answer             <input type="text" name="answer" maxlength="10" size="10"/> <br/>
                   <input type="submit" name="submitProb" value="Save"/>
</pre>
</form>


</section>

</body>

</html>

