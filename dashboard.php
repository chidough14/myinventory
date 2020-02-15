<?php
 
 include_once('./database/constants.php');
  if (!isset($_SESSION['userid'])){
    header("location:".DOMAIN."/");
  }

  //Get user image
  include_once('./database/db.php');
  $db = new Database();
  $con = $db->connect();

  $pre_stmt = $con->prepare('SELECT image, username FROM users WHERE id = ?');
  $pre_stmt->bind_param('i', $_SESSION['userid']);
  $pre_stmt->execute() or die($con->error);
  $result = $pre_stmt->get_result();

  while($row = $result->fetch_assoc()){
    $image = $row['image'];
    $username = $row['username'];
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

  <div class="container"><br>
    <div class="row">
      <div class="col-md-4">
        <div class="card mx-auto" style="width: 20rem;">
          <img class="card-img-top mx-auto" src="<?= $image  ?>" alt="" style="width: 60%">
          <div class="card-body">
            <h4 class="card-title">Profile Info</h4>
            <p class="card-text"><?= $username ?></p>
            <p class="card-text"><?= $_SESSION['usertype'] ?></p>
            <p class="card-text">Last Login: <?= $_SESSION['last_login'] ?></p>
            <a href="edit_profile.php" class="btn btn-info"><i class="fas fa-edit"></i>&nbsp;Edit Profile</a>
          </div>
        </div>
      </div>

      <div class="col-md-8">
        <div class="jumbotron" style="width: 100%; height: 100%;">
          <h1>Welcome Admin</h1>
          <div class="row">
            <div class="col-sm-6">
             <iframe src="https://free.timeanddate.com/clock/i6uflx18/n1972/szw110/szh110/cf100/hnce1ead6" 
                 frameborder="0" 
                 width="160" 
                 height="160"></iframe>
            </div>

            <div class="col-sm-6">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">New Orders</h4>
                  <p class="card-text">You mahe make new orders here!</p>
                  <a href="new_order.php" class="btn btn-primary">New Orders</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <p></p>
  <p></p>
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <div class="card mx-auto" style="width: 20rem;">
          <div class="card-body">
            <h4 class="card-title">Manage Categories</h4>
            <p class="card-text">Here you can manage categories</p>
            <a href="manage_categories.php" class="btn btn-info">Manage</a>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#category">
              New
            </button>
           </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card mx-auto" style="width: 20rem;">
          <div class="card-body">
            <h4 class="card-title">Manage Brands</h4>
            <p class="card-text">Here you can manage brands</p>
            <a href="manage_brand.php" class="btn btn-info">Manage</a>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#brand">
              New
            </button>
           </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card mx-auto" style="width: 20rem;">
          <div class="card-body">
            <h4 class="card-title">Manage Products</h4>
            <p class="card-text">Here you can manage products</p>
            <a href="manage_product.php" class="btn btn-info">Manage</a>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#product">
              New
            </button>
           </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button> -->

<?php  include_once('templates/categorymodal.php');?>
<?php  include_once('templates/brandmodal.php');?>
<?php  include_once('templates/productmodal.php');?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="js/main.js" type="text/javascript"></script>
</body>

</html>