<?php 
	date_default_timezone_set('Europe/Berlin');
	class Departments{
		// setting and getting variables
		private $id;
		private $department_name;
		private $department_details;
		private $dbConn;
		private $record_hide = "NO";
		private $table = "departments";

		function set_id($id) { $this->id = $id; }
		function set_department_name($department_name) { $this->department_name = $department_name; }
		function set_department_details($department_details) { $this->department_details = $department_details; }
		function set_record_hide($record_hide) { $this->record_hide = $record_hide; }

		public function __construct(){
			require_once("db/db.php");
			$db = new db();
			$this->dbConn = $db->connect();
		}

		// clean data for data input
		public function cleanData($data){
			$data = trim($data);
			$data=htmlentities($data,ENT_QUOTES, 'UTF-8');
			$data = filter_var($data,FILTER_SANITIZE_SPECIAL_CHARS);
			return $data;
		}

		// insert pages
		function insert(){
			$date = date("jS F Y");
			$sql = "INSERT INTO $this->table (department_name,department_details,department_date_added,user_id,record_hide)
				VALUES (:department_name,:department_details,:department_date_added,:user_id,:record_hide)";
			$stmt = $this->dbConn->prepare($sql);
			
			$stmt->bindParam(":department_name",$this->department_name);
			$stmt->bindParam(":department_details",$this->department_details);
			$stmt->bindParam(":department_date_added",$date);
			$stmt->bindParam(":user_id",$_SESSION['user_id']);
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
			$sql = "UPDATE $this->table SET 
				department_name = :department_name,
				department_details = :department_details
			WHERE department_id = :Id";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":department_name",$this->department_name);
	            $stmt->bindParam(":department_details",$this->department_details);
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
			$sql="UPDATE $this->table SET record_hide=:record_hide WHERE department_id=:Id";
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

	// get all records
		function list_departments($permissions){
			$sql="SELECT * FROM $this->table WHERE record_hide=:record_hide ORDER BY department_id DESC";
			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(":record_hide",$this->record_hide);
			if ($stmt->execute()) {
				$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
				foreach ($results as &$result) {
					$returnData = '';
				    if ($permissions->add_btn == "1") {
				    	// $result['add_button'] = '<button type="button" class="btn btn-outline-info"  data-toggle="modal" data-target="#groupsModal">Add New <i class="fa fa-plus"></i></button>';
				    }if ($permissions->view_btn == "1") {
						$returnData .= '<button type="button" class="btn btn-outline-dark view_data" id="'.trim($result["department_id"]).'" name="view_data">VIEW  <i class="fa fa-eye"></i></button> ';
					} if ($permissions->update_btn == "1") {
						$returnData .= '<button type="button" class="btn btn-outline-info update_data" id="'.trim($result["department_id"]).'" name="update_data">UPDATE  <i class="fa fa-edit"></i></button> ';
					} if ($permissions->delete_btn == "1") {
						$returnData .= '<button type="button" class="btn btn-outline-danger del_data" id ="'.trim($result["department_id"]).'">DELETE <i class="fa fa-trash"></i></button> ';
					}
					
				    $result['buttons'] = $returnData;
				}
				return $results;
			}
			else{
				return false;
				}

		}


	// get user departments
		function get_departments(){
			$sql="SELECT * FROM $this->table WHERE record_hide=:record_hide ORDER BY department_id DESC";
			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(":record_hide",$this->record_hide);
			if ($stmt->execute()) {
				$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
				return $results;
				 
			}
			else{
				return false;
				}

		}

	// get widget by id
		function get_department_by_id(){
			$sql="SELECT * FROM $this->table WHERE record_hide=:record_hide AND department_id=:Id ";
			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(":record_hide",$this->record_hide);
			$stmt->bindParam(":Id",$this->id);
			if ($stmt->execute()) {
				$results = $stmt->fetch(PDO::FETCH_ASSOC);
				return json_encode($results);
			}
			else{
				return false;
				}

		}

	}

 ?>