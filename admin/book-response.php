
<?php
	//include connection file 
	include_once("connection1.php");
	
	$db = new dbObj();
	$connString =  $db->getConnstring();

	$params = $_REQUEST;
	
	$action = isset($params['action']) != '' ? $params['action'] : '';
	$empCls = new books($connString);

	switch($action) {
	 case 'add':
		$empCls->insertBooks($params);
	 break;
	 case 'edit':
		$empCls->updateBooks($params);
	 break;
	 case 'delete':
		$empCls->deleteBooks($params);
	 break;
	 default:
	 $empCls->getBooks($params);
	 return;
	}
	
	class Books {
	protected $conn;
	protected $data = array();
	function __construct($connString) {
		$this->conn = $connString;
	}
	
	public function getBooks($params) {
		
		$this->data = $this->getRecord($params);
		
		echo json_encode($this->data);
	}
	/*function insertBooks($params) {
		$data = array();;
		$sql = "INSERT INTO `employee` (book_title, book_genre, created_date,user_type,password) VALUES('" . $params["book_title"] . "', '" . $params["book_genre"] . "','" . $params["created_date"] . "', '" . $params["user_type"] . "', '" . $params["password"] . "');  ";
		
		echo $result = mysqli_query($this->conn, $sql) or die("error to insert user data");
		
	}*/
	
	
	function getRecord($params) {
		$rp = isset($params['rowCount']) ? $params['rowCount'] : 10;
		
		if (isset($params['current'])) { $page  = $params['current']; } else { $page=1; };  
        $start_from = ($page-1) * $rp;
		
		$sql = $sqlRec = $sqlTot = $where = '';
		
		if( !empty($params['searchPhrase']) ) {   
			$where .=" WHERE ";
			$where .=" ( book_title LIKE '".$params['searchPhrase']."%' "; 
			$where .=" OR book_author LIKE '".$params['searchPhrase']."%' ";
			$where .=" OR book_publisher LIKE '".$params['searchPhrase']."%' ";   
			$where .=" OR book_genre LIKE '".$params['searchPhrase']."%' ";
			$where .=" OR created_date LIKE '".$params['searchPhrase']."%' ";
	   }
	   if( !empty($params['sort']) ) {  
			$where .=" ORDER By ".key($params['sort']) .' '.current($params['sort'])." ";
		}
	   // getting total number records without any search
		$sql = "SELECT * FROM `books` ";
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
	function updateBooks($params) {
		$data = array();
		//print_R($_POST);die;
		$sql = "Update `books` set book_title = '" . $params["edit_book_title"] . "',book_author = '" . $params["edit_book_author"] . "',book_publisher = '" . $params["edit_book_publisher"] . "', book_genre='" . $params["edit_book_genre"]."', created_date='" . $params["edit_created_date"] . "' WHERE book_id='".$_POST["edit_book_id"]."'";
		
		echo $result = mysqli_query($this->conn, $sql) or die("error to update employee data");
	}
	
	function deleteBooks($params) {
		$data = array();
		//print_R($_POST);die;
		$sql = "delete from `books` WHERE book_id='".$params["book_id"]."'";
		
		echo $result = mysqli_query($this->conn, $sql) or die("error to delete user data");
	}
}
?>
	