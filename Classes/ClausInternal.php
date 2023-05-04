<?php 
	date_default_timezone_set('Europe/Berlin');
	class ClausInternal{
		// setting and getting variables
		private $id;
		private $claus_internal_mitarbeiter;
		private $claus_internal_ehm_nutzer;
		private $claus_internal_modell;
		private $claus_internal_seriennummer;
		private $claus_internal_sichtschutzfolie;
		private $claus_internal_sonstiges;
		private $claus_internal_details;
		private $dbConn;
		private $record_hide = "NO";
		private $table = "claus_internal";

		function set_id($id) { $this->id = $id; }
		function set_record_hide($record_hide) { $this->record_hide = $record_hide; }
		function set_claus_internal_mitarbeiter($claus_internal_mitarbeiter) { $this->claus_internal_mitarbeiter = $claus_internal_mitarbeiter; }
		function set_claus_internal_ehm_nutzer($claus_internal_ehm_nutzer) { $this->claus_internal_ehm_nutzer = $claus_internal_ehm_nutzer; }
		function set_claus_internal_modell($claus_internal_modell) { $this->claus_internal_modell = $claus_internal_modell; }
		function set_claus_internal_seriennummer($claus_internal_seriennummer) { $this->claus_internal_seriennummer = $claus_internal_seriennummer; }
		function set_claus_internal_sichtschutzfolie($claus_internal_sichtschutzfolie) { $this->claus_internal_sichtschutzfolie = $claus_internal_sichtschutzfolie; }
		function set_claus_internal_sonstiges($claus_internal_sonstiges) { $this->claus_internal_sonstiges = $claus_internal_sonstiges; }
		function set_claus_internal_details($claus_internal_details) { $this->claus_internal_details = $claus_internal_details; }

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
			$date=date("jS F Y");
			$sql = "INSERT INTO $this->table (claus_internal_mitarbeiter,claus_internal_ehm_nutzer,claus_internal_modell,claus_internal_seriennummer,claus_internal_sichtschutzfolie,claus_internal_sonstiges,claus_internal_details,claus_internal_date_added,record_hide) 
				VALUES (:claus_internal_mitarbeiter,:claus_internal_ehm_nutzer,:claus_internal_modell,:claus_internal_seriennummer,:claus_internal_sichtschutzfolie,:claus_internal_sonstiges,:claus_internal_details,:claus_internal_date_added,:record_hide)";
			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(":claus_internal_mitarbeiter",$this->claus_internal_mitarbeiter);
			$stmt->bindParam(":claus_internal_ehm_nutzer",$this->claus_internal_ehm_nutzer);
			$stmt->bindParam(":claus_internal_modell",$this->claus_internal_modell);
			$stmt->bindParam(":claus_internal_seriennummer",$this->claus_internal_seriennummer);
			$stmt->bindParam(":claus_internal_sichtschutzfolie",$this->claus_internal_sichtschutzfolie);
			$stmt->bindParam(":claus_internal_sonstiges",$this->claus_internal_sonstiges);
			$stmt->bindParam(":claus_internal_details",$this->claus_internal_details);
			$stmt->bindParam(":claus_internal_date_added",$date);
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
			$sql="UPDATE $this->table SET claus_internal_mitarbeiter=:claus_internal_mitarbeiter,claus_internal_ehm_nutzer=:claus_internal_ehm_nutzer,claus_internal_modell=:claus_internal_modell,claus_internal_seriennummer=:claus_internal_seriennummer,claus_internal_sichtschutzfolie=:claus_internal_sichtschutzfolie,claus_internal_sonstiges=:claus_internal_sonstiges,claus_internal_details=:claus_internal_details WHERE claus_internal_id=:claus_internal_id";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":claus_internal_mitarbeiter",$this->claus_internal_mitarbeiter);
				$stmt->bindParam(":claus_internal_ehm_nutzer",$this->claus_internal_ehm_nutzer);
				$stmt->bindParam(":claus_internal_modell",$this->claus_internal_modell);
				$stmt->bindParam(":claus_internal_seriennummer",$this->claus_internal_seriennummer);
				$stmt->bindParam(":claus_internal_sichtschutzfolie",$this->claus_internal_sichtschutzfolie);
				$stmt->bindParam(":claus_internal_sonstiges",$this->claus_internal_sonstiges);
				$stmt->bindParam(":claus_internal_details",$this->claus_internal_details);
				$stmt->bindParam(":claus_internal_id",$this->id);
				if ($stmt->execute()) {
					
					return true;
				}
				else{
					return false;
				}

		}
		// for delete
		function delete(){
			$sql="UPDATE $this->table SET record_hide=:record_hide WHERE claus_internal_id=:claus_internal_id";
			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(":record_hide",$this->record_hide);
			$stmt->bindParam(":claus_internal_id",$this->id);
			if ($stmt->execute()) {
				
				return true;
			}
			else{
				return false;
			}
		}

	// get by id
		function get_claus_internal_by_id(){
			$sql="SELECT * FROM $this->table WHERE record_hide=:record_hide AND claus_internal_id=:Id ";
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


	// get modules
		// function get_modules(){
		// 	$sql="SELECT * FROM $this->table WHERE record_hide=:record_hide ORDER BY claus_internal_id DESC";
		// 	$stmt = $this->dbConn->prepare($sql);
		// 	$stmt->bindParam(":record_hide",$this->record_hide);
		// 	if ($stmt->execute()) {
		// 		$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
		// 		return $results;
		// 	}
		// 	else{
		// 		return false;
		// 		}

		// }

		function list_claus_internals($permissions){
			$sql="SELECT * FROM $this->table WHERE record_hide=:record_hide ORDER BY claus_internal_id DESC";
			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(":record_hide",$this->record_hide);
			if ($stmt->execute()) {
				$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
				foreach ($results as &$result) {
					$returnData = '';
				    if ($permissions->add_btn == "1") {
				    	// $result['add_button'] = '<button type="button" class="btn btn-outline-info"  data-toggle="modal" data-target="#groupsModal">Add New <i class="fa fa-plus"></i></button>';
				    }if ($permissions->view_btn == "1") {
						$returnData .= '<button type="button" class="btn btn-outline-dark claus_internal_view_data" id="'.trim($result["claus_internal_id"]).'" name="view_data">VIEW  <i class="fa fa-eye"></i></button> ';
					} if ($permissions->update_btn == "1") {
						$returnData .= '<button type="button" class="btn btn-outline-info claus_internal_update_data" id="'.trim($result["claus_internal_id"]).'" name="update_data">UPDATE  <i class="fa fa-edit"></i></button> ';
					} if ($permissions->delete_btn == "1") {
						$returnData .= '<button type="button" class="btn btn-outline-danger claus_internal_del_data" id ="'.trim($result["claus_internal_id"]).'">DELETE <i class="fa fa-trash"></i></button> ';
					}
					
				    $result['buttons'] = $returnData;
				}
				return $results;
			}
			else{
				return false;
				}

		}




	}

?>