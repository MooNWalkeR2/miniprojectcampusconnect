<?php

require("../../connection.php");;
session_start();
$roll_no = $_SESSION['roll_no'];
$now = \Carbon\Carbon::now('Asia/Kolkata');

DB::query("INSERT INTO user_posts(roll_no,post,ts) VALUES(%s,%s,%s)",$roll_no,$_POST['post'],$now);
header("Location: ../homepage.php");

?>