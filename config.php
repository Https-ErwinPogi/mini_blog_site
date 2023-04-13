<?php
$servername = "localhost";
$username = "root";
$password = "";
$db_name = 'mini_blog_site';

// Create connection

$conn = mysqli_connect($servername,$username,$password,$db_name);

//check connection
    if (!$conn){
        echo 'Connection error:' . mysqli_connect_error();
    }
?>