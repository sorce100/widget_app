<?php 
	date_default_timezone_set('Europe/Berlin');
	class Users{
		// setting and getting variables
		private $user_id;
		private $user_name;
		private $user_password;
		private $user_account_type;
		private $user_password_reset;
		private $user_group_id;
		private $user_account_status;
		private $user_department_id;
		private $user_login_status;
		private $user_member_id;
		private $dbConn;
		private $record_hide = "NO";
		private $table = "users";

		function set_user_id($user_id) { $this->user_id = $user_id; }
		function set_user_name($user_name) { $this->user_name = $user_name; }
		function set_user_password($user_password) { $this->user_password = $user_password; }
		function set_user_account_type($user_account_type) { $this->user_account_type = $user_account_type; }
		function set_user_password_reset($user_password_reset) { $this->user_password_reset = $user_password_reset; }
		function set_user_group_id($user_group_id) { $this->user_group_id = $user_group_id; }
		function set_user_account_status($user_account_status) { $this->user_account_status = $user_account_status; }
		function set_user_department_id($user_department_id) { $this->user_department_id = $user_department_id; }
		function set_user_login_status($user_login_status) { $this->user_login_status = $user_login_status; }
		function set_user_member_id($user_member_id) { $this->user_member_id = $user_member_id; }
		function set_record_hide($record_hide) { $this->record_hide = $record_hide; }

		public function __construct(){
			require_once("db/db.php");
			$db = new db();
			$this->dbConn = $db->connect();
		}

		// clean data for data input
		public function CleanData($data){
			$data = trim($data);
			$data=htmlentities($data,ENT_QUOTES, 'UTF-8');
			$data = filter_var($data,FILTER_SANITIZE_SPECIAL_CHARS);
			return $data;
		}

		// for login
		function login(){
			$sql="SELECT user_id,user_name,user_password,user_password_reset,user_group_id,user_account_status,user_login_status,record_hide,last_updated
			FROM $this->table 
			WHERE user_name = :user_name 
			AND user_account_status = :user_account_status 
			AND record_hide=:record_hide";
			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(":user_name",$this->user_name);
			$stmt->bindParam(":user_account_status",$this->user_account_status);
			$stmt->bindParam(":record_hide",$this->record_hide);
			if ($stmt->execute()) {
				$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
				return $results;
			}
			else{
				return false;
				}

		}


		// insert users
		function insert(){
			$sql = "INSERT INTO $this->table (user_name,user_password,user_password_reset,user_group_id,user_department_id,user_account_status,record_hide) 
			VALUES (:user_name,:user_password,:user_password_reset,:user_group_id,:user_department_id,:user_account_status,:record_hide)";
			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(":user_name",$this->user_name);
			$stmt->bindParam(":user_password",$this->user_password);
			$stmt->bindParam(":user_password_reset",$this->user_password_reset);
			$stmt->bindParam(":user_group_id",$this->user_group_id);
			$stmt->bindParam(":user_department_id",$this->user_department_id);
			$stmt->bindParam(":user_account_status",$this->user_account_status);
			$stmt->bindParam(":record_hide",$this->record_hide);

			if ($stmt->execute()) {
				return true;
			}
			else{
				return false;
			}
		}


		// for update
		function update(){
			$sql="UPDATE $this->table SET user_name=:user_name,user_password=:user_password,user_password_reset=:user_password_reset,user_group_id=:user_group_id,user_account_status=:user_account_status,user_login_status=:user_login_status,user_department_id=:user_department_id WHERE user_id=:Id";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":user_name",$this->user_name);
				$stmt->bindParam(":user_password",$this->user_password);
				$stmt->bindParam(":user_password_reset",$this->user_password_reset);
				$stmt->bindParam(":user_group_id",$this->user_group_id);
				$stmt->bindParam(":user_account_status",$this->user_account_status);
				$stmt->bindParam(":user_login_status",$this->user_login_status);
				$stmt->bindParam(":user_department_id",$this->user_department_id);
				$stmt->bindParam(":Id",$this->user_id);
				if ($stmt->execute()) {
					
					return true;
				}
				else{
					return false;
				}

		}
		// for delete
		function delete(){
			$sql="UPDATE $this->table SET record_hide=:record_hide WHERE user_id=:Id";
			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(":record_hide",$this->record_hide);
			$stmt->bindParam(":Id",$this->user_id);
			if ($stmt->execute()) {
				
				return true;
			}
			else{
				return false;
			}
		
		}



		function list_users($permissions){
			$sql="SELECT U.user_id,U.user_name,U.user_account_status, D.department_name, G.pages_group_name 
			FROM $this->table as U
			LEFT JOIN departments as D ON U.user_department_id = D.department_id
			LEFT JOIN modules_group as G ON U.user_group_id = G.pages_group_id
			WHERE U.record_hide = :record_hide 
			ORDER BY U.user_id DESC";
			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(":record_hide",$this->record_hide);
			if ($stmt->execute()) {
				$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
				foreach ($results as &$result) {
					$returnData = '';
				    if ($permissions->add_btn == "1") {
				    	// $result['add_button'] = '<button type="button" class="btn btn-outline-info"  data-toggle="modal" data-target="#groupsModal">Add New <i class="fa fa-plus"></i></button>';
				    }if ($permissions->view_btn == "1") {
						$returnData .= '<button type="button" class="btn btn-outline-dark view_data" id="'.trim($result["user_id"]).'" name="view_data">VIEW  <i class="fa fa-eye"></i></button> ';
					} if ($permissions->update_btn == "1") {
						$returnData .= '<button type="button" class="btn btn-outline-info update_data" id="'.trim($result["user_id"]).'" name="update_data">UPDATE  <i class="fa fa-edit"></i></button> ';
					} if ($permissions->delete_btn == "1") {
						$returnData .= '<button type="button" class="btn btn-outline-danger del_data" id ="'.trim($result["user_id"]).'">DELETE <i class="fa fa-trash"></i></button> ';
					}
					
				    $result['buttons'] = $returnData;
				}
				return $results;
			}
			else{
				return false;
				}

		}

		// get user by id
		function get_user_by_id(){
			$sql="SELECT * FROM $this->table WHERE user_id=:Id";
			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(":Id",$this->user_id);
			if ($stmt->execute()) {
				$results= $stmt->fetch(PDO::FETCH_ASSOC);
				return json_encode($results);
			}
			else{
				return false;
				}
		}

	/// get password of the user
		function get_password(){
			$sql="SELECT user_password FROM $this->table WHERE user_id=:user_id";
			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(":user_id",$this->user_id);
			if ($stmt->execute()) {
				$results= $stmt->fetch(PDO::FETCH_ASSOC);
				return trim($results['user_password']);
			}
			else{
				return false;
				}
		}
	// change password
		function change_password(){
			$sql="UPDATE $this->table SET user_password = :user_password,user_password_reset = :user_password_reset WHERE user_name=:user_name";
			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(":user_password",$this->user_password);
			$stmt->bindParam(":user_password_reset",$this->user_password_reset);
			$stmt->bindParam(":user_name",$this->user_name);
			if ($stmt->execute()) {
				return true;
			}
			else{
				return false;
				}
		}


	// get member and non member status
		function get_member_type($licenseNum){
			$sql="SELECT member_type FROM members WHERE member_licensenum=:licenseNum LIMIT 1";
			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(":licenseNum",$licenseNum);
			if ($stmt->execute()) {
				$results= $stmt->fetch(PDO::FETCH_ASSOC);
				if (!empty($results)) {
					return trim($results["member_type"]);
				}
			}
			else{
				return false;
				}
		}
