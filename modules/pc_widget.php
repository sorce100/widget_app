<?php 
	require_once('includes/header.php');
    include_once('../Classes/Pcwidget.php');
 ?>


<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h3>PC WIDGET </h3>
                <ul class="header-dropdown dropdown">
                    <span id="add_btn"></span> 
                </ul>
            </div>
            <hr>
            <div class="body">
                <div class="table-responsive">
                    <table id="dt_pcwidget" class="table table-hover js-basic-example dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th><b>Mitarbeiter</b></th>
                                <th><b>Kuerzel</b></th>
                                <th><b>Hostname</b></th>
                                <th><b>Model</b></th>
                                <th><b>Seriennummer</b></th>
                                <th><b>Windows 10 Key</b></th>
                                <th><b>BIOS PWD</b></th>
                                <th></th>
                            </tr>
                        </thead>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="pc_widget_modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-xxl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><b>ADD PC WIDGET</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form id="pc_widget_form">
                <div class="modal-body">
                  <!--  -->
                  <div class="row">
                      <div class="col-md-5">
                          <!-- first half -->
                          <div class="row">
                            <div class="col-md-3">
                                <label for="title" class="col-form-label">MITARBEITER <span class="badge-danger"> *</span></label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                  <input type="text" name="pc_widget_mitarbeiter" id="pc_widget_mitarbeiter" class="form-control" placeholder="" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="title" class="col-form-label">KÜRZEL <span class="badge-danger"> *</span></label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                  <input type="text" name="pc_widget_kuerzel" id="pc_widget_kuerzel" class="form-control" placeholder="" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="title" class="col-form-label">VW RECHNER <span class="badge-danger"> *</span></label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                  <input type="text" name="pc_widget_vw_rechner" id="pc_widget_vw_rechner" class="form-control" placeholder="" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="title" class="col-form-label">HOSTNAME <span class="badge-danger"> *</span></label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                  <input type="text" name="pc_widget_hostname" id="pc_widget_hostname" class="form-control" placeholder="" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="title" class="col-form-label">MODEL <span class="badge-danger"> *</span></label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                  <input type="text" name="pc_widget_model" id="pc_widget_model" class="form-control" placeholder="" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="title" class="col-form-label">SERIENNUMBER <span class="badge-danger"> *</span></label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                  <input type="text" name="pc_widget_seriennummer" id="pc_widget_seriennummer" class="form-control" placeholder="" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="title" class="col-form-label">WLAN MAC ADDRESS <span class="badge-danger"> *</span></label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                  <input type="text" name="pc_widget_wlan_mac" id="pc_widget_wlan_mac" class="form-control" placeholder="" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="title" class="col-form-label">LAN MAC ADDRESS <span class="badge-danger"> *</span></label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                  <input type="text" name="pc_widget_lan_mac" id="pc_widget_lan_mac" class="form-control" placeholder="" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                          <!-- end of first half -->
                      </div>
                      <div class="col-md-7">
                          <!-- second half -->
                          <div class="row">
                                <div class="col-md-3">
                                    <label for="title" class="col-form-label">BITLOCKER PIN <span class="badge-danger"> *</span></label>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                      <input type="text" name="pc_widget_bitlocker_pin" id="pc_widget_bitlocker_pin" class="form-control" placeholder="" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="title" class="col-form-label">OFFICE2016 SCHLUESSEL <span class="badge-danger"> *</span></label>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                      <input type="text" name="pc_widget_office2016_schluessel" id="pc_widget_office2016_schluessel" class="form-control" placeholder="" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="title" class="col-form-label">OFFICE2019 SCHLUESSEL <span class="badge-danger"> *</span></label>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                      <input type="text" name="pc_widget_office2019_schluessel" id="pc_widget_office2019_schluessel" class="form-control" placeholder="" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="title" class="col-form-label">WINDOWS 10 KEY <span class="badge-danger"> *</span></label>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                      <input type="text" name="pc_widget_windows10_key" id="pc_widget_windows10_key" class="form-control" placeholder="" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="title" class="col-form-label">BIOS PASSWORD <span class="badge-danger"> *</span></label>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                      <input type="text" name="pc_widget_bios_pwd" id="pc_widget_bios_pwd" class="form-control" placeholder="" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="title" class="col-form-label">ADDITIONAL DETAILS </label>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <textarea rows="6" name="pc_widget_details" id="pc_widget_details" class="form-control" placeholder="" autocomplete="off"></textarea>
                                    </div>
                                </div>
                            </div>
                          <!-- end of second half -->
                      </div>
                  </div>
                  <!--  -->
                </div>
                <!-- for inserting the id -->
                <input type="hidden" name="data_id" id="pc_widget_data_id" value="">
                <!-- for insert query -->
                <input type="hidden" name="mode" id="pc_widget_mode" value="insert">
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close <i class="fa fa-times"></i></button>
                    <button type="button" class="btn pc_widget_btn" id="bg-primary">Save <i class="fa fa-save"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php require_once('includes/footer.php'); ?>
<script src="js/pc_widget.js"></script>
