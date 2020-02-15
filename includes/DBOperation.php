<?php

class DBOperation
{
  
  private $con;

  function __construct() {
    include_once('../database/db.php');
    $db = new Database();
    $this->con = $db->connect();
  }

  public function addCategory ($cat, $parent) {
    $pre_stmt = $this->con->prepare("INSERT INTO categories (category_name, parent_cat, status) 
                VALUES (?,?,?)"); 
    $status = 1;         
    $pre_stmt->bind_param('sii', $cat, $parent, $status);
    $result = $pre_stmt->execute() or die($this->con->error);

    if($result) {
      return "CATEGORY_ADDED";
    } else {
      return 0;
    }
  }

  public function getAllRecord ($table) {
    $pre_stmt = $this->con->prepare("SELECT * FROM ".$table); 
    
    $pre_stmt->execute() or die($this->con->error);
    $result = $pre_stmt->get_result();
    $rows = array();
    if($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $rows[] = $row;
      }

      return $rows;
    } else {
      return "NO_DATA";
    }
  }

  //Brands
  public function addBrand ($brand_name) {
    $pre_stmt = $this->con->prepare("INSERT INTO brands (brand_name, status) 
                VALUES (?,?)"); 
    $status = 1;         
    $pre_stmt->bind_param('si', $brand_name, $status);
    $result = $pre_stmt->execute() or die($this->con->error);

    if($result) {
      return "BRAND_ADDED";
    } else {
      return 0;
    }
  }


  //Add Product
  public function addProduct ($cid, $bid, $name, $price, $stock, $date) {
    $pre_stmt = $this->con->prepare("INSERT INTO products (cid, bid, product_name, product_price,
                product_stock, added_date, p_status) VALUES (?,?,?,?,?,?,?)"); 
    $status = 1;         
    $pre_stmt->bind_param('iisdisi', $cid, $bid, $name, $price, $stock, $date, $status);
    $result = $pre_stmt->execute() or die($this->con->error);

    if($result) {
      return "PRODUCT_ADDED";
    } else {
      return 0;
    }
  }
}

/* $opr = new DBOperation();
echo "<pre>";
print_r($opr->getAllRecord('categories')); */

?>