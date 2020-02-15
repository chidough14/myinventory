$(document).ready(function () {
  var DOMAIN = "http://localhost:8010";
  //var DOMAIN = "https://byteinventory.herokuapp.com";

  $('#register-form').on('submit', function(e) {
    var status = false;
    var name = $('#username');
    var email = $('#email');
    var password = $('#password');
    var cpassword = $('#cpassword');
    var usertype = $('#usertype');
    //var n_patt = new RegExp(/^[A-Za-z ]+$/);
    //var e_patt = new RegExp(/^[a-z0-9_-]+(\.[a-z0-9_-]+)*@[a-z0-9_-]+(\.[a-z0-9_-]+)*(\.[a-z]{2, 4})$/);
    var e_patt = new RegExp(/^[^\s@]+@[^\s@]+\.[^\s@]+$/);


    if(name.val() == "" || name.val().length < 6) {
      name.addClass('border-danger');
      $('#u_error').html('<span class="text-danger">Name is required and should be mpre than 6 characters</span>');
      status = false;
    } else {
      name.removeClass('border-danger');
      $('#u_error').html('');
      status = true;
    }

    if(!e_patt.test(email.val())) {
      email.addClass('border-danger');
      $('#e_error').html('<span class="text-danger">Enter a valid email</span>');
      status = false;
    } else {
      email.removeClass('border-danger');
      $('#e_error').html('');
      status = true;
    }

    if(password.val() == "" || password.val().length < 8) {
      password.addClass('border-danger');
      $('#pass_error').html('<span class="text-danger">Enter a password with more than 8 Characters</span>');
      status = false;
    } else {
      password.removeClass('border-danger');
      $('#pass_error').html('');
      status = true;
    }

    if(cpassword.val() == "" || cpassword.val().length < 8) {
      cpassword.addClass('border-danger');
      $('#cpass_error').html('<span class="text-danger">Enter Password again</span>');
      status = false;
    } else {
      cpassword.removeClass('border-danger');
      $('#cpass_error').html('');
      status = true;
    }

    if(usertype.val() == "") {
      usertype.addClass('border-danger');
      $('#type_error').html('<span class="text-danger">Choose user type</span>');
      status = false;
    } else {
      usertype.removeClass('border-danger');
      $('#type_error').html('');
      status = true;
    }

    if((password.val() == cpassword.val() && status == true)) {
      $.ajax({
        url: DOMAIN+"/includes/process.php",
        method: 'post',
        data: $('#register-form').serialize(),
        success: function (response) {
          if(response == "EMAIL_EXISTS1") {
             alert('Email is used already');
          } else if(response == 'SOME_ERROR') {
             alert('Some Error');
          } else {
            window.location.href = encodeURI(DOMAIN+"/index.php?msg=You are registered, You can now login.");
             //alert(response);
          }
        }
      });
    } else {
      cpassword.addClass('border-danger');
      $('#cpass_error').html('<span class="text-danger">Paswword Mismatch</span>');
      status = true;
    }

  });

  //Login
  $('#form-login').on('submit', function(e) {
    
    var email = $('#email');
    var password = $('#password');
    var status = false;

    if(email.val() == "") {
      email.addClass('border-danger');
      $('#e_error').html('<span class="text-danger">Enter your email</span>');
      status = false;
    } else {
      email.removeClass('border-danger');
      $('e_error').html('');
      status = true;
    }

    if(password.val() == "") {
      password.addClass('border-danger');
      $('#p_error').html('<span class="text-danger">Enter your email</span>');
      status = false;
    } else {
      password.removeClass('border-danger');
      $('#p_error').html('');
      status = true;
    }

    if(status) {
      $('.overlay').show();
      $.ajax({
        url: DOMAIN+"/includes/process.php",
        method: 'post',
        data: $('#form-login').serialize(),
        success: function (response) {
          if(response == "NOT_REGISTERED") {
            $('.overlay').hide();
            email.addClass('border-danger');
            $('#e_error').html('<span class="text-danger">You are not registered</span>');
          } else if(response == 'PASSWORD_UNMATCHED') {
            $('.overlay').hide();
            password.addClass('border-danger');
            $('#p_error').html('<span class="text-danger">Password incorrect</span>');
          } else {
            //console.log(response);
            $('.overlay').hide();
            window.location.href = encodeURI(DOMAIN+"/dashboard.php");
          }
        }
      });
    }

  });

  //Fetch Category
  fetch_category();

  function fetch_category() {
    $.ajax({
      url: DOMAIN+"/includes/process.php",
      method: "post",
      data: {getCategory: 1},
      success: function (response) {
        var root = '<option value="0">Root</option>';
        var choose = '<option value="0">Select Category</option>';
        $('#parent_cat').html(root+response);
        $('#select_cat').html(choose+response);
      }
    });
  }

   //Fetch Brand
   fetch_brand();

   function fetch_brand() {
     $.ajax({
       url: DOMAIN+"/includes/process.php",
       method: "post",
       data: {getBrand: 1},
       success: function (response) {
         var choose = '<option value="0">Select Brand</option>';
         $('#select_brand').html(choose+response);
       }
     });
   }

  //Add Category
  $("#form-category").submit(function () { 
    if($("#cat_name").val() == "") {
      $("#cat_name").addClass('border-danger');
      $('#cat_error').html('<span class="text-danger">Enter a Category name</span>');
    } else {
      $.ajax({
        url: DOMAIN+"/includes/process.php",
        method: "post",
        data: $('#form-category').serialize(),
        success: function (response) {
          if(response == 'CATEGORY_ADDED') {
            $("#cat_name").removeClass('border-danger'); 
            $('#cat_error').html('<span class="text-success">Category added successfully</span>');
            $("#cat_name").val("");
            fetch_category();
          } else {
            alert(response);
          }
        }
      });
    }
    
  });

  // Add Brand

  $("#form-brand").submit(function () { 
    if($("#brand_name").val() == "") {
      $("#brand_name").addClass('border-danger');
      $('#brand_error').html('<span class="text-danger">Enter a Brand name</span>');
    } else {
      $.ajax({
        url: DOMAIN+"/includes/process.php",
        method: "post",
        data: $('#form-brand').serialize(),
        success: function (response) {
          if(response == 'BRAND_ADDED'){
            $("#brand_name").removeClass('border-danger'); 
            $('#brand_error').html('<span class="text-success">Brand added successfully</span>');
            $("#brand_name").val("");
            fetch_brand();
          } else {
            alert(response);
          }
          
        }
      });
    }
    
  });

  // Add Product
  $('#product_form').submit(function (e) {
    //console.log($('#product_form').serialize()); 
    $.ajax({
      url: DOMAIN+"/includes/process.php",
      method: "post",
      data: $('#product_form').serialize(),
      success: function (response) {
        if(response == 'PRODUCT_ADDED'){
          $("#product_qty").val("");
          $("#product_name").val("");
          $("#product_price").val("");
          alert(response)
        } else {
          alert(response);
        }
        
      }
    });
  });



});