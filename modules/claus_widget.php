<?php 
    require_once('includes/header.php');
 ?>


<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h3>Intenal & VW - PC </h3>
                <ul class="header-dropdown dropdown">
                    <span id="add_btn"></span> 
                </ul>
            </div>
            <hr>
            <div class="body">
                <ul class="nav nav-tabs4" style="background-color: #6F6F6F;">
                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#internal_tab" name="internal_tab"><i class="fa fa-desktop"></i> INTERNAL PC</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#vw_tab" name="vw_tab"><i class="fa fa-laptop"></i> VW PC</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane show active" id="internal_tab">
                        <div class="table-responsive">
                            <table id="dt_claus_internal" class="table table-hover js-basic-example dataTable">
                                <thead class="thead-light">
                                    <tr>
                                      <th>Mitarbeiter</th>
                                      <th>Ehm Nutzer</th>
                                      <th>Modell</th>
                                      <th>Serienummer</th>
                                      <th>Sichtschutzfolie</th>
                                      <th>Sonstiges</th>
                                      <th></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="vw_tab">
                        <div class="table-responsive">
                            <table id="dt_vw" class="table table-hover js-basic-example dataTable">
                                <thead class="thead-light">
                                    <tr>
                                      <th>Mitarbeiter</th>
                                      <th>Ehm Nutzer</th>
                                      <th>Computername</th>
                                      <th>Modell</th>
                                      <th>Serienummer</th>
                                      <th>Sichtschutzfolie</th>
                                      <th>Sonstiges</th>
                                      <th></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- modal -->
<div class="modal fade" id="claus_internal_modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title claus_internal_title"><b>ADD INTERNAL PC</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form id="claus_internal_form">
                <div class="modal-body">
                  <!--  -->
                          <div class="row">
                            <div class="col-md-3">
                                <label for="title" class="col-form-label">MITARBEITER <span class="badge-danger"> *</span></label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                  <input type="text" name="claus_internal_mitarbeiter" id="claus_internal_mitarbeiter" class="form-control" placeholder="" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="title" class="col-form-label">EHM NUTZER <span class="badge-danger"> *</span></label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                  <input type="text" name="claus_internal_ehm_nutzer" id="claus_internal_ehm_nutzer" class="form-control" placeholder="" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="title" class="col-form-label">MODELL <span class="badge-danger"> *</span></label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                  <input type="text" name="claus_internal_modell" id="claus_internal_modell" class="form-control" placeholder="" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="title" class="col-form-label">SERIENNUMBER <span class="badge-danger"> *</span></label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                  <input type="text" name="claus_internal_seriennummer" id="claus_internal_seriennummer" class="form-control" placeholder="" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="title" class="col-form-label">SICHTSCHUTZFOLIE <span class="badge-danger"> *</span></label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                  <input type="text" name="claus_internal_sichtschutzfolie" id="claus_internal_sichtschutzfolie" class="form-control" placeholder="" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="title" class="col-form-label">SONSTIGES <span class="badge-danger"> *</span></label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                  <input type="text" name="claus_internal_sonstiges" id="claus_internal_sonstiges" class="form-control" placeholder="" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="title" class="col-form-label">ADDITIONAL DETAILS </label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <textarea rows="6" name="claus_internal_details" id="claus_internal_details" class="form-control" placeholder="" autocomplete="off"></textarea>
                                </div>
                            </div>
                        </div>
                  </div>
                  <!--  -->
                <!-- for inserting the id -->
                <input type="hidden" name="data_id" id="claus_internal_data_id" value="">
                <!-- for insert query -->
                <input type="hidden" name="mode" id="claus_internal_mode" value="insert">
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close <i class="fa fa-times"></i></button>
                    <button type="button" class="btn claus_internal_btn" id="bg-primary">Save <i class="fa fa-save"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--  -->

<div class="modal fade" id="claus_vw_modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title claus_vw_title"><b>ADD VW PC</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form id="claus_vw_form">
                <div class="modal-body">
                  <!--  -->
                          <div class="row">
                            <div class="col-md-3">
                                <label for="title" class="col-form-label">MITARBEITER <span class="badge-danger"> *</span></label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                  <input type="text" name="claus_vw_mitarbeiter" id="claus_vw_mitarbeiter" class="form-control" placeholder="" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="title" class="col-form-label">EHM NUTZER <span class="badge-danger"> *</span></label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                  <input type="text" name="claus_vw_ehm_nutzer" id="claus_vw_ehm_nutzer" class="form-control" placeholder="" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="title" class="col-form-label">COMPTUTERNAME <span class="badge-danger"> *</span></label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                  <input type="text" name="claus_vw_computername" id="claus_vw_computername" class="form-control" placeholder="" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="title" class="col-form-label">MODELL <span class="badge-danger"> *</span></label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                  <input type="text" name="claus_vw_modell" id="claus_vw_modell" class="form-control" placeholder="" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="title" class="col-form-label">SERIENNUMBER <span class="badge-danger"> *</span></label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                  <input type="text" name="claus_vw_seriennummer" id="claus_vw_seriennummer" class="form-control" placeholder="" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="title" class="col-form-label">SICHTSCHUTZFOLIE <span class="badge-danger"> *</span></label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                  <input type="text" name="claus_vw_sichtschutzfolie" id="claus_vw_sichtschutzfolie" class="form-control" placeholder="" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="title" class="col-form-label">SONSTIGES <span class="badge-danger"> *</span></label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                  <input type="text" name="claus_vw_sonstiges" id="claus_vw_sonstiges" class="form-control" placeholder="" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="title" class="col-form-label">VORL MASCHINENUMMER <span class="badge-danger"> *</span></label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                  <input type="text" name="claus_vw_vorl_maschinenummer" id="claus_vw_vorl_maschinenummer" class="form-control" placeholder="" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="title" class="col-form-label">LEASING ENDE <span class="badge-danger"> *</span></label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                  <input type="text" name="claus_vw_leasing_ende" id="claus_vw_leasing_ende" class="form-control" placeholder="" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="title" class="col-form-label">ADDITIONAL DETAILS </label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <textarea rows="6" name="claus_vw_details" id="claus_vw_details" class="form-control" placeholder="" autocomplete="off"></textarea>
                                </div>
                            </div>
                        </div>
                  <!--  -->
                </div>
                <!-- for inserting the id -->
                <input type="hidden" name="data_id" id="claus_vw_data_id" value="">
                <!-- for insert query -->
                <input type="hidden" name="mode" id="claus_vw_mode" value="insert">
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close <i class="fa fa-times"></i></button>
                    <button type="button" class="btn claus_vw_btn" id="bg-primary">Save <i class="fa fa-save"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php require_once('includes/footer.php'); ?>
<script src="js/claus_internal.js"></script>
<script src="js/claus_vw.js"></script>