<?php 
	date_default_timezone_set('Europe/Berlin');
	class ClausVW{
		// setting and getting variables
		private $id;
		private $claus_vw_mitarbeiter;
		private $claus_vw_computername;
		private $claus_vw_ehm_nutzer;
		private $claus_vw_modell;
		private $claus_vw_seriennummer;
		private $claus_vw_sichtschutzfolie;
		private $claus_vw_sonstiges;
		private $claus_vw_vorl_maschinenummer;
		private $claus_vw_leasing_ende;
		private $claus_vw_details;
		private $dbConn;
		private $record_hide = "NO";
		private $table = "claus_vw";

		function set_id($id) { $this->id = $id; }
		function set_record_hide($record_hide) { $this->record_hide = $record_hide; }
		function set_claus_vw_mitarbeiter($claus_vw_mitarbeiter) { $this->claus_vw_mitarbeiter = $claus_vw_mitarbeiter; }
		function set_claus_vw_computername($claus_vw_computername) { $this->claus_vw_computername = $claus_vw_computername; }
		function set_claus_vw_ehm_nutzer($claus_vw_ehm_nutzer) { $this->claus_vw_ehm_nutzer = $claus_vw_ehm_nutzer; }
		function set_claus_vw_modell($claus_vw_modell) { $this->claus_vw_modell = $claus_vw_modell; }
		function set_claus_vw_seriennummer($claus_vw_seriennummer) { $this->claus_vw_seriennummer = $claus_vw_seriennummer; }
		function set_claus_vw_sichtschutzfolie($claus_vw_sichtschutzfolie) { $this->claus_vw_sichtschutzfolie = $claus_vw_sichtschutzfolie; }
		function set_claus_vw_sonstiges($claus_vw_sonstiges) { $this->claus_vw_sonstiges = $claus_vw_sonstiges; }
		function set_claus_vw_vorl_maschinenummer($claus_vw_vorl_maschinenummer) { $this->claus_vw_vorl_maschinenummer = $claus_vw_vorl_maschinenummer; }
		function set_claus_vw_leasing_ende($claus_vw_leasing_ende) { $this->claus_vw_leasing_ende = $claus_vw_leasing_ende; }
		function set_claus_vw_details($claus_vw_details) { $this->claus_vw_details = $claus_vw_details; }

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
			$sql = "INSERT INTO $this->table (claus_vw_mitarbeiter,claus_vw_computername,claus_vw_ehm_nutzer,claus_vw_modell,claus_vw_seriennummer,claus_vw_sichtschutzfolie,claus_vw_sonstiges,claus_vw_vorl_maschinenummer,claus_vw_leasing_ende,claus_vw_details,claus_vw_date_added,record_hide) 
				VALUES (:claus_vw_mitarbeiter,:claus_vw_computername,:claus_vw_ehm_nutzer,:claus_vw_modell,:claus_vw_seriennummer,:claus_vw_sichtschutzfolie,:claus_vw_sonstiges,:claus_vw_vorl_maschinenummer,:claus_vw_leasing_ende,:claus_vw_details,:claus_vw_date_added,:record_hide)";
			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(":claus_vw_mitarbeiter",$this->claus_vw_mitarbeiter);
			$stmt->bindParam(":claus_vw_computername",$this->claus_vw_computername);
			$stmt->bindParam(":claus_vw_ehm_nutzer",$this->claus_vw_ehm_nutzer);
			$stmt->bindParam(":claus_vw_modell",$this->claus_vw_modell);
			$stmt->bindParam(":claus_vw_seriennummer",$this->claus_vw_seriennummer);
			$stmt->bindParam(":claus_vw_sichtschutzfolie",$this->claus_vw_sichtschutzfolie);
			$stmt->bindParam(":claus_vw_sonstiges",$this->claus_vw_sonstiges);
			$stmt->bindParam(":claus_vw_vorl_maschinenummer",$this->claus_vw_vorl_maschinenummer);
			$stmt->bindParam(":claus_vw_leasing_ende",$this->claus_vw_leasing_ende);
			$stmt->bindParam(":claus_vw_details",$this->claus_vw_details);
			$stmt->bindParam(":claus_vw_date_added",$date);
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
			$sql="UPDATE $this->table SET claus_vw_mitarbeiter=:claus_vw_mitarbeiter,claus_vw_computername=:claus_vw_computername,claus_vw_ehm_nutzer=:claus_vw_ehm_nutzer,claus_vw_modell=:claus_vw_modell,claus_vw_seriennummer=:claus_vw_seriennummer,claus_vw_sichtschutzfolie=:claus_vw_sichtschutzfolie,claus_vw_sonstiges=:claus_vw_sonstiges,claus_vw_vorl_maschinenummer=:claus_vw_vorl_maschinenummer,claus_vw_leasing_ende=:claus_vw_leasing_ende,claus_vw_details=:claus_vw_details WHERE claus_vw_id=:claus_vw_id";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":claus_vw_mitarbeiter",$this->claus_vw_mitarbeiter);
				$stmt->bindParam(":claus_vw_computername",$this->claus_vw_computername);
				$stmt->bindParam(":claus_vw_ehm_nutzer",$this->claus_vw_ehm_nutzer);
				$stmt->bindParam(":claus_vw_modell",$this->claus_vw_modell);
				$stmt->bindParam(":claus_vw_seriennummer",$this->claus_vw_seriennummer);
				$stmt->bindParam(":claus_vw_sichtschutzfolie",$this->claus_vw_sichtschutzfolie);
				$stmt->bindParam(":claus_vw_sonstiges",$this->claus_vw_sonstiges);
				$stmt->bindParam(":claus_vw_vorl_maschinenummer",$this->claus_vw_vorl_maschinenummer);
				$stmt->bindParam(":claus_vw_leasing_ende",$this->claus_vw_leasing_ende);
				$stmt->bindParam(":claus_vw_details",$this->claus_vw_details);
				$stmt->bindParam(":claus_vw_id",$this->id);
				if ($stmt->execute()) {
					
					return true;
				}
				else{
					return false;
				}

		}
		// for delete
		function delete(){
			$sql="UPDATE $this->table SET record_hide=:record_hide WHERE claus_vw_id=:claus_vw_id";
			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(":record_hide",$this->record_hide);
			$stmt->bindParam(":claus_vw_id",$this->id);
			if ($stmt->execute()) {
				
				return true;
			}
			else{
				return false;
			}
		}

	// get by id
		function get_claus_vw_by_id(){
			$sql="SELECT * FROM $this->table WHERE record_hide=:record_hide AND claus_vw_id=:Id ";
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


		function list_claus_vw($permissions){
			$sql="SELECT * FROM $this->table WHERE record_hide=:record_hide ORDER BY claus_vw_id DESC";
			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(":record_hide",$this->record_hide);
			if ($stmt->execute()) {
				$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
				foreach ($results as &$result) {
					$returnData = '';
				    if ($permissions->add_btn == "1") {
				    	// $result['add_button'] = '<button type="button" class="btn btn-outline-info"  data-toggle="modal" data-target="#groupsModal">Add New <i class="fa fa-plus"></i></button>';
				    }if ($permissions->view_btn == "1") {
						$returnData .= '<button type="button" class="btn btn-outline-dark claus_vw_view_data" id="'.trim($result["claus_vw_id"]).'" name="view_data">VIEW  <i class="fa fa-eye"></i></button> ';
					} if ($permissions->update_btn == "1") {
						$returnData .= '<button type="button" class="btn btn-outline-info claus_vw_update_data" id="'.trim($result["claus_vw_id"]).'" name="update_data">UPDATE  <i class="fa fa-edit"></i></button> ';
					} if ($permissions->delete_btn == "1") {
						$returnData .= '<button type="button" class="btn btn-outline-danger claus_vw_del_data" id ="'.trim($result["claus_vw_id"]).'">DELETE <i class="fa fa-trash"></i></button> ';
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