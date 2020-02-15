<?php
 
 include_once('./database/constants.php');
  if (isset($_SESSION['userid'])){
    header("location:".DOMAIN."/dashboard.php");
  }

?>
<!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inventory Home</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="./includes/styles.css">
  </head>
  <body>
    <div class="overlay"><div class="overlay"></div></div>
   <!-- Navbar -->
   <?php
     include_once('templates/header.php');
   ?>

    <div class="container"><br>
      <?php if(isset($_GET['msg']) && !empty($_GET['msg'])) {  ?>

        <div class="alert alert-success alert-dismissible mt-2">
          <?= $_GET['msg'] ?>
          <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
      <?php } ?>
    
    
      <div class="card mx-auto" style="width: 20rem">
        <div class="card-body">
          <img src="images/login2.jpg" alt="" style="width: 60%;" class="card-img-top mx-auto">
          <h4 class="card-title">Login</h4>
          <form onsubmit="return false" id="form-login">
            <div class="form-group">
              <label for="email"></label>
              <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
              <small id="e_error" class="form-text text-muted"></small>
            </div>

            <div class="form-group">
              <label for="password"></label>
              <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password">
              <small id="p_error" class="form-text text-muted"></small>
            </div>
            <button type="submit" name="" id="" class="btn btn-primary btn-lg btn-block"><i class="fas fa-sign-in-alt"></i> Login</button>
            <span><a href="register.php">Register</a></span>
          </form>
        </div>

        <div class="card-footer">
          <a href="#">Forgot Password?</a>
        </div>
      </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="js/main.js" rel="stylesheet" type="text/javascript"></script>
  </body>

  </html>
 