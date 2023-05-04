<?php 
	require_once('includes/header.php');
    include_once('../Classes/Pcwidget.php');
 ?>


<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h3>DEPARTMENTS SETUP</h3>
                <ul class="header-dropdown dropdown">
                    <span id="add_btn"></span>
                </ul>
            </div>
            <hr>
            <div class="body">
                <div class="table-responsive">
                    <table id="dt_department" class="table table-hover js-basic-example dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th><b>DEPARTMENT NAME</b></th>
                                <th><b>DEPARTMENT DETAILS</b></th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="department_modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><b>ADD DEPARTMENT</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form id="department_form">
                <div class="modal-body">
                  <!--  -->
                    <div class="row">
                        <div class="col-md-3">
                            <label for="title" class="col-form-label">DEPARTMENT NAME <span class="badge-danger"> *</span></label>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                              <input type="text" name="department_name" id="department_name" class="form-control" placeholder="" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="title" class="col-form-label">ADDITIONAL DETAILS </label>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <textarea rows="6" name="department_details" id="department_details" class="form-control" placeholder="" autocomplete="off"></textarea>
                            </div>
                        </div>
                    </div>

                  <!--  -->
                </div>
                <!-- for inserting the id -->
                <input type="hidden" name="data_id" id="department_data_id" value="">
                <!-- for insert query -->
                <input type="hidden" name="mode" id="department_mode" value="insert">
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close <i class="fa fa-times"></i></button>
                    <button type="button" class="btn department_btn" id="bg-primary">Save <i class="fa fa-save"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php require_once('includes/footer.php'); ?>
<script src="js/department.js"></script>
