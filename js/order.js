$(document).ready(function () {
 
  var DOMAIN = "http://localhost:8010";
  //var DOMAIN = "https://byteinventory.herokuapp.com";

  addNewRow()
  $('#add').click(function (e) { 
    addNewRow()
    
  });

  function addNewRow(){
    $.ajax({
      url : DOMAIN+"/includes/process.php",
      method : "POST",
      data: {getNewOrderItem: 1},
      success: function (response) {
        $('#invoice_item').append(response);
        var n = 0
        $('.number').each(function() {
          $(this).html(++n)
        })
      }
    });
  }

  $('#remove').click(function (e) { 
    $('#invoice_item').children('tr:last').remove();
    calculate(0, 0)
  });

  $('#invoice_item').delegate('.pid', 'change', function() {
    var pid = $(this).val()
    var tr = $(this).parent().parent()
    $('.overlay').show();

    $.ajax({
      url : DOMAIN+"/includes/process.php",
      method : "POST",
      dataType: "json",
      data: {getPriceAndQty: 1, id: pid},
      success: function (data) {
        tr.find('.tqty').val(data['product_stock'])
        tr.find('.pro_name').val(data['product_name'])
        tr.find('.qty').val(1)
        tr.find('.price').val(data['product_price'])
        tr.find('.amt').html(tr.find('.qty').val() * tr.find('.price').val())
        calculate(0, 0)
      }
    });
  });

  $('#invoice_item').delegate('.qty', 'keyup', function() {
    var qty = $(this)
    var tr = $(this).parent().parent()
    if(isNaN(qty.val())){
      alert('Please enter a valid number')
      qty.val(1)
    } else {
      if((qty.val() - 0) > (tr.find('.tqty').val() - 0)) {
        alert('Quantity not available')
        qty.val(1)
      } else {
        tr.find('.amt').html(qty.val() * tr.find('.price').val())
        calculate(0, 0)
      }
    }
  });

  function calculate(dis, paid){
    var sub_total = 0
    var gst = 0
    var net_total = 0
    var discount = dis
    var paid_amt = paid
    var due = 0
    $('.amt').each(function() {
      sub_total = sub_total + ($(this).html() * 1)
    })

    gst = 0.18 * sub_total
    net_total = gst + sub_total
    net_total = net_total - discount
    due = net_total - paid_amt

    $('#sub_total').val(sub_total)
    $('#gst').val(gst)
    $('#discount').val(discount)
    $('#net_total').val(net_total)
    //$('#paid')
    $('#due').val(due)
   
  }


  $('#discount').keyup(function (e) { 
    var discount = $(this).val()
    calculate(discount, 0)
  });

  
  $('#paid').keyup(function (e) { 
    var paid = $(this).val()
    var discount = $('#discount').val()
    calculate(discount, paid)
  });

    
 
  // Accepting order

  $('#order_form').click(function () { 
    var invoice =  $("#get_order_data").serialize()
    if($('#cust_name').val() == ""){
      alert('Enter Name')
    } else if( $('#paid').val() == ""){
      alert('Enter Amount paid')
    } else {
      $.ajax({
        url : DOMAIN+"/includes/process.php",
        method : "POST",
        data: $("#get_order_data").serialize(),
        success: function (data) {

          if (data < 0) {
						alert(data);
					}else{
						$("#get_order_data").trigger("reset");

						if (confirm("Do u want to print invoice ?")) {
							window.location.href = DOMAIN+"/includes/invoice_bill.php?invoice_no="+data+"&"+invoice;
						}
					}
        }
      });
    }
      
    });
    

});