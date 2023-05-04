$(document).ready(function(){

      ////////////////////////////////////////////////////
      var path = window.location.pathname;
      var url_endpoint = path.substring(path.lastIndexOf("/") + 1);

      var dataTable_Obj = $('#dt_department').DataTable({  
        "ajax":{            
            "url": "../Controllers/departmentController.php",
            "method": 'POST',
            "data":{"mode":"list_departments","url_endpoint":url_endpoint},
            "dataSrc":"",
        },
        "columns":[
          {"data": "department_name"},
          {"data": "department_details"},
          {"data": "buttons"},
        ],
        "columnDefs":[
            {"className": 'w-150', "target": 3, "orderable":false,}
          ]
      });

      //insert button
      $.ajax({
        url:"../Controllers/departmentController.php",
        method:"POST",
        data:{"mode":"add_button","url_endpoint":url_endpoint},
        success:function(data){ 
          $('#add_btn').html(data);
        } 
      });
      ////////////////////////////////////////////////////


      // for reset modal when close
      $('#department_modal').on('hidden.bs.modal', function () {
        $(".modal-title").replaceWith('<h5 class="modal-title"><b>ADD DEPARTMENT</b></h5>');
        $("#department_form")[0].reset();
        $('#department_form').parsley().reset();
        $('.department_btn').replaceWith('<button type="button" class="btn department_btn" id="bg-primary">Save <i class="fa fa-save"></i></button>');
        $('.department_btn').show();
        $('#department_mode').val("insert");
      });

      //for inserting and updating
        $('.department_btn').click(function(e){
          e.preventDefault();
          $('#department_form').parsley().validate();
          if ($('#department_form').parsley().isValid()) {
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
                url:"../Controllers/departmentController.php",
                method:"POST",
                data:$("#department_form").serialize(),
                beforeSend:function(){  
                  $(this).prop('disabled', false);
                },
                success:function(results){ 
                    // console.log(results);
                   $(this).prop('disabled', true);
                   $(".modal-title").replaceWith('<h5 class="modal-title">UPDATE DEPARTMENT</h5>');
                   $("#department_modal").modal("hide");
                   switch(results) {
                      case 'success':
                        dataTable_Obj.ajax.reload();
                        swal("", "Successfull", "success");
                      break;
                      case 'error':
                        swal("", "Error", "error");
                        $("#department_modal").modal("hide");
                        $("#department_form")[0].reset();  
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

      // get details for id
      $(document).on('click', '.update_data, .view_data', function(){
        var mode = "get_department_details"; 
        var data_id = $(this).prop("id");
        var button_name = $(this).prop("name"); 

        $.ajax({  
          url:"../Controllers/departmentController.php",
          method:"POST",  
          data:{data_id:data_id,mode:mode},  
          success:function(results){
            var jsonObj = JSON.parse(results);  
             // changing modal title
            $("#department_name").val(jsonObj.department_name);
            $("#department_details").html(jsonObj.department_details);
            $("#department_data_id").val(jsonObj.department_id);
            $(".modal-title").html("<b>UPDATE DEPARTMENT</b>");
            $("#department_mode").val("update");

            switch(button_name) {
              case 'view_data':
                $(".modal-title").html("<b>VIEW DEPARTMENT</b>");
                $(".department_btn").hide();
              break;
              case 'update_data':
                $(".department_btn").show();
              break;
            }

            $("#department_modal").modal("show");
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
                url:"../Controllers/departmentController.php",
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
                          $("#department_form")[0].reset();  
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