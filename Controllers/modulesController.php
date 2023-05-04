<?php
	require_once("../Classes/Modules.php"); 
	session_start();
	class ModulesController{
		function __construct(){
			// print_r($_POST);
					switch (trim($_POST["mode"])) {
						// for insert
						case 'insert':
							if ($_POST["pageName"] != "") {
								$objModules = new Modules;
								$objModules->set_pageName($objModules->CleanData($_POST["pageName"]));
								$objModules->set_pageUrl(trim($_POST["pageUrl"]));
								$objModules->set_pageFileName($objModules->CleanData($_POST["pageFileName"]));
								if ($objModules->insert()) {
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
							$objModules = new Modules;
							$objModules->set_pageName($objModules->CleanData($_POST["pageName"]));
							$objModules->set_pageUrl(trim($_POST["pageUrl"]));
							$objModules->set_pageFileName($objModules->CleanData($_POST["pageFileName"]));
							$objModules->set_id($objModules->CleanData($_POST["data_id"]));
							if ($objModules->update()) {
									echo "success";
								}
								else{
									echo "error";
								}
						break;
					// for delete
						case 'delete':
							if(isset($_POST["data_id"])){
									 $objModules = new Modules;
									  $objModules->set_record_hide("YES");
								      $objModules->set_id($objModules->CleanData($_POST["data_id"]));
								      if ($objModules->delete()) {
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
									 $objModules = new Modules;  
								      $objModules->set_id($objModules->CleanData($_POST["data_id"]));
								      $pages_details = $objModules->get_module_by_id();
								      print_r($pages_details);  
								 }else{

								 	echo "error";
								 }
						break;
						// get all
						case 'list_modules':
							if (!empty($_POST['url_endpoint'])) {
								$current_module_id = $_SESSION['user_module_id_url'][$_POST['url_endpoint']]; //use returned module name to get ID
								$permissions = $_SESSION['module_permissions']->$current_module_id; //use ID to get premissions
								$objModules = new Modules;
								$data = $objModules->list_modules($permissions);
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
									print_r('<button type="button" class="btn btn-outline-info"  data-toggle="modal" data-target="#modules_modal" data-backdrop="static" data-keyboard="false">Add New <i class="fa fa-plus"></i></button>');
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

	$objModulesController = new ModulesController;
 ?>