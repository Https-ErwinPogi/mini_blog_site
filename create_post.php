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
<?php
//including the database connection file
include_once("config.php");

if(isset($_POST['submit'])) {	
    $title = $_POST['title'];
    $content = $_POST['content'];
    $userId = $_SESSION['id'];
    // checking empty fields
    if(empty($title) || empty($content)) {				
        if(empty($title)) {
          $error[] = "Bike Model field is empty";
        }
		
        if(empty($content)) {
          $error[] = "Bike Model field is empty";        }
		
        //link to the previous page
        echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
    } else { 
        // if all the fields are filled (not empty) 
			
        //insert data to database	
        $result = mysqli_query($conn, "INSERT INTO posts(title, content, user_id) VALUES('$title','$content','$userId')");
		
        header('location:index.php');
       
    }
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
  
  <div class="container text-white col d-flex justify-content-center mt-5">
         <div style="min-width: 70%;">
         <h5 class="text-black">Create Post</h5>

        <form action="" method="post">
    
            <div class="input-group mb-3">
              <input type="text" name="title"class="form-control" placeholder="Title">
            </div>
            <div class="input-group mb-3">
              <input type="text" name="content" class="form-control" placeholder="Content">
            </div>
              <!-- /.col -->
              <div class="col-12">
                <button type="submit" name="submit" class="btn btn-success btn-block">create</button>
              </div>
              <!-- /.col -->
            </div>
      </form>
      </div>
</body>
</html>