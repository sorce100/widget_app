$(document).ready(function(){
  	// login
    $("#login_form").on("submit",function(e){
    e.preventDefault();
          $.ajax({
          url:"Controllers/usersController.php",
          method:"POST",
          data:$("#login_form").serialize(),
          beforeSend:function(){ 
          	$('#login_btn').text("Loading ...").prop("disabled",true); 
          },
          success:function(data){
              // console.log(data);
              data = $.trim(data); 
            // if account is for staff and is successfull
              switch(data) {
                case 'success':
                  window.location.replace("modules/dashboard.php");
                  break;
                case 'error':
                  swal("Error!", "There was an error, try again", "error");
                  $('#user_name').val("").prop('autofocus',true);
                  $('#user_password').val("");
                  $('#login_btn').replaceWith('<button type="submit" class="btn btn-lg btn-block login_btn" id="bg-primary">LOGIN <i class="fa fa-sign-in"></i></button>');
                  break;  
                default:
                  var fields = data.split('-');
                  var user_name = fields[0];
                  var user_password = fields[1];

                  $('#change_password_user_name').val(user_name);
                  $('#change_password').val(user_password);
                  $('#change_password_modal').modal('show');
                  $('#user_name').val("");
                  $('#user_password').val("");
                  $('#login_btn').replaceWith('<button type="submit" class="btn btn-lg btn-block login_btn" id="bg-primary">LOGIN <i class="fa fa-sign-in"></i></button>');
              }

          } 

          });  
      });
    });
// for changing password
   $(document).ready(function(){ 
    // change pass
    	$("#change_password_form").on("submit",function(e){
      	e.preventDefault();
            $.ajax({
            url:"Controllers/usersController.php",
            method:"POST",
            data:$("#change_password_form").serialize(),
            beforeSend:function(){ 
            	$(this).prop("disabled",true); 
            },
            success:function(data){ 
                // console.log(data);
                $(this).prop("disabled",true); 
                switch(data) {
                  case 'success':
                    swal("Congratulation!", "Password change Successfull", "success");
                    $("#change_password_modal").modal("hide");
                    break;
                  case 'error':
                    swal("Error!", "Sorry there was an error", "error");
                    $('#new_user_password').val("");
                    $('#retype_new_user_password').val("");
                    break;
                  default:
                    swal("Error!", "Sorry there was an error! Try again", "error");
                }
            } 

            });  
        });
   });  

