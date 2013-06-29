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


if (isset($_POST['title']) && isset($_POST['submitChain']) && ! ( $_POST['title']=="" ) )
{
	$title=mysql_real_escape_string($_POST['title']);
	$description=mysql_real_escape_string($_POST['description']);
	$prereqs=mysql_real_escape_string($_POST['prereqs']);
	
	$query = "INSERT INTO chains (title,description,prereqs,author) VALUES ('$title','$description','$prereqs','$username')"; 

	if (!mysql_query($query, $db_server))
		echo "didn't work";	
	else
		echo "You have successfully created a chain.  Return to the BUILD section to continue.";
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
  <li class="top"> Solve  </li>
  <li class="top"> <a href="build.php"> <span style="color: #FF7400";> Build </span> </a></li>
  <li class="top"> <a href="ranks.php" style="text-decoration: none"> Ranks </a> </li>
  <li class="top"> Forum </li>
</ul>

<section>

<h1>BUILD NEW CHAIN</h1>

<form method="post" action="newChain.php">
<pre>
Chain Title    <input type="text" name="title" maxlength="34" size="34" />
<label>Description</label>    <textarea name="description" cols="27" rows="5" maxlength="500"> </textarea>
<label>Prerequisites</label>  <textarea name="prereqs" cols="27" rows="3" maxlength="250"> </textarea>
               <input type="submit" name="submitChain"/>

</pre>
</form>

</section>

</body>

</html>

