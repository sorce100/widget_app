<?php
	require_once("../Classes/ClausVW.php"); 
	session_start();
	class ClausVWController{
		function __construct(){
			// print_r($_POST);
			switch (trim($_POST["mode"])) {
				// for insert
				case 'insert':
					if ( !empty($_POST["claus_vw_mitarbeiter"]) || !empty($_POST["claus_vw_computername"]) || !empty($_POST["claus_vw_ehm_nutzer"]) || !empty($_POST["claus_vw_modell"]) || !empty($_POST["claus_vw_seriennummer"]) || !empty($_POST["claus_vw_sichtschutzfolie"]) || !empty($_POST["claus_vw_sonstiges"]) || !empty($_POST["claus_vw_vorl_maschinenummer"]) || !empty($_POST["claus_vw_leasing_ende"]) ) {

						$objClausVW = new ClausVW;
						$objClausVW->set_claus_vw_mitarbeiter($objClausVW->CleanData($_POST["claus_vw_mitarbeiter"]));
						$objClausVW->set_claus_vw_computername($objClausVW->CleanData($_POST["claus_vw_computername"]));
						$objClausVW->set_claus_vw_ehm_nutzer($objClausVW->CleanData($_POST["claus_vw_ehm_nutzer"]));
						$objClausVW->set_claus_vw_modell($objClausVW->CleanData($_POST["claus_vw_modell"]));
						$objClausVW->set_claus_vw_seriennummer($objClausVW->CleanData($_POST["claus_vw_seriennummer"]));
						$objClausVW->set_claus_vw_sichtschutzfolie($objClausVW->CleanData($_POST["claus_vw_sichtschutzfolie"]));
						$objClausVW->set_claus_vw_sonstiges($objClausVW->CleanData($_POST["claus_vw_sonstiges"]));
						$objClausVW->set_claus_vw_vorl_maschinenummer($objClausVW->CleanData($_POST["claus_vw_vorl_maschinenummer"]));
						$objClausVW->set_claus_vw_leasing_ende($objClausVW->CleanData($_POST["claus_vw_leasing_ende"]));
						$objClausVW->set_claus_vw_details($objClausVW->CleanData($_POST["claus_vw_details"]));
						if ($objClausVW->insert()) {
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
					if ( !empty($_POST["claus_vw_mitarbeiter"]) || !empty($_POST["claus_vw_computername"]) || !empty($_POST["claus_vw_ehm_nutzer"]) || !empty($_POST["claus_vw_modell"]) || !empty($_POST["claus_vw_seriennummer"]) || !empty($_POST["claus_vw_sichtschutzfolie"]) || !empty($_POST["claus_vw_sonstiges"]) || !empty($_POST["claus_vw_vorl_maschinenummer"]) || !empty($_POST["claus_vw_leasing_ende"]) || !empty($_POST["data_id"]) ){

						$objClausVW = new ClausVW;
						$objClausVW->set_claus_vw_mitarbeiter($objClausVW->CleanData($_POST["claus_vw_mitarbeiter"]));
						$objClausVW->set_claus_vw_computername($objClausVW->CleanData($_POST["claus_vw_computername"]));
						$objClausVW->set_claus_vw_ehm_nutzer($objClausVW->CleanData($_POST["claus_vw_ehm_nutzer"]));
						$objClausVW->set_claus_vw_modell($objClausVW->CleanData($_POST["claus_vw_modell"]));
						$objClausVW->set_claus_vw_seriennummer($objClausVW->CleanData($_POST["claus_vw_seriennummer"]));
						$objClausVW->set_claus_vw_sichtschutzfolie($objClausVW->CleanData($_POST["claus_vw_sichtschutzfolie"]));
						$objClausVW->set_claus_vw_sonstiges($objClausVW->CleanData($_POST["claus_vw_sonstiges"]));
						$objClausVW->set_claus_vw_vorl_maschinenummer($objClausVW->CleanData($_POST["claus_vw_vorl_maschinenummer"]));
						$objClausVW->set_claus_vw_leasing_ende($objClausVW->CleanData($_POST["claus_vw_leasing_ende"]));
						$objClausVW->set_claus_vw_details($objClausVW->CleanData($_POST["claus_vw_details"]));
						$objClausVW->set_id($objClausVW->CleanData($_POST["data_id"]));
						if ($objClausVW->update()) {
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
						$objClausVW = new ClausVW;
						$objClausVW->set_record_hide("YES");
					    $objClausVW->set_id($objClausVW->CleanData($_POST["data_id"]));
					    if ($objClausVW->delete()) {
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
					  $objClausVW = new ClausVW;  
				      $objClausVW->set_id($objClausVW->CleanData($_POST["data_id"]));
				      $details = $objClausVW->get_claus_vw_by_id();
				      print_r($details);  
					}else{
						echo "error";
					}
				break;
				// get all
				case 'list_claus_vw':
					if (!empty($_POST['url_endpoint'])) {
						$current_module_id = $_SESSION['user_module_id_url'][$_POST['url_endpoint']]; //use returned module name to get ID
						$permissions = $_SESSION['module_permissions']->$current_module_id; //use ID to get premissions
						$objClausVW = new ClausVW;
						$data = $objClausVW->list_claus_vw($permissions);
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
							print_r('<button type="button" class="btn btn-outline-info"  data-toggle="modal" data-target="#claus_vw_modal">Add New <i class="fa fa-plus"></i></button>');
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

	$objClausVWController = new ClausVWController;
 ?>