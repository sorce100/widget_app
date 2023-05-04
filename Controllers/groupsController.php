<?php
	require_once("../Classes/Groups.php"); 
	session_start();
	class GroupsController{
		function __construct(){
			// print_r($_POST);
			switch (trim($_POST["mode"])) {
				// for insert
				case 'insert':
					if (!empty($_POST["pagesGroupName"]) ) {
						$main_permissions = [];

						foreach ($_POST["pagesId"] as $key => $page_id) { //create sub array with page id as index and the sub array and the permission for addBtn, viewBtn, updateBtn, deleteBtn
							$page_permissions = array();
							$page_permissions["add_btn"] = trim($_POST["add_btn"][$key]);
							$page_permissions["view_btn"] = trim($_POST["view_btn"][$key]);
							$page_permissions["update_btn"] = trim($_POST["update_btn"][$key]);
							$page_permissions["delete_btn"] = trim($_POST["delete_btn"][$key]);

							$main_permissions[$page_id] = $page_permissions;
						}

						$objGroups = new Groups;
						$objGroups->set_pagesGroupName($objGroups->CleanData($_POST["pagesGroupName"]));
						$objGroups->set_pagesId(json_encode($_POST["pagesId"]));
						$objGroups->set_pages_id_permissions(json_encode($main_permissions));
						if ($objGroups->insert()) {
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
					if (!empty($_POST["pagesGroupName"]) ) {	
						$main_permissions = [];

						foreach ($_POST["pagesId"] as $key => $page_id) { //create sub array with page id as index and the sub array and the permission for addBtn, viewBtn, updateBtn, deleteBtn
							$page_permissions = array();
							$page_permissions["add_btn"] = trim($_POST["add_btn"][$key]);
							$page_permissions["view_btn"] = trim($_POST["view_btn"][$key]);
							$page_permissions["update_btn"] = trim($_POST["update_btn"][$key]);
							$page_permissions["delete_btn"] = trim($_POST["delete_btn"][$key]);

							$main_permissions[$page_id] = $page_permissions;
						}

						$objGroups = new Groups;
						$objGroups->set_pagesGroupName($objGroups->CleanData($_POST["pagesGroupName"]));
						$objGroups->set_pagesId(json_encode($_POST["pagesId"]));
						$objGroups->set_pages_id_permissions(json_encode($main_permissions));
						$objGroups->set_id($objGroups->CleanData($_POST["data_id"]));
						if ($objGroups->update()) {
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
					if(isset($_POST["data_id"])){
							  $objGroups = new Groups;
							  $objGroups->set_record_hide("YES");
						      $objGroups->set_id($objGroups->CleanData($_POST["data_id"]));
						      if ($objGroups->delete()) {
						      	echo "success";
						      }
						      else{
						      	echo "error";
						      }
						     
						 }else{die();}
				break;
				// geting details of a member with id
				case 'updateModal':
					if($_POST["data_id"] != ""){
					  $objGroups = new Groups;  
				      $objGroups->set_id($objGroups->CleanData($_POST["data_id"]));
				      $pages_details = $objGroups->get_group_by_id();
				      print_r($pages_details);  
					}else{
						echo "error";
					}
				break;
				// get all
				case 'list_groups':
					if (!empty($_POST['url_endpoint'])) {
						$current_module_id = $_SESSION['user_module_id_url'][$_POST['url_endpoint']]; //use returned module name to get ID
						$permissions = $_SESSION['module_permissions']->$current_module_id; //use ID to get premissions
						$objGroups = new Groups;
						$data = $objGroups->list_groups($permissions);
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
							print_r('<button type="button" class="btn btn-outline-info"  data-toggle="modal" data-target="#groupsModal">Add New <i class="fa fa-plus"></i></button>');
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

	$objGroupsController = new GroupsController;
 ?>