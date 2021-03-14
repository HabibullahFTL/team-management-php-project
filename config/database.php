<?php


class database{
	public $localhost = 'localhost';
	public $username  = 'root';
	public $password  = 'admin';
	public $database  = 'main_db';
	public $con;
	public function __construct()
	{
		$this->con = mysqli_connect($this->localhost,$this->username,$this->password,$this->database);
        $this->con -> set_charset("utf8");
	}
	public function post($post){
		$post = $this->con->query($post);

	}
	public function view($view){
		$view = $this->con->query($view);
		return $view;
	}
	public function check_email($email){
		$sql = "SELECT * FROM users where email = '$email'";
		$query = mysqli_query($this->con,$sql);
		$row = mysqli_fetch_assoc($query);

		return $row;
	}
	public function check_search($search_input){
		$sql = "SELECT * FROM posts where title = '$search_input' or description = '$search_input'";
		$query = mysqli_query($this->con,$sql);
		$row = mysqli_fetch_assoc($query);

		return $row;
	}
	public function check_password($old_pass,$user_id){
		$sql = "SELECT * FROM users where password = '$old_pass' && user_id = '$user_id'";
		$query = mysqli_query($this->con,$sql);
		$row = mysqli_fetch_assoc($query);

		return $row;
	}

}



?>