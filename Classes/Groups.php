<?php 
	date_default_timezone_set('Europe/Berlin');
	class Groups{
		// setting and getting variables
		private $id;
		private $pagesGroupName;
		private $profile;
		private $pagesId;
		private $pages_id_permissions;
		private $added;
		private $dbConn;
		private $record_hide = "NO";
		private $table = "modules_group";

		function set_id($id) { $this->id = $id; }
		function set_pagesGroupName($pagesGroupName) { $this->pagesGroupName = $pagesGroupName; }
		function set_pagesId($pagesId) { $this->pagesId = $pagesId; }
		function set_pages_id_permissions($pages_id_permissions) { $this->pages_id_permissions = $pages_id_permissions; }
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

		// insert pages
		function insert(){
			$date =date("jS F Y");
			$sql = "INSERT INTO $this->table (pages_group_name,pages_id,pages_id_permissions,added,record_hide) VALUES (:pagesGroupName,:pagesId,:pages_id_permissions,:added,:record_hide)";
			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(":pagesGroupName",$this->pagesGroupName);
			$stmt->bindParam(":pagesId",$this->pagesId);
			$stmt->bindParam(":pages_id_permissions",$this->pages_id_permissions);
			$stmt->bindParam(":added",$date);
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
			$sql="UPDATE $this->table SET pages_group_name=:pagesGroupName,pages_id=:pagesId,pages_id_permissions=:pages_id_permissions WHERE pages_group_id=:Id";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":pagesGroupName",$this->pagesGroupName);
				$stmt->bindParam(":pagesId",$this->pagesId);
				$stmt->bindParam(":pages_id_permissions",$this->pages_id_permissions);
				$stmt->bindParam(":Id",$this->id);
				
				if ($stmt->execute()) {
					
					return true;
				}
				else{
					return false;
					}

		}
		// for delete
		function delete(){
			$sql="UPDATE $this->table SET record_hide=:record_hide WHERE pages_group_id=:Id";
			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(":record_hide",$this->record_hide);
			$stmt->bindParam(":Id",$this->id);
			if ($stmt->execute()) {
				
				return true;
			}
			else{
				return false;
			}
		}


	// get groups details
		function list_groups($permissions){
			$sql="SELECT * FROM $this->table WHERE record_hide=:record_hide ORDER BY pages_group_id DESC";
			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(":record_hide",$this->record_hide);
			if ($stmt->execute()) {
				$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
				foreach ($results as &$result) {
					$returnData = '';
				    if ($permissions->add_btn == "1") {
				    	// $result['add_button'] = '<button type="button" class="btn btn-outline-info"  data-toggle="modal" data-target="#groupsModal">Add New <i class="fa fa-plus"></i></button>';
				    }if ($permissions->view_btn == "1") {
						$returnData .= '<button type="button" class="btn btn-outline-dark view_data" id="'.trim($result["pages_group_id"]).'" name="view_data">VIEW  <i class="fa fa-eye"></i></button> ';
					} if ($permissions->update_btn == "1") {
						$returnData .= '<button type="button" class="btn btn-outline-info update_data" id="'.trim($result["pages_group_id"]).'" name="update_data">UPDATE  <i class="fa fa-edit"></i></button> ';
					} if ($permissions->delete_btn == "1") {
						$returnData .= '<button type="button" class="btn btn-outline-danger del_data" id ="'.trim($result["pages_group_id"]).'">DELETE <i class="fa fa-trash"></i></button> ';
					}
					
				    $result['buttons'] = $returnData;
				}
				return $results;
			}
			else{
				return false;
				}

		}


		function get_groups(){
			$sql="SELECT * FROM $this->table WHERE record_hide=:record_hide ORDER BY pages_group_id DESC";
			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(":record_hide",$this->record_hide);
			if ($stmt->execute()) {
				$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
				return $results;
			}
			else{
				return false;
				}

		}

	// get user
		function get_group_by_id(){
			$sql="SELECT * FROM $this->table WHERE pages_group_id=:Id";
			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(":Id",$this->id);
			if ($stmt->execute()) {
				$results= $stmt->fetch(PDO::FETCH_ASSOC);
				return json_encode($results);
			}
			else{
				return false;
				}
			}

	// get group name by id
		function get_groupName_by_id(){
			$sql="SELECT group_id,group_name FROM $this->table WHERE pages_group_id=:groupId";
			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(":groupId",$this->id);
			if ($stmt->execute()) {
				$results= $stmt->fetch(PDO::FETCH_ASSOC);
				return json_encode($results);
			}
			else{
				return false;
				}
			}

	// getting all modules for user login dashboard based on group number

			function get_user_modules($groupId){
				$returnRecords = '';
				$sql="SELECT pages_id,pages_id_permissions FROM $this->table WHERE pages_group_id=:Id";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":Id",$groupId);
				if ($stmt->execute()) {
					$results = $stmt->fetch(PDO::FETCH_ASSOC);
					$modules_ids = json_decode($results["pages_id"]);
					$_SESSION['module_permissions']=json_decode($results["pages_id_permissions"]); // get the permission for each group
					
					return $modules_ids;
				}
				else{
					return false;
					}

			}


	}

 ?>