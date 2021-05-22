
<?php
	//include connection file 
	include_once("connection.php");
	
	$db = new dbObj();
	$connString =  $db->getConnstring();

	$params = $_REQUEST;
	
	$action = isset($params['action']) != '' ? $params['action'] : '';
	$empCls = new users($connString);

	switch($action) {
	 case 'add':
		$empCls->insertUsers($params);
	 break;
	 case 'edit':
		$empCls->updateUsers($params);
	 break;
	 case 'delete':
		$empCls->deleteUsers($params);
	 break;
	 default:
	 $empCls->getUsers($params);
	 return;
	}
	
	class Users {
	protected $conn;
	protected $data = array();
	function __construct($connString) {
		$this->conn = $connString;
	}
	
	public function getUsers($params) {
		
		$this->data = $this->getRecords($params);
		
		echo json_encode($this->data);
	}
	/*function insertUsers($params) {
		$data = array();;
		$sql = "INSERT INTO `employee` (username, gender, email,user_type,password) VALUES('" . $params["username"] . "', '" . $params["gender"] . "','" . $params["email"] . "', '" . $params["user_type"] . "', '" . $params["password"] . "');  ";
		
		echo $result = mysqli_query($this->conn, $sql) or die("error to insert user data");
		
	}*/
	
	
	function getRecords($params) {
		$rp = isset($params['rowCount']) ? $params['rowCount'] : 10;
		
		if (isset($params['current'])) { $page  = $params['current']; } else { $page=1; };  
        $start_from = ($page-1) * $rp;
		
		$sql = $sqlRec = $sqlTot = $where = '';
		
		if( !empty($params['searchPhrase']) ) {   
			$where .=" WHERE ";
			$where .=" ( username LIKE '".$params['searchPhrase']."%' "; 
			$where .=" OR firstname LIKE '".$params['searchPhrase']."%' ";
			$where .=" OR lastname LIKE '".$params['searchPhrase']."%' ";   
			$where .=" OR gender LIKE '".$params['searchPhrase']."%' ";
			$where .=" OR email LIKE '".$params['searchPhrase']."%' ";
			$where .=" OR user_type LIKE '".$params['searchPhrase']."%' ";
			$where .=" OR password LIKE '".$params['searchPhrase']."%' )";
	   }
	   if( !empty($params['sort']) ) {  
			$where .=" ORDER By ".key($params['sort']) .' '.current($params['sort'])." ";
		}
	   // getting total number records without any search
		$sql = "SELECT * FROM `users` ";
		$sqlTot .= $sql;
		$sqlRec .= $sql;
		
		//concatenate search sql if value exist
		if(isset($where) && $where != '') {

			$sqlTot .= $where;
			$sqlRec .= $where;
		}
		if ($rp!=-1)
		$sqlRec .= " LIMIT ". $start_from .",".$rp;
		
		
		$qtot = mysqli_query($this->conn, $sqlTot) or die("error to fetch tot employees data");
		$queryRecords = mysqli_query($this->conn, $sqlRec) or die("error to fetch employees data");
		
		while( $row = mysqli_fetch_assoc($queryRecords) ) { 
			$data[] = $row;
		}

		$json_data = array(
			"current"            => intval($params['current']), 
			"rowCount"            => 10, 			
			"total"    => intval($qtot->num_rows),
			"rows"            => $data   // total data array
			);
		
		return $json_data;
	}
	function updateUsers($params) {
		$data = array();
		//print_R($_POST);die;
		$sql = "Update `users` set username = '" . $params["edit_username"] . "',firstname = '" . $params["edit_firstname"] . "',lastname = '" . $params["edit_lastname"] . "', gender='" . $params["edit_gender"]."', email='" . $params["edit_email"] . "', user_type='" . $params["edit_user_type"]."', password='" . $params["edit_password"]."' WHERE id='".$_POST["edit_id"]."'";
		
		echo $result = mysqli_query($this->conn, $sql) or die("error to update employee data");
	}
	
	function deleteUsers($params) {
		$data = array();
		//print_R($_POST);die;
		$sql = "delete from `users` WHERE id='".$params["id"]."'";
		
		echo $result = mysqli_query($this->conn, $sql) or die("error to delete user data");
	}
}
?>
	