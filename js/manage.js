
    $(document).ready(function () {
      var DOMAIN = "http://localhost:8010";
      //var DOMAIN = "https://byteinventory.herokuapp.com";
    
      //Mange Category
      manageCategory(1);
      function manageCategory(pn){
        $.ajax({
          url : DOMAIN+"/includes/process.php",
          method : "POST",
          data : {manageCategory:1,pageno:pn},
          success : function(data){
            $("#get_category").html(data);		
          }
        })
      }

      $("body").delegate(".page-link","click",function(){
        var pn = $(this).attr("pn");
        manageCategory(pn);
      })

      $("body").delegate(".del_cat","click",function(){
        var did = $(this).attr("did");
        //alert(did)
        if (confirm("Are you sure ? You want to delete..!")) {
          $.ajax({
            url : DOMAIN+"/includes/process.php",
            method : "POST",
            data : {deleteCategory:1,id:did},
            success : function(data){
              if (data == "DEPENDENT_CATEGORY") {
                alert("Sorry ! this Category is dependent on other sub categories");
              }else if(data == "CATEGORY_DELETED"){
                alert("Category Deleted Successfully..! happy");
                manageCategory(1);
              }else if(data == "DELETED"){
                alert("Deleted Successfully");
              }else{
                alert(data);
              }
            }
          })
        }else{
    
        }
      })

          //Fetch category
      fetch_category();
      function fetch_category(){
        $.ajax({
          url : DOMAIN+"/includes/process.php",
          method : "POST",
          data : {getCategory:1},
          success : function(data){
            var root = "<option value='0'>Root</option>";
            var choose = "<option value=''>Choose Category</option>";
            $("#parent_cat").html(root+data);
            $("#select_cat").html(choose+data);
          }
        })
      }

          //Update Category
      $("body").delegate(".edit_cat","click",function(){
        var eid = $(this).attr("eid");
        $.ajax({
          url : DOMAIN+"/includes/process.php",
          method : "POST",
          dataType : "json",
          data : {updateCategory:1,id:eid},
          success : function(data){
            console.log(data);
            $("#cid").val(data["id"]);
            $("#update_category").val(data["category_name"]);
            $("#parent_cat").val(data["parent_cat"]);
          }
        })
      })

      $("#update_category_form").on("submit",function(){
        if ($("#update_category").val() == "") {
          $("#update_category").addClass("border-danger");
          $("#cat_error").html("<span class='text-danger'>Please Enter Category Name</span>");
        }else{
          $.ajax({
            url : DOMAIN+"/includes/process.php",
            method : "POST",
            data  : $("#update_category_form").serialize(),
            success : function(data){
              window.location.href = "";
              //alert(data)
            }
          })
        }
      })

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

      //  Mange Brand

      manageBrand(1);
      function manageBrand(pn){
        $.ajax({
          url : DOMAIN+"/includes/process.php",
          method : "POST",
          data : {manageBrand:1,pageno:pn},
          success : function(data){
            $("#get_brand").html(data);		
          }
        })
      }

      $("body").delegate(".page-link","click",function(){
        var pn = $(this).attr("pn");
        manageBrand(pn);
      })

      $("body").delegate(".del_brand","click",function(){
        var did = $(this).attr("did");
        if (confirm("Are you sure ? You want to delete..!")) {
          $.ajax({
            url : DOMAIN+"/includes/process.php",
            method : "POST",
            data : {deleteBrand:1,id:did},
            success : function(data){
              if (data == "DELETED") {
                manageBrand(1);
                alert("Brand is Deleted");
              } else{
                alert(data);
              }
            }
          })
        }else{
    
        }
      })

      // Update Brand
      $("body").delegate(".edit_brand","click",function(){
        var eid = $(this).attr("eid");
        $.ajax({
          url : DOMAIN+"/includes/process.php",
          method : "POST",
          dataType : "json",
          data : {updateBrand:1,id:eid},
          success : function(data){
            console.log(data);
            $("#bid").val(data["bid"]);
            $("#update_brand").val(data["brand_name"]);
          }
        })
      })

      $("#update_brand_form").on("submit",function(){
        if ($("#update_brand").val() == "") {
          $("#update_brand").addClass("border-danger");
          $("#brand_error").html("<span class='text-danger'>Please Enter Brand Name</span>");
        }else{
          $.ajax({
            url : DOMAIN+"/includes/process.php",
            method : "POST",
            data  : $("#update_brand_form").serialize(),
            success : function(data){
              alert(data)
              window.location.href = "";
              //alert(data)
            }
          })
        }
      })

       //  Mange Product*************

       manageProduct(1);
       function manageProduct(pn){
         $.ajax({
           url : DOMAIN+"/includes/process.php",
           method : "POST",
           data : {manageProduct:1,pageno:pn},
           success : function(data){
             $("#get_product").html(data);		
           }
         })
       }
 
       $("body").delegate(".page-link","click",function(){
         var pn = $(this).attr("pn");
         manageProduct(pn);
       })

       //Delete Product

       $("body").delegate(".del_product","click",function(){
        var did = $(this).attr("did");
        if (confirm("Are you sure ? You want to delete..!")) {
          $.ajax({
            url : DOMAIN+"/includes/process.php",
            method : "POST",
            data : {deleteProduct:1,id:did},
            success : function(data){
              if (data == "DELETED") {
                manageProduct(1);
                alert("Product is Deleted");
              } else{
                alert(data);
              }
            }
          })
        }else{
    
        }
      })

      // Update Product
      $("body").delegate(".edit_product","click",function(){
        var eid = $(this).attr("eid");
        $.ajax({
          url : DOMAIN+"/includes/process.php",
          method : "POST",
          dataType : "json",
          data : {updateProduct:1,id:eid},
          success : function(data){
            console.log(data);
            $("#pid").val(data["pid"]);
            $("#update_product").val(data["product_name"]);
            $("#select_cat").val(data["cid"]);
            $("#select_brand").val(data["bid"]);
            $("#product_price").val(data["product_price"]);
            $("#product_qty").val(data["product_stock"]);
          }
        })
      })

      $('#update_product_form').submit(function (e) {
        $.ajax({
          url: DOMAIN+"/includes/process.php",
          method: "post",
          data: $('#update_product_form').serialize(),
          success: function (response) {
            if(response == 'UPDATED'){
              alert(response)
              window.location.href = "";
            } else {
              alert(response);
            }
          }
        });
      });

      

    });