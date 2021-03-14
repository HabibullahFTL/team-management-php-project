<?php

include '../config/database.php';
session_start();

function valid($data)
{
	$data = trim($data);
	$data = htmlspecialchars($data);
	$data = stripcslashes($data);
	return $data;
}

if (isset($_POST['update_email'])) {
	$database = new database;
	$update_user_id = $_POST['user_id'];
	$update_email = $_POST['email'];
	$sql_chk = "SELECT * From users where email = '$update_email'";
	$chk = $database->view($sql_chk);
	$chk_email = $chk->fetch_object();
	$get_email = $chk_email->email;
	if ($update_email != "" && $update_email == $get_email){
		header("location:../update_profile.php?action=update_email&msg=used");
	}else if(filter_var($update_email, FILTER_VALIDATE_EMAIL) == false){
		header("location:../update_profile.php?action=update_email&msg=unvalid");
	}else if ($update_email != "" && $update_email != $get_email){
		$sql = "UPDATE users SET email = '$update_email' where user_id = $update_user_id";
		$database->post($sql);
		header("location:../update_profile.php?action=update_email&msg=success");
	}
		//$database->post($sql);
		


}

//For Approve-Post
if (isset($_GET['post_status']) && $_GET['post_status'] == "Approved" && $_SESSION['up_id'] == 2) {
	$post_id = $_GET['post_id'];
	$database = new database;
	$sql = "UPDATE posts SET post_status = 'Approved' where post_id = '$post_id'";
	$database ->post($sql);
	header("location:../posts.php");
}

//For make post pending
if (isset($_GET['post_status']) && $_GET['post_status'] == "Under_Review" && $_SESSION['up_id'] == 2) {
	$post_id = $_GET['post_id'];
	$database = new database;
	$sql = "UPDATE posts SET post_status = 'Pending' where post_id = '$post_id'";
	$database ->post($sql);
	header("location:../posts.php");
}

//For decline post
if (isset($_GET['post_status']) && $_GET['post_status'] == "Declined" && $_SESSION['up_id'] == 2) {
	$post_id = $_GET['post_id'];
	$database = new database;
	$sql = "UPDATE posts SET post_status = 'Declined' where post_id = '$post_id'";
	$database ->post($sql);
	header("location:../posts.php");
}

//For permanant delete psot(Only for admin)
if (isset($_GET['post_status']) && $_GET['post_status'] == "Delete" && $_SESSION['up_id'] == 2) {
	$post_id = $_GET['post_id'];

	$database = new database;

	$sql = "SELECT * FROM posts where post_id = '$post_id'";
			$posts = $database->view($sql);
	$data= $posts->fetch_object();
	$image = "../user_img/".$data->image;
	echo $image;
	unlink($image);



	$sql = "DELETE FROM posts WHERE post_id = '$post_id'";
	$database ->post($sql);
	header("location:../posts.php");
}

//For delete post by user(Temporary but admin can see the post)
if (isset($_GET['post_status']) && $_GET['post_status'] == "User_Delete") {
	$post_id = $_GET['post_id'];
	$database = new database;
	$sql = "UPDATE posts SET post_status = 'User Deleted' where post_id = '$post_id'";
	$database ->post($sql);
	header("location:../profile.php");
}

//Form Approve User
if ($_GET['up_id'] == "101" && $_SESSION['up_id'] == 2) {
	$user_id = $_GET['user_id'];
	$database = new database;
	$sql = "UPDATE users SET up_id = '101' where user_id = '$user_id'";
	$database ->post($sql);
	header("location:../users.php");
}

//For Promotion
if (isset($_POST['user_promotion']) && $_SESSION['up_id'] == 2) {
	$user_id = $_POST['user_id'];
	$up_id = $_POST['up_id'];
	$user_team = $_POST['user_team'];
	$database = new database;
	if ($user_team == "DM") {
		$sql = "UPDATE users SET up_id = '$up_id', user_team = 'Digital Marketing Team' where user_id = $user_id";
		$database->post($sql);
		header("location:../users.php");
	}else if($user_team == "CM"){
		$sql = "UPDATE users SET up_id = '$up_id', user_team = 'Content Management Team' where user_id = $user_id";
		$database->post($sql);
		header("location:../users.php");
	}else if($user_team == "Tech"){
		$sql = "UPDATE users SET up_id = '$up_id', user_team = 'Tech Team' where user_id = $user_id";
		$database->post($sql);
		header("location:../users.php");
	}
}

//Form Block User
if ($_GET['up_id'] == "102" && $_SESSION['up_id'] == 2) {
	$user_id = $_GET['user_id'];
	$database = new database;
	$sql = "UPDATE users SET up_id = '102' where user_id = '$user_id'";
	$database ->post($sql);
	header("location:../users.php");
}

//Form Delete User
if ($_GET['up_id'] == "Delete_User" && $_SESSION['up_id'] == 2) {
	$user_id = $_GET['user_id'];
	$database = new database;
	$sql = "DELETE FROM users WHERE user_id = '$user_id'";
	$database ->post($sql);
	header("location:../users.php");
}


//For Log out
if(isset($_GET['logout']) && $_GET['logout'] != ""){
	session_start();
	session_unset();
	session_destroy();
	header('location:../login.php');
}


?>