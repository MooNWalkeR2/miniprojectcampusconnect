<?php 

require("connection.php");
$warning="";

if(isset($_POST['login'])){
	
	if(!empty($_POST['email']) && !empty($_POST['password'])){
		
		$email=$_POST['email'];
		$password=$_POST['password'];
		
		$no=DB::query("SELECT count(*) as count,e_activated FROM user_master WHERE roll_no=%s && password=%s",$email,$password);
		
		if($no[0]['count']==1){
			
			////// Start a session and store all the variables //////

            if($no[0]['e_activated']==1){

                session_start();
                $_SESSION['login']="true";
                $_SESSION['roll_no']=$email;
                header('Location: AfterLogin/homepage.php');
            }


		}else{
			$warning="Invalid combination!";
		}
	}else{
		$warning="Please enter id and password!";
	}
	
}


?>


<!Doctype html>
<html>
<head>
<title></title>
<link rel="stylesheet" href="login.css"/>
</head>
<body>

<div CLASS="r1"><img id="img" src="Picasa_1.jpg"></DIV>

<div class="container" >
<div class="r2">
</div>
<div class="r3">
<table width="100%" height="100%">
<tr>
<form method="post" action="login.php">
<td><b><font face="Consolas">Roll NO:</td> <td><input class="login" tabindex="1"placeholder="11ABCE111" type="text" name="email"></td>
<td><a href="signup.php" class="myButton" tabindex="4">signup</a></td></tr>

<tr><td><b>Password:</b> </td><td><input class="pass" tabindex="2" placeholder="password" type="password" name="password"></b></td>
<td><button type="submit" name="login" tabindex="3" class="myButton">Log in</button></font></td></tr>

<tr><td  colspan="3" style="color:red;"><?php echo $warning; ?></td><td></td><td></td></tr>
</table>
</form>
</div>
</div>
</body>
</html>
