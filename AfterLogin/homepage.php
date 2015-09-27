
<?php

require("../connection.php");
session_start();
$roll_no = $_SESSION['roll_no'];

if(!empty($_GET['searchProfile'])){
    $search = $_GET['searchProfile'];
    header("Location: Profile/addFriendProfile.php?search=$search");
}

?>


<!DOCTYPE html>

    <html>

<head>
    <title>Home Page</title>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="homepage.css"/>
    <script src="homepagesearch.js"></script>
</head>

<body>




<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#"><?php echo $roll_no; ?></a>
        </div>

        <div class="navbar-nav" id="searchbox">
        <form role="form">
            <input type="text" class="form-control" onkeyup="homePageSearchBegin(this.value)">

            <form action="/Profile/profile.php" method="POST">
                <span id="searchresult" >

                </span>
            </form>
        </form>
        </div>
        <div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#">Profile</a></li>
                <li><a href="#">Pages</a></li>
                <li><a href="#">Groups</a></li>
                <li><a href="Logout/logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>


<div id="addPost">
    <form action="ManagePost/addthispost.php" method="post">
        <input type="textarea" name="post">
        <input type="submit" value="Post it!" name="postit">
    </form>
</div>


<div id="testing">
</div>

<?php


/////////////////////// LIST OF ROLL NO OF FRIENDS///////////////////////////////
$friendsArray = DB::query("SELECT roll_no_2 FROM user_friends WHERE roll_no_1=%s",$roll_no);
$j=0;
$friends=[];
foreach($friendsArray as $friend){
    $friends[$j] = "'".$friend['roll_no_2']."'";
    $j++;
}
/////////////////////////////////////////////////////////////////////////////////////////


///////////////////////  LIST OF POSTS BY THOSE FRIENDS /////////////////////////
$posts = DB::query("SELECT post,roll_no FROM user_posts WHERE roll_no IN (". implode(',',$friends).") LIMIT 10" );
echo '<table border="2">';
foreach($posts as $post){
    echo '<tr><td>';
    echo $post['post'].'</td><td>';
    echo $post['roll_no'].'</td></tr>';
}
echo '</table>';
///////////////////////////////////////////////////////////////////////////////////////

?>



</body>
</html>