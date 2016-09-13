<html>
<body background="headgrass1.jpg" >
<center><h1><font color="003300">Walk with Me!</font></h1>
<img src="graphics-walking-132772.gif"/>
</br></br>
<h2><font color='white'>Friends</font></h2>
<?php
$i=0;
$c=0;
session_start();
foreach($_POST['route'] as $value)
  {  $i++;
     $chk[$i]=$value;
     
  }
//10
$con=mysql_connect("localhost", "root");
$table="checkpts";
$tablep="person";
$tf="friends";
if($con)
 { 
  
   mysql_select_db("walk_with_me") or die(mysql_error()); 
 }
$data = mysql_query("SELECT * FROM person") 
 or die("cannot retreive"); 
$maxpid=0;
while($info = mysql_fetch_array($data))
{
$pid=(int)$info['pid'];
if($pid > $maxpid)
 $maxpid=$pid;
}

$l_pid=$maxpid;

if($i==2)
{
$q="INSERT INTO $table(c_pid,c1,c2) VALUES($maxpid,'$chk[1]','$chk[2]')";
//30
$n=mysql_query($q,$con);
}
elseif($i==3)
{
$q="INSERT INTO $table(c_pid,c1,c2,c3) VALUES($maxpid,'$chk[1]','$chk[2]','$chk[3]')";
$n=mysql_query($q,$con);
}
elseif($i==4) 
{
$q="INSERT INTO $table(c_pid,c1,c2,c3,c4) VALUES($maxpid,'$chk[1]','$chk[2]','$chk[3]','$chk[4]')";
//40
$n=mysql_query($q,$con);
}
else
{
$q="INSERT INTO $table VALUES($maxpid,'$chk[1]','$chk[2]','$chk[3]','$chk[4]','$chk[5]')";
$n=mysql_query($q,$con);
}
if(!$n)
{
die(mysql_error());
//50
}














$data = mysql_query("(SELECT $tablep.name FROM $tf JOIN $tablep ON $tablep.pid= $tf.f_pid WHERE $tf.p_pid=$l_pid)UNION(SELECT $tablep.name FROM $tf JOIN $tablep ON $tablep.pid= $tf.p_pid WHERE $tf.f_pid=$l_pid)") 
 or die("cannot retreive"); 
if($data)
echo"Query executed";

while($info = mysql_fetch_array($data))
{
 print"<font color='white'><p>".$info['name']."</p></font></br>";
}
print"<hr>";










$q1=mysql_query("SELECT * FROM $table where c_pid='$l_pid' ") or die("cannot retreive"); 
while($info = mysql_fetch_array($q1))
{
$pid=(int)$info['c_pid'];
$c1=(int)$info['c1']; 
$c2=(int)$info['c2'];
$c3=(int)$info['c3'];
$c4=(int)$info['c4'];
$c5=(int)$info['c5'];
}
$q2=mysql_query("SELECT * from $table where c_pid !='$pid' ") or die("Can't retrieve data");
print "<h2><font color='white'>Suggestions</font></h2>";
print "<form action='conf.php' method='post'>";
while($info=mysql_fetch_array($q2))
{
$s_pid=(int)$info['c_pid'];
$sc1=(int)$info['c1']; 
$sc2=(int)$info['c2'];
$sc3=(int)$info['c3'];
$sc4=(int)$info['c4'];
$sc5=(int)$info['c5'];
if(($c1==$sc1 || $c1==$sc2 || $c1==$sc3 || $c1==$sc4 || $c1==$sc5) && $c1!=0){ $c++; print"<p>$c1</p>";}
if(($c2==$sc1 || $c2==$sc2 || $c2==$sc3 || $c2==$sc4 || $c2==$sc5) && $c2!=0){ $c++; print"<p>$c2</p>";}
if(($c3==$sc1 || $c3==$sc2 || $c3==$sc3 || $c3==$sc4 || $c3==$sc5) && $c3!=0){ $c++; print"<p>$c1</p>";}
if(($c4==$sc1 || $c4==$sc2 || $c4==$sc3 || $c4==$sc4 || $c4==$sc5) && $c4!=0){ $c++; print"<p>$c1</p>";}
if(($c5==$sc1 || $c5==$sc2 || $c5==$sc3 || $c5==$sc4 || $c5==$sc5) && $c5!=0){ $c++; print"<p>$c1</p>";}
if($c>=2)
{
$q3=mysql_query("SELECT name from $tablep WHERE pid='$s_pid'");
$info=mysql_fetch_array($q3);
print "<p>";
print $info['name']." ";
print "<input type='checkbox' name='sugg[]' value='$s_pid'/></p></br>";
}
$c=0;
}
print "<input type='hidden' name='pid' value='$pid'/>";
print "<input type='submit' value='Send Request' /></form>";








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
print"</center>";
?>
</body>
</html>