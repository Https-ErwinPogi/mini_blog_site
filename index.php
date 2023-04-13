<?php
session_start();

if (!isset($_SESSION['session'])) {
  header('location:login_page.php');
}
if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION);
  header("Location: login_page.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <title>Mini Blog Site</title>
</head>
<body style="background-color: #E6E6E6;">
  <?php
  @include('_header.php');
  ?>
  <div class="container text-white col d-flex justify-content-center">
  <div style="min-width: 60%;">
  <?php
  include_once("config.php");
  $stmtselect = "Select * FROM posts WHERE user_id=".$_SESSION['id']."";
  $result = mysqli_query($conn, $stmtselect);
  while ($row = mysqli_fetch_assoc($result)) {
    $date = date('jS F Y g:i:s A', strtotime($row["created_at"]));
    echo "<div class='shadow-sm card mt-2'> 
    <div class='card-body'> 
    <p>$row[title]</p>
    <p>$row[content]</p> 
    <p>Date: $date</p> 
    </div>
    <div class='card-footer'> 
      <a class=\"btn btn-success\" href=\"edit_post.php?id=$row[id]\"><i class='bi bi-pencil'></i>Edit</a>
    <a class=\"btn btn-danger\" href=\"delete.php?id=$row[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a>
    </div>
    </div>";
  }
  ?>
  <div class="card mt-2">
  <div class="card-body">
  <a href="create_post.php" class="btn btn-primary" style="background-color: #26A89A;">Create New Post</a>
  </div>

    </div>
  </div>
</body>
</html>