<?php
 
 include_once('./database/constants.php');
  if (!isset($_SESSION['userid'])){
    header("location:".DOMAIN."/");
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Inventory Categories</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
    integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
  <!-- Navbar -->
  <?php
     include_once('templates/header.php');
   ?><br><br>

   <div class="container">
      <table class="table table-hover table-bordered">
        <thead>
          <tr>
            <th>#</th>
            <th>Category</th>
            <th>Parent</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody id="get_category">
          <!-- <tr>
            <td>1</td>
            <td>Electronics</td>
            <td>Root</td>
            <td>
              <a href="" class="btn btn-success">Active</a>
            </td>
            <td>
            <a href="" class="btn btn-primary"><i class="fas fa-edit"></i></a>
            <a href="" class="btn btn-danger"><i class="fas fa-trash"></i></a>
            </td>
          </tr> -->
        </tbody>
      </table>
   </div>

   <?php
		include_once("./templates/update_category.php");
	?>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="js/manage.js" type="text/javascript"></script>
</body>

</html>