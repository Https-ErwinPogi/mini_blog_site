<?php session_start(); ?>

<?php
if(!isset($_SESSION['session'])) {
    header('Location: login.php');
}
?>

<?php
//including the database connection file
include("config.php");

//getting id of the data from url
$id = $_GET['id'];

//deleting the row from table
$result=mysqli_query($conn, "DELETE FROM posts WHERE id=$id");

//redirecting to the display page (view.php in our case)
header("Location:index.php");
?>