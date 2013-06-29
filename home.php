<?php 
m
require_once 'login.php';
$db_server=mysql_connect($db_hostname,$db_username, $db_password);

if (!$db_server)
  die("Unable to connect to server.");

mysql_select_db($db_database)
	or die("Unable to select database.");

	
if (isset($_POST['logout']) && isset($_COOKIE['username']))
{
	$currUser=$_COOKIE['username'];
	setcookie('username',$currUser,time()-2592000, '/');
}

if (isset($_POST['username']) && isset($_POST['password']))
{
	$name1=$_POST['username'];
	$pass=$_POST['password'];
	
	$query="SELECT * FROM users WHERE name='$name1'";
	$result=mysql_query($query);
	
	$rows=mysql_num_rows($result);
	
	if ($rows==0);
	
	else if (mysql_result($result,0,'password')==$pass)
	{
		setcookie('username', $name1, time()+3600*24, '/');
		session_start();
		$_SESSION['username']=$name1;
	}
	
}

$username="";

if (isset($_COOKIE['username']))
	$username=$_COOKIE['username'];
	

?>

<!DOCTYPE html>
<head>

	<link rel="stylesheet" type="text/css" href="default.css">
	<title>Gausschain</title>

</head>

<body>
 <div id="banner">

  GAUSSCHAIN
  
 </div>




<ul id="contents">
  <li class="top"> <span style="color: #FF7400";> Home </span> </li>
  <li class="top"> <a href="solve.php"> Solve </a>  </li>
  <li class="top"> <a href="build.php"> Build </a> </li>
  <li class="top"> <a href="ranks.php"> Ranks</a> </li>
  <li class="top"> Forum </li>
</ul>

<?php if (! $username=="") 
{
  echo <<<_END
  <aside id="hub">
  	<p> Hello, $username </p>
  	
  	<form method="post" action="home.php">
  	<p> <input type="submit" name="logout" value="Logout"/> </p>
  	</form>
  
  </aside>
_END;
}
else 
{
  echo <<<_END
  <aside id="login">
  
    <form method="post" action="home.php">
	<p><pre>    Name <input type="text" name="username" /> </pre></p>
	<p>Password <input type="text" name="password" /> </p>
	<p><pre>         <input type="submit" name="sub" value="Login"/> </pre></p>

	</form>
	
  </aside>

  <aside id="register">
    <p>REGISTER</p>
  </aside>
_END;
}
?>

<section> 
		  <br/>
          <!--List containing the "FAQ" -->
          <ul>
            <li><h2 class="question">If I do a Gauss Chain, what will I get?</h2></li>
            <!--<p><img src="images/Gauss_11.jpg" alt="Gauss pic" width=100 height=100></p>-->
            <p> Smarter.  If you don't become as good at math as Gauss, we guarantee your money back (not that we'd take any).
              Ok, to be fair, you probably won't become Gauss. But, who cares? Gauss is dead, and you're not. 
            </p> 
            <li><h2 class="question">Why can't I write a computer program to solve a problem?</h2></li>
            <p> You can. But we think you'll find that, for many problems, the restriction that your solution be found by hand pushes you toward an elegant method that exploits a 
            fundamental pattern. </p>
            
            <p> With technology outlawed you won't need to consider thorny questions of computational complexity, proper syntax, or whether to instantiate long integers after all.  
            We hope this will hasten your journey to the fringes of your creative ability and to the 
            beautiful ideas that make mathematics worthwhile. </p>
            <li><h2 class="question">What happens if I do use technology? </h2></li>
            <p>An excruciatingly painful death will befall you, I'm afraid.</p>
            <li><h2 class="question"> How mathematically mature do I need to be?</h2></li>
            <p>Yes.</p>
            <li><h2 class="question">Why "Chain"?</h2></li>
            <p>The problems within any chain get progressively more challenging.  If you start with the first problem and work your way down, you will gradually accumulate the domain-specific knowledge and general
             problem solving ability required to complete the chain.</p>
            <li><h2 class="question">Why Gauss?</h2></li>
            <p><a href="http://www.projecteuler.net">Euler was taken. </a></p>
            
          </ul>
</section>

<footer>
          <br><br>
          <p style="float: right">&copy; Copyright 2013 <span style="color: #FF7400;"> Gausschain</p>
          <p style="float: left;">Founded by <span style="color: #FF7400;"> Brevin Wankine </span> </p>
</footer>



</body>
</html>
