<?php
	require_once("../Classes/Departments.php"); 
	session_start();
	class DepartmentController{
		function __construct(){
			// print_r($_POST);exit();
			switch (trim($_POST["mode"])) {
				// for insert
				case 'insert':
					if ( !empty($_POST["department_name"]) || !empty($_POST["department_details"]) ) {

						$objDepartmentsController = new Departments;
						$objDepartmentsController->set_department_name($objDepartmentsController->CleanData($_POST["department_name"]));
						$objDepartmentsController->set_department_details($objDepartmentsController->CleanData($_POST["department_details"]));
						
						if ($objDepartmentsController->insert()) {
							echo "success";
						}
						else{
							echo "error";
						}
					}
					else{
						echo "error";
					}
					
				break;
			// for update
				case 'update':
					if (!empty($_POST["department_name"]) ||!empty($_POST["department_details"]) ||!empty($_POST["data_id"]) ) {

						$objDepartmentsController = new Departments;
						$objDepartmentsController->set_department_name($objDepartmentsController->CleanData($_POST["department_name"]));
						$objDepartmentsController->set_department_details($objDepartmentsController->CleanData($_POST["department_details"]));;
						$objDepartmentsController->set_id($objDepartmentsController->CleanData($_POST["data_id"]));
						
						if ($objDepartmentsController->update()) {
							echo "success";
						}
						else{
							echo "error";
						}
					}
					else{
						echo "error";
						}
				break;
			// for delete
				case 'delete':
					if(!empty($_POST["data_id"])){
						$objDepartmentsController = new Departments;
						$objDepartmentsController->set_record_hide("YES");
						$objDepartmentsController->set_id($objDepartmentsController->CleanData($_POST["data_id"]));
						if ($objDepartmentsController->delete()) {
							echo "success";
						}else{
							echo "error";
						}
						     
					}else{
						echo "error";
					}
				break;
				// geting by id
				case 'get_department_details':
					if(!empty($_POST["data_id"])){
						$objDepartmentsController = new Departments;
						$objDepartmentsController->set_id($objDepartmentsController->CleanData($_POST["data_id"]));
						$details = $objDepartmentsController->get_department_by_id();
						print_r($details);  
					}else{
						echo "error";
					}
				break;
				// get all
				case 'list_departments':
					if (!empty($_POST['url_endpoint'])) {
						$current_module_id = $_SESSION['user_module_id_url'][$_POST['url_endpoint']]; //use returned module name to get ID
						$permissions = $_SESSION['module_permissions']->$current_module_id; //use ID to get premissions
						$objDepartmentsController = new Departments;
						$data = $objDepartmentsController->list_departments($permissions);
						print json_encode($data, JSON_UNESCAPED_UNICODE);
					}else{
						echo "error";
					}
				break;
				case 'add_button':
					if (!empty($_POST['url_endpoint'])) {
						$current_module_id = $_SESSION['user_module_id_url'][$_POST['url_endpoint']]; //use returned module name to get ID
						$permissions = $_SESSION['module_permissions']->$current_module_id; //use ID to get premissions
						if ($permissions->add_btn == "1") {
							print_r('<button type="button" class="btn btn-outline-info"  data-toggle="modal" data-target="#department_modal" data-backdrop="static" data-keyboard="false">Add New <i class="fa fa-plus"></i></button>');
						}
					}else{
						echo "error";
					}
				break;
				default:
					echo "error";
					break;
			}

		}
	}

	$objDepartmentsController = new DepartmentController;
 ?>