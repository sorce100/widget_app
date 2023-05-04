$(document).ready(function(){
      var path = window.location.pathname;
      var url_endpoint = path.substring(path.lastIndexOf("/") + 1);

      ////////////////////////////////////////////////////
      var dataTable_Obj = $('#dt_modules').DataTable({  
        "ajax":{            
            "url": "../Controllers/modulesController.php",
            "method": 'POST',
            "data":{"mode":"list_modules","url_endpoint":url_endpoint},
            "dataSrc":"",
        },
        "columns":[
          {"data": "pages_name"},
          {"data": "pages_url"},
          {"data": "added"},
          {"data": "buttons"},
        ],
        "columnDefs":[
            {"className": 'w-150', "target": 3, "orderable":false,}
          ]
      });

      //insert button
      $.ajax({
        url:"../Controllers/modulesController.php",
        method:"POST",
        data:{"mode":"add_button","url_endpoint":url_endpoint},
        success:function(data){ 
          $('#add_btn').html(data);
        } 
      });
      ////////////////////////////////////////////////////
  

        // for reset modal when close
      $('#modules_modal').on('hidden.bs.modal', function () {
          $(".modal-title").replaceWith('<h5 class="modal-title"><b>ADD MODULES</b></h5>');
          $("#modules_form")[0].reset();
          $("#modules_mode").val("insert");
          $(".modules_btn").show();

        });


      $('.modules_btn').click(function(e){
          e.preventDefault();
          $('#modules_form').parsley().validate();
          if ($('#modules_form').parsley().isValid()) {
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
                url:"../Controllers/modulesController.php",
                method:"POST",
                data:$("#modules_form").serialize(),
                beforeSend:function(){  
                  $(this).prop('disabled', false);
                },
                success:function(results){ 
                    // console.log(results);
                   $(this).prop('disabled', true);
                   $("#modules_modal").modal("hide");
                   switch(results) {
                      case 'success':
                        dataTable_Obj.ajax.reload();
                        swal("", "Successfull", "success");
                      break;
                      case 'error':
                        swal("", "Error", "error");
                        $("#modules_modal").modal("hide");
                        $("#modules_form")[0].reset();  
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
         var mode = "updateModal"; 
         var data_id = $(this).prop("id");  
         var button_name = $(this).prop("name");
         $.ajax({  
              url:"../Controllers/modulesController.php",
              method:"POST",  
              data:{data_id:data_id,mode:mode},  
              success:function(results){
                  var jsonObj = JSON.parse(results);  
                   // changing modal title
                  $(".modal-title").replaceWith('<h5 class="modal-title"><b>UPDATE MODULES</b></h5>');
                  $("#pageName").val(jsonObj.pages_name);
                  $("#pageUrl").val(jsonObj.pages_url);
                  $("#pageFileName").val(jsonObj.page_file_name);
                  $("#modules_data_id").val(jsonObj.pages_id);
                  $("#modules_mode").val("update");

                  switch(button_name) {
                    case 'view_data':
                      $(".modal-title").replaceWith('<h5 class="modal-title"><b>VIEW MODULES</b></h5>');
                      $(".modules_btn").hide();
                    break;
                    case 'update_data':
                      $(".modules_btn").show();
                    break;
                  }

                  $("#modules_modal").modal("show");
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
                url:"../Controllers/modulesController.php",
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
                          swal("", "Successfull", "success");
                          break;
                        case 'error':
                          swal("", "Error", "error");
                          $("#modules_modal").modal("hide");  
                          break;
                        default:
                          // code block
                      }
                } 

                });
              }
            });
        });

});  