$(document).ready(function () {
  var DOMAIN = "http://localhost:8010";
  //var DOMAIN = "https://byteinventory.herokuapp.com";
  // profile

    var userid = $('#userid').val()
    //alert(userid)
    var username = $('#username').val()
    $.ajax({
      url : DOMAIN+"/includes/process.php",
      method : "POST",
      data : {usid: userid},
      success : function(data){
        console.log(data);
        $("#username").val(data);
      }
    })


});