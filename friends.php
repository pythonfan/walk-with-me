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
$tablep="person";
$tf="friends";
if(mysql_connect("localhost","root"))
 print"<p>Connected</p>";
 mysql_select_db("walk_with_me") or die("Wrong db"); 

echo"Connected to MySQL";
$l_pid=1;
 $data = mysql_query("(SELECT $tablep.name FROM $tf JOIN $tablep ON $tablep.pid= $tf.f_pid WHERE $tf.p_pid=$l_pid)UNION(SELECT $tablep.name FROM $tf JOIN $tablep ON $tablep.pid= $tf.p_pid WHERE $tf.f_pid=$l_pid)") 
 or die("cannot retreive"); 
if($data)
echo"Query executed";

while($info = mysql_fetch_array($data))
{
 print"<font color='white'><p>".$info['name']."</p></font></br>";
}
print"<hr>";
print"<h2><font color='white'>Requests</font></h2>";


 $data = mysql_query("SELECT person.name, requests.r_pid FROM requests JOIN person ON person.pid= requests.r_pid WHERE requests.pr_pid=$l_pid") 
 or die("cannot retreive1"); 
if($data)
echo"Query executed";
print"<form action='accept.php' method='post'>";
while($info = mysql_fetch_array($data))
{
 print"<font color='white'><p><input type='checkbox' name='fpid' value=".$info['r_pid'].">";
 print $info['name']."</p></font></br>";
print"<input type='hidden' name='pid' value='$l_pid'/>";
}
print"<input type='submit' value='Accept'></form>";




?>
</body>
</html>