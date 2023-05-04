$(document).ready(function(){
  ////////////////////////////////////////////////////
  var path = window.location.pathname;
  var url_endpoint = path.substring(path.lastIndexOf("/") + 1);

  var dataTable_Obj = $('#dt_users').DataTable({  
    "ajax":{            
        "url": "../Controllers/usersController.php",
        "method": 'POST',
        "data":{"mode":"list_users","url_endpoint":url_endpoint},
        "dataSrc":"",
    },
    "columns":[
      {"data": "user_name"},
      {"data": "department_name"},
      {"data": "pages_group_name"},
      {"data": "user_account_status"},
      {"data": "buttons"},
    ],
    "columnDefs":[
        {"className": 'w-150', "target": 3, "orderable":false,}
      ]
  });

  //insert button
  $.ajax({
    url:"../Controllers/usersController.php",
    method:"POST",
    data:{"mode":"add_button","url_endpoint":url_endpoint},
    success:function(data){ 
      $('#add_btn').html(data);
    } 
  });
  ////////////////////////////////////////////////////


	$('#user_password_reset').bootstrapToggle({
    on: 'LOGIN',
    off: 'RESET',
    onstyle: 'success',
    offstyle: 'danger'
	});
	$('#user_password_reset').change(function(){
	  if($(this).prop('checked')){
	  	$('#user_password_reset_log').val('LOGIN');
	  }else {
	   $('#user_password_reset_log').val('RESET');
	  }
	});


	// eccount status
  $('#user_account_status').bootstrapToggle({
    on: 'ACTIVE',
    off: 'INACTIVE',
    onstyle: 'success',
    offstyle: 'danger'
  });


	// triggring the check
  $('#user_account_status').bootstrapToggle('on');

   $('#user_account_status').change(function(){
    if($(this).prop('checked')){
     $('#user_account_status_log').val('ACTIVE');
    }else{
     $('#user_account_status_log').val('INACTIVE');
    }
  });
	    // end of account status



 	 	$('#users_modal').on('hidden.bs.modal', function () {
	 	  $("#user_mode").val("insert");
	 	  $("#user_password").prop('required',true);
	    $(".modal-title").replaceWith('<h5 class="modal-title"><b>USERS</b></h5>');
	    $("#users_form")[0].reset();
	    $('#users_form').parsley().reset();
      $('.user_btn').show();
    });



 	 	$('.user_btn').click(function(e){
      e.preventDefault();
      $('#users_form').parsley().validate();
      if ($('#users_form').parsley().isValid()) {
        swal({
          title: "Are you sure?",
          text: "",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willRequest) => {
          if (willRequest) {
          e.preventDefault();
          // fields validation
            $.ajax({
            url:"../Controllers/usersController.php",
            method:"POST",
            data:$("#users_form").serialize(),
            beforeSend:function(){  
              $(this).prop('disabled', false);
            },
            success:function(results){ 
                // console.log(results);
               $(this).prop('disabled', true);
               $("#users_modal").modal("hide");
               switch(results) {
                  case 'success':
                    dataTable_Obj.ajax.reload();
                    swal("", "Successful", "success");
                  break;
                  case 'error':
                    swal("", "Error", "error");
                    $("#users_modal").modal("hide");
                    $("#users_form")[0].reset();  
                    break;
                  default:
                    // code block
                }
            } 

            });
          }
        });

      }else{
        swal("", "Kindly fill out form", "error");
      }

    });



   // for update
     $(document).on('click', '.update_data, .view_data', function(){
       let mode = "updateModal"; 
       let data_id = $(this).prop("id");  
       var button_name = $(this).prop("name");

       $.ajax({  
            url:"../Controllers/usersController.php",
            method:"POST",  
            data:{data_id:data_id,mode:mode},  
            success:function(results){
            		// console.log(results);
                 let jsonObj = JSON.parse(results);  
                 // changing modal title
                	$(".modal-title").replaceWith('<h5 class="modal-title"><b>UPDATE USER</b></h5>');
                	////////////////////////////////////////////////////////////////////////////////////////////
                  switch($.trim(jsonObj.user_password_reset)) {
                    case 'LOGIN':
                      $('#user_password_reset').bootstrapToggle('on');
                      break;
                    case 'RESET':
                      $('#user_account_status').bootstrapToggle('off');
                      break;
                  }
                  ///////////////////////////////////////////////////////////////////////////////////////////
                  // if account status is off
                  switch($.trim(jsonObj.user_account_status)) {
                    case 'INACTIVE':
                      $('#user_account_status').bootstrapToggle('off');
                      break;
                    case 'ACTIVE':
                      $('#user_account_status').bootstrapToggle('on');
                      break;
                  }
                  //////////////////////////////////////////////////////////////////////////////////////////
									$("#user_name").val($.trim(jsonObj.user_name));
									$("#user_password").prop('required',false);
									$("#user_department_id").val($.trim(jsonObj.user_department_id)).change();
									$("#user_group_id").val($.trim(jsonObj.user_group_id)).change();
                  $("#user_data_id").val($.trim(jsonObj.user_id));
                  // turn account status button
                  $("#user_mode").val("update");

                  switch(button_name) {
                    case 'view_data':
                      $(".modal-title").replaceWith('<h5 class="modal-title"><b>VIEW USER</b></h5>');
                      $(".user_btn").hide();
                    break;
                    case 'update_data':
                      $(".user_btn").show();
                    break;
                  }

                  $("#users_modal").modal("show");
            }  
           });  
      });
    // for delete
      $(document).on('click', '.del_data', function(e){
          e.preventDefault();

          var mode = "delete"; 
          var data_id = $(this).prop("id");

          swal({
              title: "Are you sure?",
              text: "",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willRequest) => {
              if (willRequest) {

                $.ajax({
                url:"../Controllers/usersController.php",
                method:"POST",
                data:{data_id:data_id,mode:mode},  
                beforeSend:function(){  
                  $(this).prop("disabled",true); 
                },
                success:function(results){ 
                    // console.log(results);
                     $(this).prop("disabled",false);
                     switch(results) {
                        case 'success':
                          dataTable_Obj.ajax.reload();
                          swal("", "Successful", "success");
                          break;
                        case 'error':
                          swal("", "Error", "error");
                          $("#users_form")[0].reset();  
                          break;
                        default:
                          swal("", "Error", "error");
                      }
                } 

                });
              }
            });
 
        });



});