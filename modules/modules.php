<?php 
	require_once('includes/header.php');
    include_once('../Classes/Modules.php'); 

 ?>


<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <!-- <h2>Basic Table <small>Basic example without any additional modification classes</small></h2> -->
                <h3>Modules Setup </h3>
                <ul class="header-dropdown dropdown">
                    <span id="add_btn"></span> 
                </ul>
            </div>
            <hr>
            <div class="body">
                <div class="table-responsive">
                    <table id="dt_modules"  class="table table-hover js-basic-example dataTable table-custom">
                        <thead class="thead-light">
                            <tr>
                                <th>Name</th>
                                <th>Url</th>
                                <th>Added</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="modules_modal" tabindex="-1" role="dialog" aria-labelledby="resetPassModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resetPassModalLabel"><b>ADD MODULES</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form id="modules_form">
                <div class="modal-body">
                  <!--  -->
                    <div class="row">
                        <div class="col-md-3">
                            <label for="title" class="col-form-label">MODULE NAME <span class="badge-danger"> *</span></label>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                              <input type="text" name="pageName" id="pageName" class="form-control" placeholder="Enter Module name" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="title" class="col-form-label">MODULE FILE NAME <span class="badge-danger"> *</span></label>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                              <input type="text" name="pageFileName" id="pageFileName" class="form-control" placeholder="xyz.php" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="title" class="col-form-label">MODULE URL(S) <span class="badge-danger"> *</span></label>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <textarea rows="6" name="pageUrl" id="pageUrl" class="form-control" placeholder="Enter Module url" autocomplete="off" required></textarea>
                              <!-- <input type="text"> -->
                            </div>
                        </div>
                    </div>
                  <!--  -->
                </div>
                <!-- for inserting the page id -->
                <input type="hidden" name="data_id" id="modules_data_id" value="">
                <!-- for insert query -->
                <input type="hidden" name="mode" id="modules_mode" value="insert">
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close <i class="fa fa-times"></i></button>
                    <button type="button" class="btn modules_btn" id="bg-primary">Save <i class="fa fa-save"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php require_once('includes/footer.php'); ?>
<script src="js/modules.js"></script>
