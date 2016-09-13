<html><head></head><body>

  <form method="post" action="">
  enter email id: <input type="email" name="to" required><br/>
  <br/>
  <input type="submit" name="submit" value="Send">
  </form>

<?php

if(isset($_POST['submit']))
{
$email=$_POST['to'];
$dbname = "walk_with_me";
$dbusername ="root";
$dbhost ="localhost";
$connection = mysql_connect("$dbhost","$dbusername");
mysql_select_db("$dbname")or die("cannot select DB");
if (!$connection)
{
    die('Could not connect: ' . mysql_error());
}
else
{
$sql="SELECT * FROM person WHERE email='$email'";
$result=mysql_query($sql);
if(!$result){
die("invalid user name of password".mysql_error());
}

        mysql_close();

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
$address = $_POST['to'];
$mail->AddAddress($address);
if(!$mail->Send())
 {
  echo "Mailer Error: " . $mail->ErrorInfo;
} 
else
 {
  echo "New password is sent to ".$address;
}
}

}
?>
</body>
</html>

