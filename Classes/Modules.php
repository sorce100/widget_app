<?php 
	date_default_timezone_set('Europe/Berlin');
	class Modules{
		// setting and getting variables
		private $id;
		private $pageName;
		private $pageUrl;
		private $pageFileName;
		private $added;
		private $dbConn;
		private $record_hide = "NO";
		private $table = "modules";
		 // declaring arrary to save the pages name
		private	$accessPages=[];
		private	$modulePageId=[];

		function set_id($id) { $this->id = $id; }
		function set_pageName($pageName) { $this->pageName = $pageName; }
		function set_pageUrl($pageUrl) { $this->pageUrl = $pageUrl; }
		function set_pageFileName($pageFileName) { $this->pageFileName = $pageFileName; }
		function set_added($added) { $this->added = $added; }
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
			$date=date("jS F Y \/ h:i:s A");
			$sql = "INSERT INTO $this->table (pages_name,pages_url,page_file_name,added,record_hide) VALUES (:pagesName,:pagesUrl,:pageFileName,:added,:record_hide)";
			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(":pagesName",$this->pageName);
			$stmt->bindParam(":pagesUrl",$this->pageUrl);
			$stmt->bindParam(":pageFileName",$this->pageFileName);
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
			$sql="UPDATE $this->table SET pages_name=:pagesName,pages_url=:pagesUrl,page_file_name=:pageFileName WHERE pages_id=:pagesId";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":pagesName",$this->pageName);
				$stmt->bindParam(":pagesUrl",$this->pageUrl);
				$stmt->bindParam(":pageFileName",$this->pageFileName);
				$stmt->bindParam(":pagesId",$this->id);
				if ($stmt->execute()) {
					
					return true;
				}
				else{
					return false;
					}

		}
		// for delete
		function delete(){
			$sql="UPDATE $this->table SET record_hide=:record_hide WHERE pages_id=:pagesId";
			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(":record_hide",$this->record_hide);
			$stmt->bindParam(":pagesId",$this->id);
			if ($stmt->execute()) {
				
				return true;
			}
			else{
				return false;
			}
		}

	// get modules by id
		function get_module_by_id(){
			$sql="SELECT * FROM $this->table WHERE record_hide=:record_hide AND pages_id=:Id ";
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
		function get_modules(){
			$sql="SELECT * FROM $this->table WHERE record_hide=:record_hide ORDER BY pages_id DESC";
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

		function list_modules($permissions){
			$sql="SELECT * FROM $this->table WHERE record_hide=:record_hide ORDER BY pages_id DESC";
			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(":record_hide",$this->record_hide);
			if ($stmt->execute()) {
				$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
				foreach ($results as &$result) {
					$returnData = '';
				    if ($permissions->add_btn == "1") {
				    	// $result['add_button'] = '<button type="button" class="btn btn-outline-info"  data-toggle="modal" data-target="#groupsModal">Add New <i class="fa fa-plus"></i></button>';
				    }if ($permissions->view_btn == "1") {
						$returnData .= '<button type="button" class="btn btn-outline-dark view_data" id="'.trim($result["pages_id"]).'" name="view_data">VIEW  <i class="fa fa-eye"></i></button> ';
					} if ($permissions->update_btn == "1") {
						$returnData .= '<button type="button" class="btn btn-outline-info update_data" id="'.trim($result["pages_id"]).'" name="update_data">UPDATE  <i class="fa fa-edit"></i></button> ';
					} if ($permissions->delete_btn == "1") {
						$returnData .= '<button type="button" class="btn btn-outline-danger del_data" id ="'.trim($result["pages_id"]).'">DELETE <i class="fa fa-trash"></i></button> ';
					}
					
				    $result['buttons'] = $returnData;
				}
				return $results;
			}
			else{
				return false;
				}

		}



		function get_menu_modules($pagesId){
			$sql="SELECT pages_id,pages_url,page_file_name FROM $this->table WHERE pages_id=:Id";
			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(":Id",$pagesId);
			if ($stmt->execute()) {
				$results= $stmt->fetch(PDO::FETCH_ASSOC);
				// add module to arrary then add the array to session
				$this->accessPages[]=$results["page_file_name"];
				$_SESSION['user_modules']=$this->accessPages;
				$this->modulePageId[$results["page_file_name"]]=$results["pages_id"];
				$_SESSION['user_module_id_url']=$this->modulePageId; // create a session global variable with group module and associated module id [get page url and use that to retrive permission then apply]
				
				print_r( $results["pages_url"]);
			}
			else{
				return false;
				}
		}


	}

?>