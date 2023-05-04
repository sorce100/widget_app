<?php
	require_once("../Classes/Users.php");
	session_start();
	class usersController{
		private $user_password;
		private $reset_password;
		function __construct(){
			// print_r($_POST);exit();
			switch (trim($_POST["mode"])) {
						// for login
						case 'log_user_in':
							// print_r($_POST);exit();
							try{
								if ((!empty($_POST["user_name"])) || (!empty($_POST["user_password"]))) {
									$objUsers = new Users();
									$objUsers->set_user_name(strtolower($objUsers->CleanData($_POST["user_name"])));
									$objUsers->set_user_account_status("ACTIVE");
									$users = $objUsers->login();
									
									foreach ($users as $user) {
										$this->user_password = $objUsers->CleanData($user["user_password"]);
										$this->reset_password = $objUsers->CleanData($user["user_password_reset"]);
									}
									if (password_verify($objUsers->CleanData($_POST["user_password"]) ,  $this->user_password)) {
										// check if password change is required
										if ($this->reset_password == "RESET") {
											// if password reset, return user_name and password entered
											echo ($_POST["user_name"]."-".$_POST["user_password"]);	
										}elseif ($this->reset_password == "LOGIN") {
											// print_r($users);exit();
											$_SESSION['user_id'] = $objUsers->CleanData($user['user_id']); // Initializing Session
											$_SESSION['user_name'] = $objUsers->CleanData($user['user_name']);
											$_SESSION['group_id'] = $objUsers->CleanData($user['user_group_id']);
											// if login successfull then update user online
											// save in session log table
											// $objSessionLogs = new SessionLogs();
											// $objSessionLogs->session_log_start();
											echo "success";
										}
									}
									else{
										echo "error";
									}
								}
								else{
									// if empty aa
									echo "error";
								}
							}catch(PDOException $e){echo "error";}
						break;
						// for insert
						case 'insert':

							try{
								if (!empty($_POST["user_name"]) || !empty($_POST["user_password"]) || !empty($_POST["user_department_id"]) || !empty($_POST["user_group_id"]) || !empty($_POST["user_password_reset_log"]) || !empty($_POST["user_account_status_log"]) )  {
									// check if password reset or account status has being set
									$objUsers = new Users();
									$this->user_password = strtolower($_POST["user_password"]);

									$objUsers->set_user_name($objUsers->CleanData($_POST["user_name"]));
									$objUsers->set_user_password(password_hash($this->user_password, PASSWORD_DEFAULT));
									$objUsers->set_user_password_reset($objUsers->CleanData($_POST["user_password_reset_log"]));
									$objUsers->set_user_department_id($objUsers->CleanData($_POST["user_department_id"]));
									$objUsers->set_user_group_id($objUsers->CleanData($_POST["user_group_id"]));
									$objUsers->set_user_account_status($objUsers->CleanData($_POST["user_account_status_log"]));
									if ($objUsers->insert()) {
										
										echo "success";
									}
									else{
										echo "error";
									}
								}
								else{
									echo "error";
								}

							}catch(PDOException $e){echo $e;}

						break;
						// for update
						case 'update':
							if (!empty($_POST["user_name"]) || !empty($_POST["user_password_reset_log"]) || !empty($_POST["user_account_status_log"]) || !empty($_POST["user_group_id"]) || !empty($_POST["user_department_id"]) || !empty($_POST["data_id"]) )  {

								$objUsers = new Users();
								$objUsers->set_user_id($objUsers->CleanData($_POST["data_id"]));
								// check if password reset or account status has being set
								if (!empty($_POST["user_password"])) {
									$this->user_password = strtolower($objUsers->CleanData($_POST["user_password"]));
									$objUsers->set_user_password(password_hash($this->user_password, PASSWORD_DEFAULT));
								}
								elseif (empty($_POST["user_password"])) {
									$objUsers->set_user_password($objUsers->get_password());
								}
								$objUsers->set_user_name($objUsers->CleanData($_POST["user_name"]));
								$objUsers->set_user_password_reset($objUsers->CleanData($_POST["user_password_reset_log"]));
								$objUsers->set_user_group_id($objUsers->CleanData($_POST["user_group_id"]));
								$objUsers->set_user_department_id($objUsers->CleanData($_POST["user_department_id"]));
								$objUsers->set_user_account_status($objUsers->CleanData($_POST["user_account_status_log"]));

								if ($objUsers->update()) {
									echo "success";
								}
								else{
									echo "error";
								}

							}else{echo "error";}
						break;
						// for delete
						case 'delete':
							try{
								if(isset($_POST["data_id"])){
								  $objUsers = new Users();    
								  $objUsers->set_record_hide("YES");
							      $objUsers->set_user_id($objUsers->CleanData($_POST["data_id"]));
							      if($objUsers->delete()){
							      	echo "success";
							      }
							      else{
							      	echo "error";
							     }
								      
								 }else{die();}
							}catch(PDOException $e){echo "error";}
						break;
						// for update modal
						case 'updateModal':
							try{
								if(!empty($_POST["data_id"])){
								  $objUsers = new Users();    
							      $objUsers->set_user_id($objUsers->CleanData($_POST["data_id"]));
							      $details = $objUsers->get_user_by_id();
							      echo $details;  
							 	}else{echo "error";}
							}catch(PDOException $e){echo "error";}
						break;
						case 'change_password':

							try{
								// $passwdReset="login";
								$change_password_user_name = trim($_POST["change_password_user_name"]);
								$change_password = trim($_POST["change_password"]);
								$new_user_password = trim($_POST["new_user_password"]);
								$retype_new_user_password = trim($_POST["retype_new_user_password"]);

								if((!empty($change_password_user_name)) || (!empty($change_password)) || (!empty($new_user_password)) || (!empty($retype_new_user_password))){
									// check if passwords typed is the same
									if (($new_user_password === $retype_new_user_password) && ($change_password != $new_user_password)) {
										// check for string length, password should not be less than four characters
										if (strlen($new_user_password) >= 4) {
											$objUsers = new Users();
											$objUsers->set_user_password(password_hash($objUsers->CleanData($_POST["retype_new_user_password"]), PASSWORD_DEFAULT));
											$objUsers->set_user_password_reset("LOGIN");
											$objUsers->set_user_name($objUsers->CleanData($_POST["change_password_user_name"]));
											if ($objUsers->change_password()) {
												echo "success";
											}
											else{
												echo "error";
											}
										}
										else{
											// if password is less than 4 characters
											echo "error";
										}
									}
									else{
										// if passwords not the same and the old password is same as new password
										echo "error";
									}
								 }else{
								 	// if its empty
								 	echo "error";
								 }
							}catch(PDOException $e){echo "error";}

						break;
						// get all
						case 'list_users':
							if (!empty($_POST['url_endpoint'])) {
								$current_module_id = $_SESSION['user_module_id_url'][$_POST['url_endpoint']]; //use returned module name to get ID
								$permissions = $_SESSION['module_permissions']->$current_module_id; //use ID to get premissions
								$objUsers = new Users;
								$data = $objUsers->list_users($permissions);
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
									print_r('<button type="button" class="btn btn-outline-info"  data-toggle="modal" data-target="#users_modal" data-backdrop="static" data-keyboard="false">Add New <i class="fa fa-plus"></i></button>');
								}
							}else{
								echo "error";
							}
						break;
						// user change password
						// case 'changePass':
						// 	// $passwdReset="login";
						// 	$new_user_password = trim($_POST["new_user_password"]);
						// 	$retype_new_user_password = trim($_POST["retype_new_user_password"]);
						// 	try{
						// 		if( (!empty($new_user_password)) || (!empty($retype_new_user_password)) ){
						// 			// check if passwords typed is the same
						// 			if ($new_user_password === $retype_new_user_password) {
						// 				// check for string length, password should not be less than four characters
						// 				if (strlen($new_user_password) >= 4) {
						// 					$objUsers = new Users();
						// 					$objUsers->set_user_password(password_hash($objUsers->CleanData($_POST["retype_new_user_password"]), PASSWORD_DEFAULT));
						// 					$objUsers->set_user_password_reset("LOGIN");
						// 					$objUsers->set_user_name($objUsers->CleanData($_POST["change_password_user_name"]));
						// 					if ($objUsers->change_password()) {
						// 						echo "success";
						// 					}
						// 					else{
						// 						echo "error";
						// 					}
						// 				}
						// 				else{
						// 					// if password is less than 4 characters
						// 					echo "error";
						// 				}
						// 			}
						// 			else{
						// 				// if passwords not the same and the old password is same as new password
						// 				echo "error";
						// 			}

						// 		 }else{
						// 		 	// if its empty
						// 		 	echo "error";
						// 		 }
						// 	}catch(PDOException $e){echo "error";}
						// break;
						default:
							echo "There was a problem";
						break;
					
				}
			}
		}
	$objusersController = new usersController();
 ?>