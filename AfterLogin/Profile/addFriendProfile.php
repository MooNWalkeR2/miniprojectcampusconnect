<?php

// /** On the basis of roll no get all the details and show here **/

if(isset($_POST['addAsAFriend'])){

}

session_start();
$rollNo = $_SESSION['roll_no'];
echo $_GET['search'];
$rollNoProfile = DB::query("SELECT roll_no FROM user_master WHERE user_name=%s",$_GET['search']);
$rollNoProfile = $rollNoProfile[0]['roll_no'];

$friendsornot = DB::query("SELECT roll_no_1 FROM user_friends WHERE roll_no_1=%s AND roll_no_2=%s",$rollNo,$rollNoProfile);

if(count($friendsornot)>0){

}else{
    echo "<form action='addFriendProfile.php' method='post'> ";
    echo "<input type='submit' value='Add As a Friend' name='addAsAFriend'>";
    echo "</form>";
}


?>