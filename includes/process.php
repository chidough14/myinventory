<?php
include_once('../database/constants.php');
include_once('user.php');
include_once('DBOperation.php');
include_once('manage.php');

//Register
if(isset($_POST['username']) && isset($_POST['email'])) {
  $user = new User();
  $image = "images/avatar2.jpg";
  $result = $user->createUserAccount($_POST['username'], $_POST['email'], $_POST['password'], $_POST['usertype'], $image);
  echo $result;
  exit();
}

//Login
if(isset($_POST['email']) && isset($_POST['password'])) {
  $user = new User();
  $result = $user->userLogin($_POST['email'], $_POST['password']);
  echo $result;
  exit();
}

//Get Categories
if(isset($_POST['getCategory'])) {
  $obj = new DBOperation();
  $rows = $obj->getAllRecord('categories');

  foreach ($rows as $row) {
    echo "<option value='".$row['id']."'>".$row['category_name']."</option>";
  }

  exit();
}

// Add Category
if(isset($_POST['cat_name']) && isset($_POST['parent_cat'])) {
  $obj = new DBOperation();
  $result = $obj->addCategory($_POST['cat_name'], $_POST['parent_cat']);

  echo $result;
  exit();
}

// Add Brand
if(isset($_POST['brand_name'])) {
  $obj = new DBOperation();
  $result = $obj->addBrand($_POST['brand_name']);

  echo $result;
  exit();
}

//Get Brands
if(isset($_POST['getBrand'])) {
  $obj = new DBOperation();
  $rows = $obj->getAllRecord('brands');

  foreach ($rows as $row) {
    echo "<option value='".$row['bid']."'>".$row['brand_name']."</option>";
  }

  exit();
}

//Add Product

if(isset($_POST['added_date']) && isset($_POST['product_name'])) {
  $obj = new DBOperation();
  $result = $obj->addProduct($_POST['select_cat'], $_POST['select_brand']
                             , $_POST['product_name'], $_POST['product_price'],
                             $_POST['product_qty'], $_POST['added_date']);

  echo $result;
  exit();
}

//Manage Category
if (isset($_POST["manageCategory"])) {
	$m = new Manage();
  $result = $m->manageRecordWithPagination("categories",$_POST["pageno"]);
	$rows = $result["rows"];
	$pagination = $result["pagination"];
	if (count($rows) > 0) {
    $n = (($_POST["pageno"] - 1) * 5)+1; 
		foreach ($rows as $row) {
			?>
				<tr>
			        <td><?php echo $n; ?></td>
			        <td><?php echo $row["category"]; ?></td>
			        <td><?php echo $row["parent"]; ?></td>
			        <td><a href="#" class="btn btn-success btn-sm">Active</a></td>
			        <td>
			        	<a href="#" did="<?php echo $row['id']; ?>" class="btn btn-danger btn-sm del_cat">Delete</a>
			        	<a href="#" eid="<?php echo $row['id']; ?>" data-toggle="modal" data-target="#form_category" class="btn btn-info btn-sm edit_cat">Edit</a>
			        </td>
			      </tr>
			<?php
			$n++;
		}
		?>
			<tr><td colspan="5"><?php echo $pagination; ?></td></tr>
		<?php
		exit();
  }
  
}

 //Delete Category
 if (isset($_POST["deleteCategory"])) {
  $n = new Manage();
  $result = $n->deleteRecord("categories","id",$_POST["id"]);
  echo $result;

  exit();
 }

  //Update Category
  if (isset($_POST["updateCategory"])) {
  $m = new Manage();
  $result = $m->getSingleRecord("categories","id",$_POST["id"]);
  echo json_encode($result);
  exit();
  }

  //Update Record after getting data
  if (isset($_POST["update_category"])) {
    $m = new Manage();
    $id = $_POST["cid"];
    $name = $_POST["update_category"];
    $parent = $_POST["parent_cat"];
    $result = $m->update_record("categories",["id"=>$id],["parent_cat"=>$parent,"category_name"=>$name,"status"=>1]);
    echo $result;
  }

  // Mange Brands************* 

  if (isset($_POST["manageBrand"])) {
    $m = new Manage();
    $result = $m->manageRecordWithPagination("brands",$_POST["pageno"]);
    $rows = $result["rows"];
    $pagination = $result["pagination"];
    if (count($rows) > 0) {
      $n = (($_POST["pageno"] - 1) * 5)+1; 
      foreach ($rows as $row) {
        ?>
          <tr>
                <td><?php echo $n; ?></td>
                <td><?php echo $row["brand_name"]; ?></td>
                <td><a href="#" class="btn btn-success btn-sm">Active</a></td>
                <td>
                  <a href="#" did="<?php echo $row['bid']; ?>" class="btn btn-danger btn-sm del_brand">Delete</a>
                  <a href="#" eid="<?php echo $row['bid']; ?>" data-toggle="modal" data-target="#form_brand" class="btn btn-info btn-sm edit_brand">Edit</a>
                </td>
              </tr>
        <?php
        $n++;
      }
      ?>
        <tr><td colspan="5"><?php echo $pagination; ?></td></tr>
      <?php
      exit();
    }
  
}

//Delete Brand
if (isset($_POST["deleteBrand"])) {
  $n = new Manage();
  $result = $n->deleteRecord("brands","bid",$_POST["id"]);
  echo $result;

  exit();
 }

 //Update Brand
if (isset($_POST["updateBrand"])) {
	$m = new Manage();
	$result = $m->getSingleRecord("brands","bid",$_POST["id"]);
	echo json_encode($result);
	exit();
}

