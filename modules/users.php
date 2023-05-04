<?php 
  require_once('includes/header.php');
  require_once('../Classes/Departments.php');
  require_once('../Classes/Groups.php');
 ?>

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h3>USERS </h3>
                <ul class="header-dropdown dropdown">
                    <span id="add_btn"></span>
                </ul>
            </div>
            <hr>
            <div class="body">
                <div class="table-responsive">
                    <table id="dt_users" class="table table-hover js-basic-example dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th><b>USERNAME</b></th>
                                <th><b>DEPARTMENT</b></th>
                                <th><b>GROUP</b></th>
                                <th><b>ACCOUNT STATUS</b></th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="users_modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><b>ADD USER</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form id="users_form">
                <div class="modal-body">
                  <!--  -->
                    <div class="row">
                        <div class="col-md-2">
                            <label for="title" class="col-form-label">USER NAME <span class="badge-danger"> *</span></label>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                              <input type="text" name="user_name" id="user_name" class="form-control" placeholder="" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label for="title" class="col-form-label">PASSWORD <span class="badge-danger"> *</span></label>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <input type="text" name="user_password" id="user_password" class="form-control" placeholder="" autocomplete="off" required>
                            </div>
                        </div>
                        <!-- for password reset -->
                        <div class="col-md-4">
                          <input type="checkbox" id="user_password_reset" data-width="120"/>
                          <input type="hidden" name="user_password_reset_log" id="user_password_reset_log" value="RESET" />

                        </div>
                    </div>
                    <!--  -->
                    <div class="row">
                      <div class="col-md-2">
                        <label for="title" class="col-form-label">DEPARTMENT <span class="badge-danger"> *</span></label>
                      </div>
                      <div class="col-md-10">
                        <div class="form-group">
                            <select class="form-control" id="user_department_id" name="user_department_id" required>
                                <option value="" selected="selected">Select Department</option>
                                <?php 
                                  $obj_department = new Departments;
                                  $departements = $obj_department->get_departments(); 
                                  foreach ($departements as $departement) {
                                      echo '<option value="'.trim($departement["department_id"]).'">'.$departement["department_name"].'</option>';
                                  }
                                ?>
                            </select>
                        </div>
                      </div>
                    </div>
                    <!--  -->
                    <div class="row">
                      <div class="col-md-2">
                        <label for="title" class="col-form-label">GROUP <span class="badge-danger"> *</span></label>
                      </div>
                      <div class="col-md-10">
                        <div class="form-group">
                             <select class="form-control" id="user_group_id" name="user_group_id" required>
                              <option value="" selected="selected">Select Group</option>
                              <?php 
                                  $objGroup = new Groups;
                                  $groups = $objGroup->get_groups(); 
                                  foreach ($groups as $group) {
                                      echo '<option value="'.trim($group["pages_group_id"]).'">'.$group["pages_group_name"].'</option>';
                                  }
                             ?>
                            </select>
                        </div>
                      </div>
                    </div>
                    <!--  -->
                    <div class="row">
                      <div class="col-md-2">
                        <label for="title" class="col-form-label">ACCOUNT STATUS</label>
                      </div>
                      <div class="col-md-10">
                        <input type="checkbox" id="user_account_status" data-width="100"/>
                        <input type="hidden" name="user_account_status_log" id="user_account_status_log" value="ACTIVE" />
                      </div>
                    </div>

                  <!--  -->
                </div>
                <!-- for inserting the id -->
                <input type="hidden" name="data_id" id="user_data_id" value="">
                <!-- for insert query -->
                <input type="hidden" name="mode" id="user_mode" value="insert">
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close <i class="fa fa-times"></i></button>
                    <button type="button" class="btn user_btn" id="bg-primary">Save <i class="fa fa-save"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once('includes/footer.php'); ?>
<script src="js/users.js"></script>
