$(document).ready(function(){
      var path = window.location.pathname;
      var url_endpoint = path.substring(path.lastIndexOf("/") + 1);

      // check if a module is selected or not and enable the permission checkboxes or disable
      $('input.pagesCheckBox').change(function() {
        if ($(this).is(':checked')) {
          $(this).closest('tr').find('input[type="checkbox"]').not(this).prop('checked', true).prop('disabled', false);
        }
        else if(!$(this).is(':checked')){
          $(this).closest('tr').find('input[type="checkbox"]').not(this).prop('checked', false).prop('disabled', true);
        }
      });


     $('.add_btn, .view_btn, .update_btn, .delete_btn').change(function() { //if unchecked, enable hidden input for default value 0
      var hidden_input = $(this).closest('td').find('input[type="hidden"]');
      if ($(this).is(':checked')) {
        hidden_input.prop('disabled', true);

      }else if(!$(this).is(':checked')){
        hidden_input.prop('disabled', false);
      }
     });


     ////////////////////////////////////////////////////
      var dataTable_Obj = $('#dt_groups').DataTable({  
        "ajax":{            
            "url": "../Controllers/groupsController.php",
            "method": 'POST',
            "data":{"mode":"list_groups","url_endpoint":url_endpoint},
            "dataSrc":"",
        },
        "columns":[
          {"data": "pages_group_name"},
          {"data": "added"},
          {"data": "buttons"},
        ],
        "columnDefs":[
            {"className": 'w-150', "target": 3, "orderable":false,}
          ]
      });

      //insert button
      $.ajax({
        url:"../Controllers/groupsController.php",
        method:"POST",
        data:{"mode":"add_button","url_endpoint":url_endpoint},
        success:function(data){ 
          $('#add_btn').html(data);
        } 
      });
      ////////////////////////////////////////////////////

        // for reset modal when close
      $('#groupsModal').on('hidden.bs.modal', function () {
          $(".modal-title").replaceWith('<h5 class="modal-title"><b>ADD GROUP</b></h5>');
          $("#group_form")[0].reset();
          $('.add_btn, .view_btn, .update_btn, .delete_btn').prop('disabled', true);
          $("#groupmode").val("insert");
          $("#groupdata_id").val();
          $(".groupsave_btn").show();
        });



      //for inserting and updating
         $('.groupsave_btn').click(function(e){
          e.preventDefault();
          $('#group_form').parsley().validate();
          if ($('#group_form').parsley().isValid()) {
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
                url:"../Controllers/groupsController.php",
                method:"POST",
                data:$("#group_form").serialize(),
                beforeSend:function(){  
                  $(this).prop('disabled', false);
                },
                success:function(results){ 
                    // console.log(results);
                   $(this).prop('disabled', true);
                   $("#groupsModal").modal("hide");
                   switch(results) {
                      case 'success':
                        // dataTable_Obj.ajax.reload();
                        dataTable_Obj.ajax.reload(null, false);
                        swal("", "Successfull", "success");
                      break;
                      case 'error':
                        swal("", "Error", "error");
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
              url:"../Controllers/groupsController.php",
              method:"POST",  
              data:{data_id:data_id,mode:mode},  
              success:function(data){
                // $(document).DataTable().destroy();
                    // passing data from server for particular id selected
                   var jsonObj = JSON.parse(data);
                   // passing the group pages array stored in database
                   var groupPagesArray = JSON.parse(jsonObj.pages_id);
                   var groupPagePermissionsArray = JSON.parse(jsonObj.pages_id_permissions);
                   // console.log(grouppagesArray);
                     //looping through all input id with the checkbox id 
                     var checkbox = $('input.pagesCheckBox').each(function(){ 
                        // grabbing the checkboxes values
                        var PagesId = $(this).val(); 
                        // looping througth the array to get the ids
                        if (groupPagesArray != null) {
                            for (var i = 0; i < groupPagesArray.length; ++i) {
                              // for comparing if returned array is contained in the input id's values
                              if (groupPagesArray[i] == PagesId) {
                                // select the checkbox if the id's meet
                                $(this).prop('checked',true).change();

                                var permissions = groupPagePermissionsArray[PagesId]
                                Object.entries(permissions).forEach(([key, value]) => {
                                  switch(key) {
                                    case 'add_btn':
                                    case 'view_btn':
                                    case 'update_btn':
                                    case 'delete_btn':
                                      var closestCheckbox = $(this).closest('tr').find('input.'+key);
                                      // console.log(typeof value);
                                      if (value == "1") {
                                          closestCheckbox.prop("checked", true).change();
                                      } else if (value == "0") {
                                          closestCheckbox.prop("checked", false).change();
                                      }
                                    break;
                                  }
                                });
                              }
                            }
                        }
                     });
                     // $(document).dataTable({ordering: false,});
                     // changing modal title
                     // console.log($.trim(jsonObj.profile));
                    $(".modal-title").replaceWith('<h5 class="modal-title"><b>UPDATE GROUP</b></h5>');
                    $("#groupdata_id").val($.trim(jsonObj.pages_group_id));
                    $("#pagesGroupName").val($.trim(jsonObj.pages_group_name));
                    $("#groupmode").val("update");

                    switch(button_name) {
                      case 'view_data':
                        $(".modal-title").replaceWith('<h5 class="modal-title"><b>VIEW GROUP</b></h5>');
                        $(".groupsave_btn").hide();
                      break;
                      case 'update_data':
                        $(".groupsave_btn").show();
                      break;
                    }

                    $("#groupsModal").modal("show");
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
                url:"../Controllers/groupsController.php",
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
                          $("#groupsModal").modal("hide");  
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