//Update Record after getting data
if (isset($_POST["update_brand"])) {
	$m = new Manage();
	$id = $_POST["bid"];
	$name = $_POST["update_brand"];
	$result = $m->update_record("brands",["bid"=>$id],["brand_name"=>$name,"status"=>1]);
	echo $result;
}

 // Mange Products************* 

 if (isset($_POST["manageProduct"])) {
  $m = new Manage();
  $result = $m->manageRecordWithPagination("products",$_POST["pageno"]);
  $rows = $result["rows"];
  $pagination = $result["pagination"];
  if (count($rows) > 0) {
    $n = (($_POST["pageno"] - 1) * 5)+1; 
    foreach ($rows as $row) {
      ?>
        <tr>
              <td><?php echo $n; ?></td>
              <td><?php echo $row["product_name"]; ?></td>
              <td><?php echo $row["category_name"]; ?></td>
              <td><?php echo $row["brand_name"]; ?></td>
              <td><?php echo $row["product_price"]; ?></td>
              <td><?php echo $row["product_stock"]; ?></td>
              <td><?php echo $row["added_date"]; ?></td>
              <td><a href="#" class="btn btn-success btn-sm">Active</a></td>
              <td>
                <a href="#" did="<?php echo $row['pid']; ?>" class="btn btn-danger btn-sm del_product">Delete</a>
                <a href="#" eid="<?php echo $row['pid']; ?>" data-toggle="modal" data-target="#form_product" class="btn btn-info btn-sm edit_product">Edit</a>
              </td>
            </tr>
      <?php
      $n++;
    }
    ?>
      <tr><td colspan="9"><?php echo $pagination; ?></td></tr>
    <?php
    exit();
  }


}


  // Delete Product
  if (isset($_POST["deleteProduct"])) {
     $n = new Manage();
     $result = $n->deleteRecord("products","pid",$_POST["id"]);
     echo $result;
   
     exit();;
    }

    if (isset($_POST["updateProduct"])) {
      $m = new Manage();
      $result = $m->getSingleRecord("products","pid",$_POST["id"]);
      echo json_encode($result);
      exit();
    }
    
      //Update Record after getting data
    if (isset($_POST["update_product"])) {
      $m = new Manage();
      $id = $_POST["pid"];
      $name = $_POST["update_product"];
      $cat = $_POST["select_cat"];
      $brand = $_POST["select_brand"];
      $price = $_POST["product_price"];
      $qty = $_POST["product_qty"];
      $date = $_POST["added_date"];
      $result = $m->update_record("products",["pid"=>$id],["cid"=>$cat,"bid"=>$brand,"product_name"=>$name,"product_price"=>$price,"product_stock"=>$qty,"added_date"=>$date]);
      echo $result;
    }

    // Order Processing******************************** 
    if (isset($_POST["getNewOrderItem"])) {
      $obj = new DBOperation();
      $rows = $obj->getAllRecord("products");
      ?>
      <tr>
            <td><b class="number">1</b></td>
            <td>
                <select name="pid[]" class="form-control form-control-sm pid" required>
                    <option value="">Choose Product</option>
                    <?php 
                      foreach ($rows as $row) {
                        ?><option value="<?php echo $row['pid']; ?>"><?php echo $row["product_name"]; ?></option><?php
                      }
                    ?>
                </select>
            </td>
            <td><input name="tqty[]" readonly type="text" class="form-control form-control-sm tqty"></td>   
            <td><input name="qty[]" type="text" class="form-control form-control-sm qty" required></td>
            <td><input name="price[]" type="text" class="form-control form-control-sm price" readonly><span><input name="pro_name[]" type="hidden" class="form-control form-control-sm pro_name"></span></td>
            
            <td>$<span class="amt">0</span></td>
      </tr>
      <?php
      exit();
    }

    // Get price and qty of one item
    if(isset($_POST['getPriceAndQty'])) {
      $m = new Manage();
      $result = $m->getSingleRecord('products', 'pid', $_POST['id']);
      echo json_encode($result);
      exit();
    }

    if(isset($_POST['order_date']) && isset($_POST['cust_name'])) {
      $order_date = $_POST['order_date'];
      $cust_name = $_POST['cust_name'];

      //getting array
      $arr_tqty = $_POST['tqty'];
      $arr_qty = $_POST['qty'];
      $arr_price = $_POST['price'];
      $arr_pro_name = $_POST['pro_name'];

      $sub_total = $_POST['sub_total'];
      $gst = $_POST['gst'];
      $discount = $_POST['discount'];
      $net_total = $_POST['net_total'];
      $paid = $_POST['paid'];
      $due = $_POST['due'];
      $payment_type = $_POST['payment_type'];

      $m = new Manage();
      echo $result = $m->storeCustomerOrderInvoice ($order_date, $cust_name, $arr_tqty, $arr_qty,
                                                $arr_price, $arr_pro_name, $sub_total, $gst, 
                                                $discount, $net_total, $paid, $due, $payment_type);


    }

    // p rofile

    if(isset($_POST['usid'])) {
      include_once('../database/db.php');
      $db = new Database();
      $con = $db->connect();

      $pre_stmt = $con->prepare("SELECT username FROM users WHERE id= ?");
      $pre_stmt->bind_param("i",$_POST['usid']);
      $pre_stmt->execute() or die($con->error);

      $result = $pre_stmt->get_result();
      while($row = $result->fetch_assoc()) {
        echo $row['username'];
      }

      //echo "hello";

    }
    


?>


