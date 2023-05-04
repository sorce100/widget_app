<?php 
    require_once('includes/header.php');
    include_once('../Classes/Groups.php'); 
    include_once('../Classes/Modules.php');
 ?>


<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h3>Groups Setup </h3>
                <ul class="header-dropdown dropdown">
                    <span id="add_btn"></span> 
                </ul>
            </div>
            <hr>
            <div class="body">
                <div class="table-responsive">
                    <table id="dt_groups" class="table table-hover js-basic-example dataTable">
                        <thead class="thead-light">
                            <tr>
                              <th>Group Name</th>
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




<!-- modal -->
<div class="modal fade" id="groupsModal" tabindex="-1" role="dialog" aria-labelledby="resetPassModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resetPassModalLabel"><b>ADD GROUP</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form id="group_form" method="POST">
                <div class="modal-body">
                    <!--  -->
                    <div class="row">
                        <div class="col-md-3">
                            <label for="title" class="col-form-label">GROUP NAME <span class="badge-danger"> *</span></label>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                              <input type="text" name="pagesGroupName" id="pagesGroupName" class="form-control" placeholder="Enter Group name" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="title" class="col-form-label">ADD MODULE<span class="badge-danger"> *</span></label>
                        </div>
                        <div class="col-md-9">
                          <div class="table-responsive">
                            <table class="table table-hover"> 
                                <thead id="bg-primary">
                                    <tr>
                                        <th>Select</th>
                                        <th>Module Name</th>
                                        <th>Add</th>
                                        <th>View</th>
                                        <th>Update</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody id="resultsDisplay">
                                    <?php
                                        $objModules = new Modules;
                                        $modules = $objModules->get_modules(); 
                                        foreach ($modules as $module) {
                                          echo '<tr>
                                                    <td>
                                                        <input type="checkbox" class="input-md pagesCheckBox" name="pagesId[]" value="'.trim($module["pages_id"]).'">
                                                    </td>
                                                    <td>'.$module["pages_name"].'</td>
                                                    <td>
                                                        <input type="checkbox" class="input-md add_btn" name="add_btn[]" value="1" disabled>
                                                        <input type="hidden" name="add_btn[]" value="0" disabled>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" class="input-md view_btn" name="view_btn[]" value="1" disabled>
                                                        <input type="hidden" name="view_btn[]" value="0" disabled>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" class="input-md update_btn" name="update_btn[]" value="1" disabled>
                                                        <input type="hidden" name="update_btn[]" value="0" disabled>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" class="input-md delete_btn" name="delete_btn[]" value="1" disabled>
                                                        <input type="hidden" name="delete_btn[]" value="0" disabled>
                                                    </td>
                                                </tr>';
                                        }
                                       ?>
                                </tbody>
                            </table>
                          </div>
                        </div>
                    </div>
                  <!--  -->
                </div>
                <!-- for inserting the id -->
                <input type="hidden" name="data_id" id="groupdata_id" value="">
                <!-- for insert query -->
                <input type="hidden" name="mode" id="groupmode" value="insert">
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close <i class="fa fa-times"></i></button>
                    <button type="submit" class="btn groupsave_btn" id="bg-primary">Save <i class="fa fa-save"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php require_once('includes/footer.php'); ?>
<script src="js/groups.js"></script>
