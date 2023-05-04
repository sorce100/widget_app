<?php 
class db{
   // properties
   private $dbhost = 'localhost';
   private $dbuser = 'postgres';
   private $dbpass = 'Athens@123';
   private $dbname = 'elective';

   // connection
   public function connect(){
      
      $db_connect_str = "pgsql:host=$this->dbhost;dbname=$this->dbname";
      $dbconnection = new PDO($db_connect_str, $this->dbuser,$this->dbpass);
      $dbconnection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      return $dbconnection;
   }
}

 ?>