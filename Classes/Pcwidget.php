<?php 
	date_default_timezone_set('Europe/Berlin');
	class Pcwidget{
		// setting and getting variables
		private $id;
		private $pc_widget_mitarbeiter;
		private $pc_widget_kuerzel;
		private $pc_widget_vw_rechner;
		private $pc_widget_hostname;
		private $pc_widget_model;
		private $pc_widget_seriennummer;
		private $pc_widget_wlan_mac;
		private $pc_widget_lan_mac;
		private $pc_widget_bitlocker_pin;
		private $pc_widget_office2016_schluessel;
		private $pc_widget_office2019_schluessel;
		private $pc_widget_windows10_key;
		private $pc_widget_bios_pwd;
		private $pc_widget_details;
		private $dbConn;
		private $record_hide = "NO";
		private $table = "pc_widget";

		function set_id($id) { $this->id = $id; }
		function set_pc_widget_mitarbeiter($pc_widget_mitarbeiter) { $this->pc_widget_mitarbeiter = $pc_widget_mitarbeiter; }
		function set_pc_widget_kuerzel($pc_widget_kuerzel) { $this->pc_widget_kuerzel = $pc_widget_kuerzel; }
		function set_pc_widget_vw_rechner($pc_widget_vw_rechner) { $this->pc_widget_vw_rechner = $pc_widget_vw_rechner; }
		function set_pc_widget_hostname($pc_widget_hostname) { $this->pc_widget_hostname = $pc_widget_hostname; }
		function set_pc_widget_model($pc_widget_model) { $this->pc_widget_model = $pc_widget_model; }
		function set_pc_widget_seriennummer($pc_widget_seriennummer) { $this->pc_widget_seriennummer = $pc_widget_seriennummer; }
		function set_pc_widget_wlan_mac($pc_widget_wlan_mac) { $this->pc_widget_wlan_mac = $pc_widget_wlan_mac; }
		function set_pc_widget_lan_mac($pc_widget_lan_mac) { $this->pc_widget_lan_mac = $pc_widget_lan_mac; }
		function set_pc_widget_bitlocker_pin($pc_widget_bitlocker_pin) { $this->pc_widget_bitlocker_pin = $pc_widget_bitlocker_pin; }
		function set_pc_widget_office2016_schluessel($pc_widget_office2016_schluessel) { $this->pc_widget_office2016_schluessel = $pc_widget_office2016_schluessel; }
		function set_pc_widget_office2019_schluessel($pc_widget_office2019_schluessel) { $this->pc_widget_office2019_schluessel = $pc_widget_office2019_schluessel; }
		function set_pc_widget_windows10_key($pc_widget_windows10_key) { $this->pc_widget_windows10_key = $pc_widget_windows10_key; }
		function set_pc_widget_bios_pwd($pc_widget_bios_pwd) { $this->pc_widget_bios_pwd = $pc_widget_bios_pwd; }
		function set_pc_widget_details($pc_widget_details) { $this->pc_widget_details = $pc_widget_details; }
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
			$sql = "INSERT INTO $this->table (pc_widget_mitarbeiter,pc_widget_kuerzel,pc_widget_vw_rechner,pc_widget_hostname,pc_widget_model,pc_widget_seriennummer,pc_widget_wlan_mac,pc_widget_lan_mac,pc_widget_bitlocker_pin,pc_widget_office2016_schluessel,pc_widget_office2019_schluessel,pc_widget_windows10_key,pc_widget_bios_pwd,pc_widget_details,pc_widget_date_added,user_id,record_hide)
				VALUES (:pc_widget_mitarbeiter,:pc_widget_kuerzel,:pc_widget_vw_rechner,:pc_widget_hostname,:pc_widget_model,:pc_widget_seriennummer,:pc_widget_wlan_mac,:pc_widget_lan_mac,:pc_widget_bitlocker_pin,:pc_widget_office2016_schluessel,:pc_widget_office2019_schluessel,:pc_widget_windows10_key,:pc_widget_bios_pwd,:pc_widget_details,:pc_widget_date_added,:user_id,:record_hide)";
			$stmt = $this->dbConn->prepare($sql);
			
			$stmt->bindParam(":pc_widget_mitarbeiter",$this->pc_widget_mitarbeiter);
			$stmt->bindParam(":pc_widget_kuerzel",$this->pc_widget_kuerzel);
			$stmt->bindParam(":pc_widget_vw_rechner",$this->pc_widget_vw_rechner);
			$stmt->bindParam(":pc_widget_hostname",$this->pc_widget_hostname);
			$stmt->bindParam(":pc_widget_model",$this->pc_widget_model);
			$stmt->bindParam(":pc_widget_seriennummer",$this->pc_widget_seriennummer);
			$stmt->bindParam(":pc_widget_wlan_mac",$this->pc_widget_wlan_mac);
			$stmt->bindParam(":pc_widget_lan_mac",$this->pc_widget_lan_mac);
			$stmt->bindParam(":pc_widget_bitlocker_pin",$this->pc_widget_bitlocker_pin);
			$stmt->bindParam(":pc_widget_office2016_schluessel",$this->pc_widget_office2016_schluessel);
			$stmt->bindParam(":pc_widget_office2019_schluessel",$this->pc_widget_office2019_schluessel);
			$stmt->bindParam(":pc_widget_windows10_key",$this->pc_widget_windows10_key);
			$stmt->bindParam(":pc_widget_bios_pwd",$this->pc_widget_bios_pwd);
			$stmt->bindParam(":pc_widget_details",$this->pc_widget_details);
			$stmt->bindParam(":pc_widget_date_added",$date);
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
				pc_widget_mitarbeiter = :pc_widget_mitarbeiter,
				pc_widget_kuerzel = :pc_widget_kuerzel,
				pc_widget_vw_rechner = :pc_widget_vw_rechner,
				pc_widget_hostname = :pc_widget_hostname,
				pc_widget_model = :pc_widget_model,
				pc_widget_seriennummer = :pc_widget_seriennummer,
				pc_widget_wlan_mac = :pc_widget_wlan_mac,
				pc_widget_lan_mac = :pc_widget_lan_mac,
				pc_widget_bitlocker_pin = :pc_widget_bitlocker_pin,
				pc_widget_office2016_schluessel = :pc_widget_office2016_schluessel,
				pc_widget_office2019_schluessel = :pc_widget_office2019_schluessel,
				pc_widget_windows10_key = :pc_widget_windows10_key,
				pc_widget_bios_pwd = :pc_widget_bios_pwd,
				pc_widget_details = :pc_widget_details 
			WHERE pc_widget_id = :Id";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":pc_widget_mitarbeiter",$this->pc_widget_mitarbeiter);
	            $stmt->bindParam(":pc_widget_kuerzel",$this->pc_widget_kuerzel);
	            $stmt->bindParam(":pc_widget_vw_rechner",$this->pc_widget_vw_rechner);
	            $stmt->bindParam(":pc_widget_hostname",$this->pc_widget_hostname);
	            $stmt->bindParam(":pc_widget_model",$this->pc_widget_model);
	            $stmt->bindParam(":pc_widget_seriennummer",$this->pc_widget_seriennummer);
	            $stmt->bindParam(":pc_widget_wlan_mac",$this->pc_widget_wlan_mac);
	            $stmt->bindParam(":pc_widget_lan_mac",$this->pc_widget_lan_mac);
	            $stmt->bindParam(":pc_widget_bitlocker_pin",$this->pc_widget_bitlocker_pin);
	            $stmt->bindParam(":pc_widget_office2016_schluessel",$this->pc_widget_office2016_schluessel);
	            $stmt->bindParam(":pc_widget_office2019_schluessel",$this->pc_widget_office2019_schluessel);
	            $stmt->bindParam(":pc_widget_windows10_key",$this->pc_widget_windows10_key);
	            $stmt->bindParam(":pc_widget_bios_pwd",$this->pc_widget_bios_pwd);
	            $stmt->bindParam(":pc_widget_details",$this->pc_widget_details);
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
			$sql="UPDATE $this->table SET record_hide=:record_hide WHERE pc_widget_id=:Id";
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


		function list_pc_widgets($permissions){
			$sql="SELECT * FROM $this->table WHERE record_hide=:record_hide ORDER BY pc_widget_id DESC";
			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(":record_hide",$this->record_hide);
			if ($stmt->execute()) {
				$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
				foreach ($results as &$result) {
					$returnData = '';
				    if ($permissions->add_btn == "1") {
				    	// $result['add_button'] = '<button type="button" class="btn btn-outline-info"  data-toggle="modal" data-target="#groupsModal">Add New <i class="fa fa-plus"></i></button>';
				    }if ($permissions->view_btn == "1") {
						$returnData .= '<button type="button" class="btn btn-outline-dark view_data" id="'.trim($result["pc_widget_id"]).'" name="view_data">VIEW  <i class="fa fa-eye"></i></button> ';
					} if ($permissions->update_btn == "1") {
						$returnData .= '<button type="button" class="btn btn-outline-info update_data" id="'.trim($result["pc_widget_id"]).'" name="update_data">UPDATE  <i class="fa fa-edit"></i></button> ';
					} if ($permissions->delete_btn == "1") {
						$returnData .= '<button type="button" class="btn btn-outline-danger del_data" id ="'.trim($result["pc_widget_id"]).'">DELETE <i class="fa fa-trash"></i></button> ';
					}
					
				    $result['buttons'] = $returnData;
				}
				return $results;
			}
			else{
				return false;
				}

		}


	// get records for dataTable
		function get_pcwidgets_dataTable(){
			$sql="SELECT * FROM $this->table WHERE record_hide=:record_hide ORDER BY pc_widget_id DESC";
			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(":record_hide",$this->record_hide);
			if ($stmt->execute()) {
				$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
				return $returnRecords;
				 
			}
			else{
				return false;
				}

		}

	// get widget by id
		function get_pc_widget_by_id(){
			$sql="SELECT * FROM $this->table WHERE record_hide=:record_hide AND pc_widget_id=:Id ";
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

		// function get_widget(){
		// 	$sql="SELECT * FROM $this->table WHERE record_hide=:record_hide ORDER BY pc_widget_id DESC";
		// 	$stmt = $this->dbConn->prepare($sql);
		// 	$stmt->bindParam(":record_hide",$this->record_hide);
		// 	if ($stmt->execute()) {
		// 		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		// 		foreach ($results as &$result) {
		// 		    $result['buttons'] = '<button type="button" class="btn btn-outline-warning view_data" id="'.trim($result["pc_widget_id"]).'">VIEW  <i class="fa fa-eye"></i></button>
		// 		    			<button type="button" class="btn btn-outline-info edit_pc_widget" id="'.trim($result["pc_widget_id"]).'">UPDATE  <i class="fa fa-edit"></i></button>
		// 						<button type="button" class="btn btn-outline-danger delete_pc_widget" id ="'.trim($result["pc_widget_id"]).'">DELETE <i class="fa fa-trash"></i></button>';
		// 		}
		// 		return $results;
		// 	}
		// 	else{
		// 		return false;
		// 		}

		// }


	}

 ?>