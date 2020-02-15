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
  <title>Inventory Home</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
    integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="overlay"><div class="overlay"></div></div>
<!-- Navbar -->
   <?php
     include_once('templates/header.php');
   ?><br><br>
  <div class="container">
    <div class="row">
      <div class="col-md-10 mx-auto">
        <div class="card" style="box-shadow: 0 0 25px 0 lightgrey">
          <div class="card-header">
            <h4>New Orders</h4>
          </div>
          <div class="card-body">
            <form onsubmit="return false" id="get_order_data">
              <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label" align="right">Order Date</label>
                <div class="col-sm-6">
                  <input type="text" id="order_date" name="order_date" class="form-control form-control-sm" value="<?php echo date("Y-m-d");   ?>" readonly>
                </div>
              </div>

              <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label" align="right">Customer Name</label>
                <div class="col-sm-6">
                  <input type="text"  name="cust_name" id="cust_name" class="form-control form-control-sm" placeholder="Enter Name" required>
                </div>
              </div>

              <div class="card" style="box-shadow: 0 0 15px 0 lightgrey">
                <div class="card-body">
                  <h3>Make Order List</h3>
                  <table align="center" style="width:800px;">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th style="text-align:center;">Item Name</th>
                        <th style="text-align:center;">Total Quantity</th>
                        <th style="text-align:center;">Quantity</th>
                        <th style="text-align:center;">Price</th>
                        <th>Total</th>
                      </tr>
                    </thead>
		                <tbody id="invoice_item">
                      <!-- <tr>
                        <td><b id="number">1</b></td>
                        <td>
                            <select name="pid[]" class="form-control form-control-sm" required>
                                <option>Washing Machine</option>
                            </select>
                        </td>
                        <td><input name="tqty[]" readonly type="text" class="form-control form-control-sm"></td>   
                        <td><input name="qty[]" type="text" class="form-control form-control-sm" required></td>
                        <td><input name="price[]" type="text" class="form-control form-control-sm" readonly></td>
                        <td>Rs.1540</td>
                      </tr> -->
		                </tbody>
                  </table>
                  
                  <center style="padding:10px;">
                    <button id="add" style="width:150px;" class="btn btn-success">Add</button>
                    <button id="remove" style="width:150px;" class="btn btn-danger">Remove</button>
                  </center>
                </div>
              </div>

              <p></p>
              <div class="form-group row">
                <label for="sub_total" class="col-sm-3 col-form-label" align="right">Sub Total</label>
                <div class="col-sm-6">
                  <input type="text" readonly name="sub_total" class="form-control form-control-sm" id="sub_total" required/>
                </div>
              </div>

              <div class="form-group row">
                <label for="gst" class="col-sm-3 col-form-label" align="right">GST (18%)</label>
                <div class="col-sm-6">
                  <input type="text" readonly name="gst" class="form-control form-control-sm" id="gst" required/>
                </div>
              </div>

              <div class="form-group row">
                <label for="discount" class="col-sm-3 col-form-label" align="right">Discount</label>
                <div class="col-sm-6">
                  <input type="text" name="discount" class="form-control form-control-sm" id="discount" required/>
                </div>
              </div>

              <div class="form-group row">
                <label for="net_total" class="col-sm-3 col-form-label" align="right">Net Total</label>
                <div class="col-sm-6">
                  <input type="text" readonly name="net_total" class="form-control form-control-sm" id="net_total" required/>
                </div>
              </div>
              <div class="form-group row">
                <label for="paid" class="col-sm-3 col-form-label" align="right">Paid</label>
                <div class="col-sm-6">
                  <input type="text" name="paid" class="form-control form-control-sm" id="paid" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="due" class="col-sm-3 col-form-label" align="right">Due</label>
                <div class="col-sm-6">
                  <input type="text" readonly name="due" class="form-control form-control-sm" id="due" required/>
                </div>
              </div>
              <div class="form-group row">
                <label for="payment_type" class="col-sm-3 col-form-label" align="right">Payment Method</label>
                <div class="col-sm-6">
                  <select name="payment_type" class="form-control form-control-sm" id="payment_type" required/>
                    <option>Cash</option>
                    <option>Card</option>
                    <option>Draft</option>
                    <option>Cheque</option>
                  </select>
                </div>
              </div>

              <center>
                <input type="submit" id="order_form" style="width:150px;" class="btn btn-info" value="Order">
                <input type="submit" id="print_invoice" style="width:150px;" class="btn btn-success d-none" value="Print Invoice">
              </center>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="js/order.js" type="text/javascript"></script>
</body>

</html>