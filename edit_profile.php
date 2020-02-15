<?php
 
 include_once('./database/constants.php');
  if (!isset($_SESSION['userid'])){
    header("location:".DOMAIN."/");
  }

  //Get user image
  include_once('./database/db.php');
  $db = new Database();
  $con = $db->connect();

  $pre_stmt = $con->prepare('SELECT image FROM users WHERE username = ?');
  $pre_stmt->bind_param('s', $_SESSION['username']);
  $pre_stmt->execute() or die($con->error);
  $result = $pre_stmt->get_result();

  while($row = $result->fetch_assoc()){
    $image = $row['image'];
  }

  $msg = '';
  if(isset($_POST['submit'])) {
    $username = $_POST['username'];

    $target_dir = "images/";
    $target_file = $target_dir.basename($_FILES['image']['name']);
    move_uploaded_file($_FILES['image']['tmp_name'], $target_file);

    $pre_stmt = $con->prepare('UPDATE users SET username = ?, image = ? WHERE id = ?');
    $pre_stmt->bind_param('ssi', $username, $target_file, $_SESSION['userid']);
    $res = $pre_stmt->execute() or die($con->error);
    /* $pre_stmt = 'UPDATE users SET username = '.$username.', image = '.$target_file.' WHERE id = '.$_SESSION['userid'].'';
    $res = mysqli_query($con, $pre_stmt); */

    if($res) {
      $msg = '
      <div class="alert alert-success alert-dismissible mt-2">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Profile Updated!</strong>
      </div>
      ';
    } else {
      $msg = '
      <div class="alert alert-danger alert-dismissible mt-2">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Error occured</strong>
      </div>
      ';
    }
  }
 

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Inventory Home</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
    integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<!-- Navbar -->
   <?php
     include_once('templates/header.php');
   ?>

<div class="container">
  <div class="row">
    <div class="col-md-8">
      <h2>Edit Profile</h2>
      <form action="" method="post" enctype="multipart/form-data" >
        <div class="form-group">
          <input type="hidden" name="userid" id="userid" value="<?= $_SESSION['userid'] ?>">
          <input type="text" name="username" id="username" class="form-control" placeholder="Enter Username">
        </div>

        <div class="form-group">
          <p>Add Image</p>
            <input type="file" name="image"  id="image" class="form-control">
        </div>

        <div class="form-group">
          <input type="submit" name="submit" class="btn btn-success" value="Add">
        </div>
      </form>

      <div><?= $msg ?></div>
      <a href="dashboard.php">Dash</a>
    </div>
  </div>
</div>
 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="js/profile.js" type="text/javascript"></script>
</body>

</html>