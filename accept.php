<html>
<head>
<title>Walk with me</title>

</head>
<body background="headgrass1.jpg">
<center><h1><font color="003300">Walk with Me!</font></h1>
<img src="graphics-walking-132772.gif"/>
</br></br>
<h2><font color='white'>Friends</font></h2>
<?php

$friend= (int)$_POST['fpid'];
$mypid= (int)$_POST['pid'];
$lpw= $_POST['lem'];
print"<p>My pid: $mypid Friend pid: $friend</p>";
$con=mysql_connect("localhost", "root");
if($con)
 { 
  
   mysql_select_db("walk_with_me") or die(mysql_error()); 
 }

$sql = "INSERT INTO friends VALUES('$mypid', '$friend')";

$retval = mysql_query( $sql);
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}
echo "Entered data successfully\n";

$sql1 = "DELETE FROM requests WHERE(pr_pid= $mypid AND r_pid= $friend)";

$delval = mysql_query( $sql1);
if(! $delval )
{
  die('Could not delete data: ' . mysql_error());
}
echo "Deleted data successfully\n";






 
print"<form action='sugglog.php'>";
print"<input type='hidden' name='logem' value='$lpw'/>";
print"<input type='submit' value='OK'></form>";


?>
</body>
</html>
