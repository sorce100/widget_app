$(document).ready(function(){

      ////////////////////////////////////////////////////
      var path = window.location.pathname;
      var url_endpoint = path.substring(path.lastIndexOf("/") + 1);


      var dataTable_Obj = $('#dt_pcwidget').DataTable({  
        "ajax":{            
            "url": "../Controllers/pcWidgetController.php",
            "method": 'POST',
            "data":{"mode":"list_pc_widgets","url_endpoint":url_endpoint},
            "dataSrc":"",
        },
        "columns":[
          {"data": "pc_widget_mitarbeiter"},
          {"data": "pc_widget_kuerzel"},
          {"data": "pc_widget_hostname"},
          {"data": "pc_widget_model"},
          {"data": "pc_widget_seriennummer"},
          {"data": "pc_widget_windows10_key"},
          {"data": "pc_widget_bios_pwd"},
          {"data": "buttons"},
        ],
        "columnDefs":[
            {"className": 'w-150', "target": 3, "orderable":false,}
          ]
      });

      //insert button
      $.ajax({
        url:"../Controllers/pcWidgetController.php",
        method:"POST",
        data:{"mode":"add_button","url_endpoint":url_endpoint},
        success:function(data){ 
          $('#add_btn').html(data);
        } 
      });
      ////////////////////////////////////////////////////


      // for reset modal when close
      $('#pc_widget_modal').on('hidden.bs.modal', function () {
        $(".modal-title").replaceWith('<h5 class="modal-title"><b>ADD PC WIDGET</b></h5>');
        $("#pc_widget_form")[0].reset();
        $('#pc_widget_form').parsley().reset();
        $('.pc_widget_btn').show();
        $('#pc_widget_mode').val("insert");
      });

      //for inserting and updating
        $('.pc_widget_btn').click(function(e){
          e.preventDefault();
          $('#pc_widget_form').parsley().validate();
          if ($('#pc_widget_form').parsley().isValid()) {
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
                url:"../Controllers/pcWidgetController.php",
                method:"POST",
                data:$("#pc_widget_form").serialize(),
                beforeSend:function(){  
                  $(this).prop('disabled', false);
                },
                success:function(results){ 
                    // console.log(results);
                   $(this).prop('disabled', true);
                   $(".modal-title").replaceWith('<h5 class="modal-title">UPDATE PC WIDGET</h5>');
                   $("#pc_widget_modal").modal("hide");
                   switch(results) {
                      case 'success':
                        dataTable_Obj.ajax.reload();
                        swal("", "Successfull", "success");
                      break;
                      case 'error':
                        swal("", "Error", "error");
                        $("#pc_widget_modal").modal("hide");
                        $("#pc_widget_form")[0].reset();  
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
        var mode = "get_pc_widget_details"; 
        var data_id = $(this).prop("id");
        var button_name = $(this).prop("name"); 

        $.ajax({  
          url:"../Controllers/pcWidgetController.php",
          method:"POST",  
          data:{data_id:data_id,mode:mode},  
          success:function(results){
            var jsonObj = JSON.parse(results);  
             // changing modal title
            $("#pc_widget_mitarbeiter").val(jsonObj.pc_widget_mitarbeiter);
            $("#pc_widget_kuerzel").val(jsonObj.pc_widget_kuerzel);
            $("#pc_widget_vw_rechner").val(jsonObj.pc_widget_vw_rechner);
            $("#pc_widget_hostname").val(jsonObj.pc_widget_hostname);
            $("#pc_widget_model").val(jsonObj.pc_widget_model);
            $("#pc_widget_seriennummer").val(jsonObj.pc_widget_seriennummer);
            $("#pc_widget_wlan_mac").val(jsonObj.pc_widget_wlan_mac);
            $("#pc_widget_lan_mac").val(jsonObj.pc_widget_lan_mac);
            $("#pc_widget_bitlocker_pin").val(jsonObj.pc_widget_bitlocker_pin);
            $("#pc_widget_office2016_schluessel").val(jsonObj.pc_widget_office2016_schluessel);
            $("#pc_widget_office2019_schluessel").val(jsonObj.pc_widget_office2019_schluessel);
            $("#pc_widget_windows10_key").val(jsonObj.pc_widget_windows10_key);
            $("#pc_widget_bios_pwd").val(jsonObj.pc_widget_bios_pwd);
            $("#pc_widget_details").val(jsonObj.pc_widget_details);
            $("#pc_widget_data_id").val(jsonObj.pc_widget_id);
            $(".modal-title").html("<b>UPDATE PC WIDGET</b>");
            $('#pc_widget_mode').val("update");

            switch(button_name) {
              case 'view_data':
                $(".modal-title").html("<b>VIEW PC WIDGET</b>");
                $(".pc_widget_btn").hide();
              break;
              case 'update_data':
                $(".pc_widget_btn").show();
              break;
            }

            $("#pc_widget_modal").modal("show");
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
                url:"../Controllers/pcWidgetController.php",
                method:"POST",
                data:{data_id:data_id,mode:mode},  
                beforeSend:function(){  
                  $(this).prop("disabled",true); 
                },
                success:function(results){ 
                    // console.log(results);
                     $(this).prop("disabled",false);
                     $("#pc_widget_modal").modal("hide");
                     switch(results) {
                        case 'success':
                          dataTable_Obj.ajax.reload();
                          swal("", "Successfull", "success");
                          break;
                        case 'error':
                          swal("", "Error", "error");
                          $("#pc_widget_modal").modal("hide");
                          $("#pc_widget_form")[0].reset();  
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