<?php

require "../connection.php";

session_start();
$roll_no = $_SESSION['roll_no'];

$string = $_REQUEST['q'];


$search = DB::query("SELECT first_name FROM user_master WHERE first_name LIKE '%$string%' AND roll_no!='$roll_no'");


foreach($search as $result){
    echo $result['first_name'] . "|";
}

?>