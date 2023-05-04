$(document).ready(function(){
      var path = window.location.pathname;
      var url_endpoint = path.substring(path.lastIndexOf("/") + 1);

      ////////////////////////////////////////////////////
      var dataTable_Obj = $('#dt_claus_internal').DataTable({  
        "ajax":{            
            "url": "../Controllers/clausInternalController.php",
            "method": 'POST',
            "data":{"mode":"list_claus_internals","url_endpoint":url_endpoint},
            "dataSrc":"",
        },
        "columns":[
          {"data": "claus_internal_mitarbeiter"},
          {"data": "claus_internal_ehm_nutzer"},
          {"data": "claus_internal_modell"},
          {"data": "claus_internal_seriennummer"},
          {"data": "claus_internal_sichtschutzfolie"},
          {"data": "claus_internal_sonstiges"},
          {"data": "buttons"},
        ],
        "columnDefs":[
            {"className": 'w-150', "target": 3, "orderable":false,}
          ]
      });

      //add button
      $.ajax({
        url:"../Controllers/clausInternalController.php",
        method:"POST",
        data:{"mode":"add_button","url_endpoint":url_endpoint},
        success:function(data){ 
          $('#add_btn').html(data);
        } 
      });
      ////////////////////////////////////////////////////


      $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var current_tab = $(this).prop('name');
        switch(current_tab) {
          case 'internal_tab':
            $.ajax({
              url:"../Controllers/clausInternalController.php",
              method:"POST",
              data:{"mode":"add_button","url_endpoint":url_endpoint},
              success:function(data){ 
                $('#add_btn').html(data);
              } 
            });
          break;
          case 'vw_tab':
            $.ajax({
              url:"../Controllers/clausVWController.php",
              method:"POST",
              data:{"mode":"add_button","url_endpoint":url_endpoint},
              success:function(data){ 
                $('#add_btn').html(data);
              } 
            });
          break;
          default:
        }
      });
  

        // for reset modal when close
      $('#claus_internal_modal').on('hidden.bs.modal', function () {
          $(".claus_internal_title").replaceWith('<h5 class="modal-title claus_internal_title"><b>ADD INTERNAL PC</b></h5>');
          $("#claus_internal_form")[0].reset();
          $("#claus_internal_mode").val("insert");
          $(".claus_internal_btn").show();

        });


      $('.claus_internal_btn').click(function(e){
          e.preventDefault();
          $('#claus_internal_form').parsley().validate();
          if ($('#claus_internal_form').parsley().isValid()) {
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
                url:"../Controllers/clausInternalController.php",
                method:"POST",
                data:$("#claus_internal_form").serialize(),
                beforeSend:function(){  
                  $(this).prop('disabled', false);
                },
                success:function(results){ 
                  // console.log(results);
                 $(this).prop('disabled', true);
                 $("#claus_internal_modal").modal("hide");
                 switch(results) {
                    case 'success':
                      dataTable_Obj.ajax.reload();
                      swal("", "Successfull", "success");
                    break;
                    case 'error':
                      swal("", "Error", "error");
                      $("#claus_internal_modal").modal("hide");
                      $("#claus_internal_form")[0].reset();  
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
      $(document).on('click', '.claus_internal_view_data, .claus_internal_update_data', function(){
         var mode = "updateModal"; 
         var data_id = $(this).prop("id");  
         var button_name = $(this).prop("name");
         
         $.ajax({  
              url:"../Controllers/clausInternalController.php",
              method:"POST",  
              data:{data_id:data_id,mode:mode},  
              success:function(results){
                  var jsonObj = JSON.parse(results);  
                   // changing modal title
                  $(".claus_internal_title").replaceWith('<h5 class="modal-title claus_internal_title"><b>UPDATE INTERNAL PC</b></h5>');
                  $("#claus_internal_mitarbeiter").val(jsonObj.claus_internal_mitarbeiter);
                  $("#claus_internal_ehm_nutzer").val(jsonObj.claus_internal_ehm_nutzer);
                  $("#claus_internal_modell").val(jsonObj.claus_internal_modell);
                  $("#claus_internal_seriennummer").val(jsonObj.claus_internal_seriennummer);
                  $("#claus_internal_sichtschutzfolie").val(jsonObj.claus_internal_sichtschutzfolie);
                  $("#claus_internal_sonstiges").val(jsonObj.claus_internal_sonstiges);
                  $("#claus_internal_details").val(jsonObj.claus_internal_details);
                  $("#claus_internal_data_id").val(jsonObj.claus_internal_id);
                  $("#claus_internal_mode").val("update");

                  switch(button_name) {
                    case 'view_data':
                      $(".claus_internal_title").replaceWith('<h5 class="modal-title claus_internal_title"><b>VIEW INTERNAL PC</b></h5>');
                      $(".claus_internal_btn").hide();
                    break;
                    case 'update_data':
                      $(".claus_internal_btn").show();
                    break;
                  }

                  $("#claus_internal_modal").modal("show");
              }  
             });  
        });

      
// for delete
        $(document).on('click', '.claus_internal_del_data', function(e){
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
                url:"../Controllers/clausInternalController.php",
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
                          $("#claus_internal_modal").modal("hide");  
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