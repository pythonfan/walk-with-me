<html>
<body>
<?php
session_start();
$table="requests";
$tablep="person";
$con=mysql_connect("localhost", "root");
if($con)
 { 
  
   mysql_select_db("walk_with_me") or die(mysql_error()); 
 }
$p=$_POST['pid'];
require_once('mailer.php');
include("class.smtp.php"); 
$mail             = new PHPMailer();
$mail->IsSMTP(); 
$mail->Host       = "mail.yourdomain.com"; 
$mail->SMTPDebug  = 0;                            
$mail->SMTPAuth   = true;                  
$mail->SMTPSecure = "ssl";                 
$mail->Host       = "smtp.gmail.com";      
$mail->Port       = 465;                   
$mail->Username   = "walkwithme4321@gmail.com";  //PUT UR EMAIL ID HERE
$mail->Password   = "itproject1234";// PASSWORD HERE
$mail->SetFrom('walkwithme4321@gmail.com', 'walk with me');
$mail->AddReplyTo("walkwithme4321@gmail.com");
$mail->Subject    = "walk with me website!!";
$mail->Body    = "This is a mail from walk with me website!!";
foreach($_POST['sugg'] as $value)
  {  
     
     $q1=mysql_query("SELECT name,email FROM $tablep where pid=$value",$con) or die("failed");
     if($q1)
     { 
	$mailinfo = mysql_fetch_array($q1);
	$email=$mailinfo['email'];
	$name=$mailinfo['name'];
        
        $mail->AddAddress($email);
        if(!$mail->Send())
 	{
		echo "Mailer Error: " . $mail->ErrorInfo;
	} 
	else
 	{
  		echo "Request sent to ".$name;
	}
     }
     else 
     {
     echo "Not selected :-(";
     }
     $q2="INSERT INTO $table VALUES($value,$p)";
     $n=mysql_query($q2,$con);
     if(!$n) echo "Failed to insert!</br>";
   }

?>
</body>
</html>