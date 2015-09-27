<?php
require("connection.php");
$warning="An auto-generated mail will be sent to your above written mail address for confirmation. Once you click the link given in that mail, your account will be confirmed.";

if(isset($_POST['signup'])){
if( !empty($_POST["fname"]) && !empty($_POST["lname"]) && !empty($_POST["uname"]) && !empty($_POST["rollno"]) && !empty($_POST["institute"]) && !empty($_POST["branchS"]) && !empty($_POST["sem"]) && !empty($_POST["password"])){
	
require("PHPMailer/PHPMailerAutoload.php");

    error_reporting(0);

 
 $firstname=$_POST['fname'];
 $lastname=$_POST['lname'];
 $username=$_POST['uname'];
 $roll_no=$_POST['rollno'];
 $institute=$_POST['institute'];
 $branch=$_POST['branchS'];
 $sem=$_POST['sem'];
 $password=$_POST['password'];
 
 $email = $roll_no . "@nirmauni.ac.in";

 
 if(strlen($roll_no)!=8 || !is_numeric(substr($email,0,2)) || is_numeric(substr($email,2,1)) || is_numeric(substr($email,3,1)) || is_numeric(substr($email,4,1)) || !is_numeric(substr($email,5,3) )){
		$warning="Invalid Roll Number!";
 }else{
 
	 DB::$error_handler = false; // since we're catching errors, don't need error handler
	 DB::$throw_exception_on_error = true;
	 
	 try{
	    $insert = DB::query("INSERT INTO user_master (first_name,last_name,user_name,mail_id,institute,branch,semester,password,roll_no) VALUES (%s,%s,%s,%s,%s,%s,%i,%s,%s)",$firstname,$lastname,$username,$email,$institute,$branch,$sem,$password,$roll_no);


         function SendMailWithGmailSMTP($author, $email, $text)
         {

             $mail = new PHPMailer();
             $text="Hello  Welcome to Campus-Connect ! Click Here to confirm: ";
             $author="Campus-Connect";
             $mail->IsSMTP();
             //$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
             $mail->SMTPAuth   = true;                  // enable SMTP authentication
             $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
             $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
             $mail->Port       = 465;   // set the SMTP port for the GMAIL server
             $mail->SMTPKeepAlive = true;
             $mail->Mailer = "smtp";
             // Sets SMTP authentication. Utilizes the Username and Password variables.
             $mail->Username = "preet.sinojiya@gmail.com";
             $mail->Password = "forcampusconnect";
             $mail->From = "campus@connect.in";
             $mail->FromName = $author;
             $mail->CharSet  = "ISO-8859-9";
             $mail->AddAddress($email);
             $mail->Subject  = "Welcome To Campus-Connect";
             $mail->IsHTML(true);
             $mail->Body = $text;
             if($mail->Send()) {;return true;}  else echo "";
         }

         //SendMailWithGmailSMTP("Campus-Connect",$email,"Welcome");

     }catch(MeekroDBException $e) {
		$warning="User is already a member!";
	}
 
}
 
}else {
	$warning ="Please fill all the details!";
}
}else{}




?>
<html>
<head> 
<link rel="stylesheet" href="signup.css"/>
</head>
<body>


<div id="container">

</div>
<form method="post" action="signup.php">
<div id="box">
<div id="text">
First Name: &nbsp;&nbsp;<input name="fname" type="text" size="10">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Last name: <input name="lname" type="text" size="10"><br><br>
Username: &nbsp;&nbsp;&nbsp;&nbsp;<input name="uname" type="text"><br><br>
Roll No: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="rollno" type="text"><br><br>
Institute:&nbsp;&nbsp;&nbsp;&nbsp;<input name="institute" size="10"><br><br>
Branch:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select name="branchS"><option value="CE" selected="selected">CE</option><option value="ME">ME</option><option value="IT">IT</option><option values="IC">IC</option><option value="CIVIL">Civil</option><option value="Chemical">Chemical</option><option value="EE">EE</option><option value="EC"> EC</option></select><br><br>
Semester:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="sem" size="1"><br><br>
password:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="password" type="password" size="10"><br><br>
confirm <br>password:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="cpassword" type="password" size="10">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" name="signup">Signup</button><br><br>
<font color="red"><hr> Note:</font> <?php echo $warning; ?>
</div>
</div>
</form>
</body>
</html>
