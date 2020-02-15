<!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inventory Home</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  </head>

   <!-- Navbar -->
   <?php
     include_once('templates/header.php');
   ?>

    <div class="container"><br>
      <div class="card mx-auto" style="width: 20rem;">
        <div class="card-header"><h2>Register</h2></div>
          <div class="card-body">
          <form id="register-form" onsubmit="return false" autocomplete="off">
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" class="form-control" id="username"  name="username" placeholder="Username">
              <small class="form-text text-muted" id="u_error"></small>
            </div>
            <div class="form-group">
              <label for="email">Email address</label>
              <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Email">
              <small class="form-text text-muted" id="e_error"></small>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Password">
              <small class="form-text text-muted" id="pass_error"></small>
            </div>
            <div class="form-group">
              <label for="cpassword">Confirm Password</label>
              <input type="password" class="form-control" id="cpassword"  name="cpassword" placeholder="Confirm Password">
              <small class="form-text text-muted" id="cpass_error"></small>
            </div>
            <div class="form-group">
              <label for="exampleFormControlSelect1">Example select</label>
              <select class="form-control" name="usertype" id="usertype">
                <option value="">Select User Type</option>
                <option value="Admin">Admin</option>
                <option value="Other">Other</option>
              </select>
              <small class="form-text text-muted" id="type_error"></small>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i>&nbsp;&nbsp;Register</button>&nbsp;&nbsp;
            <span><a href="index.php">Login</a></span>
          </form>
          </div>
      </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="js/main.js" type="text/javascript"></script>
  </body>

  </html>
 