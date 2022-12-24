<?php
class database{
	/*public $host = 'localhost';
	public $user = 'webspeckyHR';
	public $pwd = '$$HR12$$';*/
	public $dbhost = "sg2nlmysql37plsk.secureserver.net";
	public $dbname = "hr";
	public $dbuser = "webspeckyHR";
	public $dbpass = '$$HR12$$';
	public $dbport = '3306';
	
	/*public $host = "localhost";
	public $user = "root";
	public $pwd = "";
	*/
	
	public function connect(){
		//$conn = mysql_connect($this->host,$this->user,$this->pwd);
		//$db = mysql_select_db("hr",$conn);	
		/*mysqli_connect($host,$user, $pwd) or die ("<html><script language='JavaScript'>alert('Unable to connect to database! Please try again later.'),history.go(-1)</script></html>");
	mysqli_select_db("hr");
		*/
		//return $conn;
		$con = @mysqli_connect($this->dbhost,$this->dbuser,$this->dbpass,$this->dbname,$this->dbport);
		//$db = mysql_select_db("hr",$con);
		$result = 0;
		if (mysqli_connect_errno()) {
			$result = "Failed to connect to MySQL using the PHP mysqli extension: " . mysqli_connect_error();
		}
		else{
			$result = "Connected";
		}
		return $con;
	}
	
	public function select_count($table){
		$con = $this->connect();
		$sqlcnt = mysqli_fetch_assoc(mysqli_query($con,"select count(*) as cnt from ".$table));
		return $sqlcnt['cnt'];
		
	}
	
	public function select_col_count($table,$col){
		$con = $this->connect();
		$sqlcnt = mysqli_fetch_assoc(mysqli_query($con,"select count(".$col.") as cnt from ".$table));
		return $sqlcnt['cnt'];
		
	}
	
	public function select_col_count_part($table,$col,$clause){
		$con = $this->connect();
		$sqlcnt = mysqli_fetch_assoc(mysqli_query($con,"select count(".$col.") as cnt from ".$table." ".$clause));
		return $sqlcnt['cnt'];
		
	}
	/*---------------$clause must not contain  (where)-----------------------*/
	public function select_count_part($table,$clause){
		$con = $this->connect();
		$sqlcnt = mysqli_fetch_assoc(mysqli_query($con,"select count(*) as cnt from ".$table." where ".$clause));
	
		return $sqlcnt['cnt'];
		
		
	}
	
	public function select_sum($table,$col){
		$con = $this->connect();
		$sqlsum = mysqli_fetch_assoc(mysqli_query($con,"select sum($col) as sum from ".$table));
		return $sqlsum['sum'];
	}
	
	/*---------------$data must be an associative array with column names as its keys and field values as its values-----------------------*/
	public function insert_all($table,$data){
		$con = $this->connect();
		$sqlins = mysqli_query($con,"insert into ".$table."(".implode(',',array_keys($data)).") values('".implode("' , '",$data)."')");
		return mysqli_insert_id($con);
		//return "insert into ".$table."(".implode(',',array_keys($data)).") values('".implode("' , '",$data)."')";
	}

	/*---------------$data must be an associative array with column names as its keys and field values as its values-----------------------*/
	public function insert_all_emp($table,$data){
		$con = $this->connect();
		$sqlins = mysql_query($con,"insert into ".$table."(".implode(',',array_keys($data)).") values('".implode("' , '",$data)."')");
		//return mysql_insert_id();
		return "insert into ".$table."(".implode(',',array_keys($data)).") values('".implode("' , '",$data)."')";
	}

	
	
	public function delete_all($table){
		$con = $this->connect();
		$sqldel = mysqli_query($con,"delete from ".$table);
		return $sqldel;
	}
	
	/*---------------$clause must not contain  (where)-----------------------*/
	public function delete_part($table,$clause){
		$con = $this->connect();
		$sqldel = mysqli_query($con,"delete from ".$table." where ".$clause);
		return $sqldel;
	}
	
	public function select_all($table){
		$con = $this->connect();
		$sqlsel = mysqli_query($con,"select * from ".$table);
		return $sqlsel;
	}
	
	public function select_all_order($table,$order){
		$con = $this->connect();
		$sqlcol = mysqli_query($con,"select * from ".$table." ".$order);
		return $sqlcol;
	}
	
	/*---------------$clause must not contain  (where)-----------------------*/
	public function select_part($table,$clause){
		$con = $this->connect();
		$sqlsel = mysqli_query($con,"select * from ".$table." where ".$clause);
		return $sqlsel;
	}
	
	/*------- Format of the column must be col1,col2,col3.......coln --------*/
	public function select_col_all($table,$col){
		$con = $this->connect();
		$sqlcol = mysqli_query($con,"select $col from ".$table);
		return $sqlcol;
	}
	
	public function select_col_all_order($table,$col,$order){
		$con = $this->connect();
		$sqlcol = mysqli_query($con,"select $col from ".$table." ".$order);
		return $sqlcol;
	}
	
	/*------- Format of the column must be col1,col2,col3.......coln and $clause must not contain  (where) --------*/
	public function select_col_part($table,$col,$clause){
		$con = $this->connect();
		$sqlcol = mysqli_query($con,"select ".$col." from ".$table." where ".$clause);
		return $sqlcol;
	}
	
	/*------- Format of the $data must be col1=val1,col2=val2,col3=val3.......coln=valn --------*/
	public function update_all($table,$data){
		$con = $this->connect();
		$sqlup = mysqli_query($col,"update ".$table." set ".$data);
		return "update ".$table." set ".$data;
	}
	public function update_part($table,$data,$clause){
		$con = $this->connect();
		$sqlup = mysqli_query($con,"update ".$table." set ".$data." where ".$clause);
		return "update ".$table." set ".$data." where ".$clause;
	}
	public function droptab(){
		$con = $this->connect();
		$sqlcol = mysqli_query($con,"drop table attend_dummy");
		return $sqlcol;
	}
	
	public function commonquery($query){
		$con = $this->connect();
		$que = mysqli_query($con,$query);
		return $que;
		
	}
	

}
?>