// for password recovery
		function get_user_recovery_details(){
			$sql = "SELECT member_id FROM $this->table WHERE user_name=:user_name LIMIT 1";
			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(":user_name",$this->user_name);
			if ($stmt->execute()) {
				$results= $stmt->fetch(PDO::FETCH_ASSOC);
				if (!empty($results)) {
					// switch member type for member or agent
					switch (trim($results['account_type'])) {
						case 'member':
							// if user is a member then get member phone number
							$memsql = "SELECT member_tel_num FROM members WHERE member_licensenum=:licenseNum LIMIT 1";
							$memstmt = $this->dbConn->prepare($memsql);
							$memstmt->bindValue(":licenseNum",trim($results["member_id"]));
							if ($memstmt->execute()) {
								$memResults= $memstmt->fetch(PDO::FETCH_ASSOC);
								// check if empty
								if (!empty($memResults)) {
									return trim($memResults["member_tel_num"]);
								}
								else{return false;}
							}
							else{
								return false;
							}
						break;
						case 'agent':
							// if user is an agent then get agent phone number
							$agsql = "SELECT agent_tel_num_1 FROM agents WHERE agent_id=:agentId LIMIT 1";
							$agstmt = $this->dbConn->prepare($agsql);
							$agstmt->bindValue(":agentId",trim($results["member_id"]));
							if ($agstmt->execute()) {
								$agResults= $agstmt->fetch(PDO::FETCH_ASSOC);
								// check if empty
								if (!empty($agResults)) {
									return trim($agResults["agent_tel_num_1"]);
								}
								else{return false;}
							}
							else{
								return false;
							}
						break;
					}
				}
			}
			else{
				return false;
				}
		}


	}

?>