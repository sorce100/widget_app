<?php
	require_once("../Classes/ClausInternal.php"); 
	session_start();
	class ClausInternalController{
		function __construct(){
			// print_r($_POST);
			switch (trim($_POST["mode"])) {
				// for insert
				case 'insert':
					if ( !empty($_POST["claus_internal_mitarbeiter"]) || !empty($_POST["claus_internal_ehm_nutzer"]) || !empty($_POST["claus_internal_modell"]) || !empty($_POST["claus_internal_seriennummer"]) || !empty($_POST["claus_internal_sichtschutzfolie"]) || !empty($_POST["claus_internal_sonstiges"]) || !empty($_POST["claus_internal_details"]) ) {

						$objClausInternal = new ClausInternal;
						$objClausInternal->set_claus_internal_mitarbeiter($objClausInternal->CleanData($_POST["claus_internal_mitarbeiter"]));
						$objClausInternal->set_claus_internal_ehm_nutzer($objClausInternal->CleanData($_POST["claus_internal_ehm_nutzer"]));
						$objClausInternal->set_claus_internal_modell($objClausInternal->CleanData($_POST["claus_internal_modell"]));
						$objClausInternal->set_claus_internal_seriennummer($objClausInternal->CleanData($_POST["claus_internal_seriennummer"]));
						$objClausInternal->set_claus_internal_sichtschutzfolie($objClausInternal->CleanData($_POST["claus_internal_sichtschutzfolie"]));
						$objClausInternal->set_claus_internal_sonstiges($objClausInternal->CleanData($_POST["claus_internal_sonstiges"]));
						$objClausInternal->set_claus_internal_details($objClausInternal->CleanData($_POST["claus_internal_details"]));
						if ($objClausInternal->insert()) {
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
					if ( !empty($_POST["claus_internal_mitarbeiter"]) || !empty($_POST["claus_internal_ehm_nutzer"]) || !empty($_POST["claus_internal_modell"]) || !empty($_POST["claus_internal_seriennummer"]) || !empty($_POST["claus_internal_sichtschutzfolie"]) || !empty($_POST["claus_internal_sonstiges"]) || !empty($_POST["claus_internal_details"]) || !empty($_POST["data_id"]) ) {

						$objClausInternal = new ClausInternal;
						$objClausInternal->set_claus_internal_mitarbeiter($objClausInternal->CleanData($_POST["claus_internal_mitarbeiter"]));
						$objClausInternal->set_claus_internal_ehm_nutzer($objClausInternal->CleanData($_POST["claus_internal_ehm_nutzer"]));
						$objClausInternal->set_claus_internal_modell($objClausInternal->CleanData($_POST["claus_internal_modell"]));
						$objClausInternal->set_claus_internal_seriennummer($objClausInternal->CleanData($_POST["claus_internal_seriennummer"]));
						$objClausInternal->set_claus_internal_sichtschutzfolie($objClausInternal->CleanData($_POST["claus_internal_sichtschutzfolie"]));
						$objClausInternal->set_claus_internal_sonstiges($objClausInternal->CleanData($_POST["claus_internal_sonstiges"]));
						$objClausInternal->set_claus_internal_details($objClausInternal->CleanData($_POST["claus_internal_details"]));
						$objClausInternal->set_id($objClausInternal->CleanData($_POST["data_id"]));
						if ($objClausInternal->update()) {
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
						$objClausInternal = new ClausInternal;
						$objClausInternal->set_record_hide("YES");
					    $objClausInternal->set_id($objClausInternal->CleanData($_POST["data_id"]));
					    if ($objClausInternal->delete()) {
					      echo "success";
					    }
					    else{
					      echo "error";
					    }
					     
					 }else{echo "error";}
				break;
				// geting details of a member with id
				case 'updateModal':
					if(!empty($_POST["data_id"])){
					  $objClausInternal = new ClausInternal;  
				      $objClausInternal->set_id($objClausInternal->CleanData($_POST["data_id"]));
				      $details = $objClausInternal->get_claus_internal_by_id();
				      print_r($details);  
					}else{
						echo "error";
					}
				break;
				// get all
				case 'list_claus_internals':
					if (!empty($_POST['url_endpoint'])) {
						$current_module_id = $_SESSION['user_module_id_url'][$_POST['url_endpoint']]; //use returned module name to get ID
						$permissions = $_SESSION['module_permissions']->$current_module_id; //use ID to get premissions
						$objClausInternal = new ClausInternal;
						$data = $objClausInternal->list_claus_internals($permissions);
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
							print_r('<button type="button" class="btn btn-outline-info"  data-toggle="modal" data-target="#claus_internal_modal">Add New <i class="fa fa-plus"></i></button>');
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

	$objClausInternalController = new ClausInternalController;
 ?>