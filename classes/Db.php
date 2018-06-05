<?php
	class Db{
		public static $_mysqli = null;

		private $_host = "localhost",
				$_database = "shopping",
				$_username = "root",
				$_password = "";

		public function __construct(){
			return $this->Connnect();
		}

		public function Connnect(){
			self::$_mysqli = mysqli_connect($this->_host,$this->_username,$this->_password,$this->_database);

			if(!mysqli_connect_errno()){
				return self::$_mysqli;
			}else{
				echo "Connection Failed ". mysqli_connect_error();
			}
		}

		public function Query($q){
			$v =  mysqli_query(self::$_mysqli, $q);
			return $v;
		}

		public function Update($table, $colums, $where){
			return $this->Query("UPDATE {$table} SET {$colums} WHERE {$where}");
		}

		public function FetchAll($howmuch, $table, $where, $order){

			if($howmuch == "all"){
				$howmuch = "*";
			}

			if(isset($where)){
				$q =  $this->Query("SELECT {$howmuch} FROM {$table} WHERE {$where} ORDER BY {$order}");
			}else{
				$q = $this->Query("SELECT {$howmuch} FROM {$table} ORDER BY {$order}");
			}

			$fetchArray = array();

			$i = 0;
			while($fetch = mysqli_fetch_assoc($q)){
				$fetchArray[$i] = $fetch;
				$i++;
			}

			return $fetchArray;
		}

		public function Fetch($howmuch, $from, $where){
			if($where != null){
				$queryString = "SELECT ".$howmuch." FROM ".$from." WHERE ".$where;
			}else{
				$queryString = "SELECT ".$howmuch." FROM ".$from;
			}

			$query = $this->Query($queryString);
			$fetch = mysqli_fetch_assoc($query);
			return $fetch;
		}
		public function Insert($table, $values){
			$q = $this->Query("INSERT INTO `{$table}` VALUES({$values})");
			return $q;
		}

		public function Delete($table, $where){
			$q = $this->Query("DELETE FROM `{$table}` WHERE {$where}");
			return $q;
		}

		public function GetNum($table,$where){
			if(is_null($where) == false){
				$q = $this->Query("SELECT * FROM `{$table}` WHERE {$where}");
				$num = mysqli_num_rows($q);
			}else{
				$q = $this->Query("SELECT * FROM `{$table}`");
				$num = mysqli_num_rows($q);
			}

			return $num;
		}

		public function InsertedId(){
			return mysqli_insert_id(self::$_mysqli);
		}
	}
?>
