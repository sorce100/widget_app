$(document).ready(function(){
      var path = window.location.pathname;
      var url_endpoint = path.substring(path.lastIndexOf("/") + 1);

      var dataTable_vw_Obj =$('#dt_vw');

      $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var current_tab = $(this).prop('name');
        switch(current_tab) {
          case 'vw_tab':
            dataTable_vw_Obj.DataTable().destroy(); // destroy before re-initializing
            dataTable_vw_Obj.DataTable({
              "ajax":{            
                  "url": "../Controllers/clausVWController.php",
                  "method": 'POST',
                  "data":{"mode":"list_claus_vw","url_endpoint":url_endpoint},
                  "dataSrc":"",
                  "autoWidth": true,
              },
              "columns":[
                {"data": "claus_vw_mitarbeiter"},
                {"data": "claus_vw_ehm_nutzer"},
                {"data": "claus_vw_computername"},
                {"data": "claus_vw_modell"},
                {"data": "claus_vw_seriennummer"},
                {"data": "claus_vw_sichtschutzfolie"},
                {"data": "claus_vw_sonstiges"},
                {"data": "buttons"},
              ],
              "columnDefs":[
                  {"className": 'w-150', "target": 3, "orderable":false,}
                ]
            });
          break;
        }
        
        
      });

      // Check if the table already has a DataTable instance
      // if ($.fn.DataTable.isDataTable(dataTable_vw_Obj)) {
      //   // If it does, destroy the DataTable instance
      //   dataTable_vw_Obj.DataTable().destroy();
      // }
      
      // ////////////////////////////////////////////////////
      // var dataTable_vw_Obj = $('#dt_vw').DataTable({  
      //   "ajax":{            
      //       "url": "../Controllers/clausVWController.php",
      //       "method": 'POST',
      //       "data":{"mode":"list_claus_vw","url_endpoint":url_endpoint},
      //       "dataSrc":"",
      //       "autoWidth": false,
      //   },
      //   "columns":[
      //     {"data": "claus_vw_mitarbeiter"},
      //     {"data": "claus_vw_ehm_nutzer"},
      //     {"data": "claus_vw_computername"},
      //     {"data": "claus_vw_modell"},
      //     {"data": "claus_vw_seriennummer"},
      //     {"data": "claus_vw_sichtschutzfolie"},
      //     {"data": "claus_vw_sonstiges"},
      //     {"data": "buttons"},
      //   ],
      //   "columnDefs":[
      //       {"className": 'w-150', "target": 3, "orderable":false,}
      //     ]
      // });



      //add button
      $.ajax({
        url:"../Controllers/clausVWController.php",
        method:"POST",
        data:{"mode":"add_button","url_endpoint":url_endpoint},
        success:function(data){ 
          $('#add_btn').html(data);
        } 
      });
      // ////////////////////////////////////////////////////
  

        // for reset modal when close
      $('#claus_vw_modal').on('hidden.bs.modal', function () {
          $(".claus_vw_title").replaceWith('<h5 class="modal-title claus_vw_title"><b>ADD INTERNAL PC</b></h5>');
          $("#claus_vw_form")[0].reset();
          $("#claus_vw_mode").val("insert");
          $(".claus_vw_btn").show();

        });


      $('.claus_vw_btn').click(function(e){
          e.preventDefault();
          $('#claus_vw_form').parsley().validate();
          if ($('#claus_vw_form').parsley().isValid()) {
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
                url:"../Controllers/clausVWController.php",
                method:"POST",
                data:$("#claus_vw_form").serialize(),
                beforeSend:function(){  
                  $(this).prop('disabled', false);
                },
                success:function(results){ 
                  console.log(results);
                 $(this).prop('disabled', true);
                 $("#claus_vw_modal").modal("hide");
                 switch(results) {
                    case 'success':
                      $('#dt_vw').DataTable().ajax.reload();
                      swal("", "Successfull", "success");
                    break;
                    case 'error':
                      swal("", "Error", "error");
                      $("#claus_vw_modal").modal("hide");
                      $("#claus_vw_form")[0].reset();  
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
      $(document).on('click', '.claus_vw_view_data, .claus_vw_update_data', function(){
         var mode = "updateModal"; 
         var data_id = $(this).prop("id");  
         var button_name = $(this).prop("name");
         
         $.ajax({  
              url:"../Controllers/clausVWController.php",
              method:"POST",  
              data:{data_id:data_id,mode:mode},  
              success:function(results){
                  var jsonObj = JSON.parse(results);  
                   // changing modal title
                  $(".claus_vw_title").replaceWith('<h5 class="modal-title claus_vw_title"><b>UPDATE VW PC</b></h5>');
                  $("#claus_vw_mitarbeiter").val(jsonObj.claus_vw_mitarbeiter);
                  $("#claus_vw_computername").val(jsonObj.claus_vw_computername);
                  $("#claus_vw_ehm_nutzer").val(jsonObj.claus_vw_ehm_nutzer);
                  $("#claus_vw_modell").val(jsonObj.claus_vw_modell);
                  $("#claus_vw_seriennummer").val(jsonObj.claus_vw_seriennummer);
                  $("#claus_vw_sichtschutzfolie").val(jsonObj.claus_vw_sichtschutzfolie);
                  $("#claus_vw_sonstiges").val(jsonObj.claus_vw_sonstiges);
                  $("#claus_vw_vorl_maschinenummer").val(jsonObj.claus_vw_vorl_maschinenummer);
                  $("#claus_vw_leasing_ende").val(jsonObj.claus_vw_leasing_ende);
                  $("#claus_vw_details").val(jsonObj.claus_vw_details);
                  $("#claus_vw_data_id").val(jsonObj.claus_vw_id);
                  $("#claus_vw_mode").val("update");

                  switch(button_name) {
                    case 'view_data':
                      $(".claus_vw_title").replaceWith('<h5 class="modal-title claus_vw_title"><b>VIEW VW PC</b></h5>');
                      $(".claus_vw_btn").hide();
                    break;
                    case 'update_data':
                      $(".claus_vw_btn").show();
                    break;
                  }

                  $("#claus_vw_modal").modal("show");
              }  
             });  
        });

      
// for delete
        $(document).on('click', '.claus_vw_del_data', function(e){
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
                url:"../Controllers/clausVWController.php",
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
                          $('#dt_vw').DataTable().ajax.reload();
                          swal("", "Successfull", "success");
                          break;
                        case 'error':
                          swal("", "Error", "error");
                          $("#claus_vw_modal").modal("hide");  
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