<?php
	require_once("../Classes/Pcwidget.php"); 
	session_start();
	class PcwidgetController{
		function __construct(){
			// print_r($_POST);exit();
			switch (trim($_POST["mode"])) {
				// for insert
				case 'insert':
					if ( !empty($_POST["pc_widget_mitarbeiter"]) || !empty($_POST["pc_widget_kuerzel"]) || !empty($_POST["pc_widget_vw_rechner"]) || !empty($_POST["pc_widget_hostname"]) || !empty($_POST["pc_widget_model"]) || !empty($_POST["pc_widget_seriennummer"]) || !empty($_POST["pc_widget_wlan_mac"]) || !empty($_POST["pc_widget_lan_mac"]) || !empty($_POST["pc_widget_bitlocker_pin"]) || !empty($_POST["pc_widget_office2016_schluessel"]) || !empty($_POST["pc_widget_office2019_schluessel"]) || !empty($_POST["pc_widget_windows10_key"]) || !empty($_POST["pc_widget_bios_pwd"]) ) {

						$objPcwidgetController = new Pcwidget;
						$objPcwidgetController->set_pc_widget_mitarbeiter($objPcwidgetController->CleanData($_POST["pc_widget_mitarbeiter"]));
						$objPcwidgetController->set_pc_widget_kuerzel($objPcwidgetController->CleanData($_POST["pc_widget_kuerzel"]));
						$objPcwidgetController->set_pc_widget_vw_rechner($objPcwidgetController->CleanData($_POST["pc_widget_vw_rechner"]));
						$objPcwidgetController->set_pc_widget_hostname($objPcwidgetController->CleanData($_POST["pc_widget_hostname"]));
						$objPcwidgetController->set_pc_widget_model($objPcwidgetController->CleanData($_POST["pc_widget_model"]));
						$objPcwidgetController->set_pc_widget_seriennummer($objPcwidgetController->CleanData($_POST["pc_widget_seriennummer"]));
						$objPcwidgetController->set_pc_widget_wlan_mac($objPcwidgetController->CleanData($_POST["pc_widget_wlan_mac"]));
						$objPcwidgetController->set_pc_widget_lan_mac($objPcwidgetController->CleanData($_POST["pc_widget_lan_mac"]));
						$objPcwidgetController->set_pc_widget_bitlocker_pin($objPcwidgetController->CleanData($_POST["pc_widget_bitlocker_pin"]));
						$objPcwidgetController->set_pc_widget_office2016_schluessel($objPcwidgetController->CleanData($_POST["pc_widget_office2016_schluessel"]));
						$objPcwidgetController->set_pc_widget_office2019_schluessel($objPcwidgetController->CleanData($_POST["pc_widget_office2019_schluessel"]));
						$objPcwidgetController->set_pc_widget_windows10_key($objPcwidgetController->CleanData($_POST["pc_widget_windows10_key"]));
						$objPcwidgetController->set_pc_widget_bios_pwd($objPcwidgetController->CleanData($_POST["pc_widget_bios_pwd"]));
						$objPcwidgetController->set_pc_widget_details($objPcwidgetController->CleanData($_POST["pc_widget_details"]));
						
						if ($objPcwidgetController->insert()) {
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
					if (!empty($_POST["pc_widget_mitarbeiter"]) ||!empty($_POST["pc_widget_kuerzel"]) ||!empty($_POST["pc_widget_vw_rechner"]) ||!empty($_POST["pc_widget_hostname"]) ||!empty($_POST["pc_widget_model"]) ||!empty($_POST["pc_widget_seriennummer"]) ||!empty($_POST["pc_widget_wlan_mac"]) ||!empty($_POST["pc_widget_lan_mac"]) ||!empty($_POST["pc_widget_bitlocker_pin"]) ||!empty($_POST["pc_widget_office2016_schluessel"]) ||!empty($_POST["pc_widget_office2019_schluessel"]) ||!empty($_POST["pc_widget_windows10_key"]) ||!empty($_POST["pc_widget_bios_pwd"]) ||!empty($_POST["data_id"]) ) {

						$objPcwidgetController = new Pcwidget;
						$objPcwidgetController->set_pc_widget_mitarbeiter($objPcwidgetController->CleanData($_POST["pc_widget_mitarbeiter"]));
						$objPcwidgetController->set_pc_widget_kuerzel($objPcwidgetController->CleanData($_POST["pc_widget_kuerzel"]));
						$objPcwidgetController->set_pc_widget_vw_rechner($objPcwidgetController->CleanData($_POST["pc_widget_vw_rechner"]));
						$objPcwidgetController->set_pc_widget_hostname($objPcwidgetController->CleanData($_POST["pc_widget_hostname"]));
						$objPcwidgetController->set_pc_widget_model($objPcwidgetController->CleanData($_POST["pc_widget_model"]));
						$objPcwidgetController->set_pc_widget_seriennummer($objPcwidgetController->CleanData($_POST["pc_widget_seriennummer"]));
						$objPcwidgetController->set_pc_widget_wlan_mac($objPcwidgetController->CleanData($_POST["pc_widget_wlan_mac"]));
						$objPcwidgetController->set_pc_widget_lan_mac($objPcwidgetController->CleanData($_POST["pc_widget_lan_mac"]));
						$objPcwidgetController->set_pc_widget_bitlocker_pin($objPcwidgetController->CleanData($_POST["pc_widget_bitlocker_pin"]));
						$objPcwidgetController->set_pc_widget_office2016_schluessel($objPcwidgetController->CleanData($_POST["pc_widget_office2016_schluessel"]));
						$objPcwidgetController->set_pc_widget_office2019_schluessel($objPcwidgetController->CleanData($_POST["pc_widget_office2019_schluessel"]));
						$objPcwidgetController->set_pc_widget_windows10_key($objPcwidgetController->CleanData($_POST["pc_widget_windows10_key"]));
						$objPcwidgetController->set_pc_widget_bios_pwd($objPcwidgetController->CleanData($_POST["pc_widget_bios_pwd"]));
						$objPcwidgetController->set_pc_widget_details($objPcwidgetController->CleanData($_POST["pc_widget_details"]));
						$objPcwidgetController->set_id($objPcwidgetController->CleanData($_POST["data_id"]));
						
						if ($objPcwidgetController->update()) {
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
						$objPcwidgetController = new Pcwidget;
						$objPcwidgetController->set_record_hide("YES");
						$objPcwidgetController->set_id($objPcwidgetController->CleanData($_POST["data_id"]));
						if ($objPcwidgetController->delete()) {
							echo "success";
						}else{
							echo "error";
						}
						     
					}else{
						echo "error";
					}
				break;
				// geting widget details by id
				case 'get_pc_widget_details':
					if(!empty($_POST["data_id"])){
						$objPcwidgetController = new Pcwidget;
						$objPcwidgetController->set_id($objPcwidgetController->CleanData($_POST["data_id"]));
						$details = $objPcwidgetController->get_pc_widget_by_id();
						print_r($details);  
					}else{

						 echo "error";
					}
				break;
				// get all
				case 'list_pc_widgets':
					if (!empty($_POST['url_endpoint'])) {
						$current_module_id = $_SESSION['user_module_id_url'][$_POST['url_endpoint']]; //use returned module name to get ID
						$permissions = $_SESSION['module_permissions']->$current_module_id; //use ID to get premissions
						$objPcwidgetController = new Pcwidget;
						$data = $objPcwidgetController->list_pc_widgets($permissions);
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
							print_r('<button type="button" class="btn btn-outline-info"  data-toggle="modal" data-target="#pc_widget_modal" data-backdrop="static" data-keyboard="false">Add New <i class="fa fa-plus"></i></button>');
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

	$objPcwidgetController = new PcwidgetController;
 ?>