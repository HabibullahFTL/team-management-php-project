<?php

include 'backend/header_wo_lr.php';


?>
<div class="container">
	<div class="mt-2">
		<h2 style="width: 578px; display: block;margin:auto;">User Login</h2>
	</div>
	<form action="" method="post" enctype="multipart/form-data" style="width: 578px; display: block;margin:auto;justify-content: center;">
		<div class="err">
<?php
if (isset($_POST['login'])) {
	$email = $_POST['email'];
	$password = md5($_POST['pwd']);
	$database = new database;
	$sql = "SELECT * FROM users where email = '$email' && password = '$password'";
	$login = $database->view($sql);
	$loging_info = $login->fetch_object();

	if (isset($loging_info->up_id) && $loging_info->up_id == "2") {
		session_start();
		$_SESSION['id'] = $loging_info->user_id;
		$_SESSION['email'] = $loging_info->email;
		$_SESSION['up_id'] = $loging_info->up_id;
		$_SESSION['user_team'] = $loging_info->user_team;
		header("Location:profile.php");
	}else if (isset($loging_info->up_id) && $loging_info->up_id == "3") {
		session_start();
		$_SESSION['id'] = $loging_info->user_id;
		$_SESSION['email'] = $loging_info->email;
		$_SESSION['up_id'] = $loging_info->up_id;
		$_SESSION['user_team'] = $loging_info->user_team;
		header("Location:profile.php");
	}else if (isset($loging_info->up_id) && $loging_info->up_id == "4") {
		session_start();
		$_SESSION['id'] = $loging_info->user_id;
		$_SESSION['email'] = $loging_info->email;
		$_SESSION['up_id'] = $loging_info->up_id;
		$_SESSION['user_team'] = $loging_info->user_team;
		header("Location:profile.php");
	}else if (isset($loging_info->up_id) && $loging_info->up_id == "101") {
		session_start();
		$_SESSION['id'] = $loging_info->user_id;
		$_SESSION['email'] = $loging_info->email;
		$_SESSION['up_id'] = $loging_info->up_id;
		$_SESSION['user_team'] = $loging_info->user_team;
	}else if (isset($loging_info->up_id) && $loging_info->up_id == "100") {
		echo "<div class='alert alert-danger mt-3'><button type='button' class='close' data-dismiss='alert'>&times;</button>Your account not approved yet. Wait, till approve.</div>";
	}else if (isset($loging_info->up_id) && $loging_info->up_id == "102") {
		echo "<div class='alert alert-danger mt-3'><button type='button' class='close' data-dismiss='alert'>&times;</button>Your account has been blocked.</div>";
	}else{
		echo "<div class='alert alert-danger mt-3'><button type='button' class='close' data-dismiss='alert'>&times;</button>Email or password is incorrect.</div>";
	}
}

?>
		</div>
		<div class="form-group">
			<label for="email">Email:</label>
			<input type="text" class="form-control" name="email">
		</div>
		<div class="form-group">
			<label for="pwd">Password:</label>
			<input type="password" class="form-control" name="pwd">
		</div>
		<div class="form-check mb-2">
			<label for="chk" class="form-check-label">
				<input type="checkbox" id="chk"> Remember me.
			</label>
		</div>
		<input type="Submit" class="btn btn-success" value="Login" name="login">
		<a href="register.php" class="btn btn-primary ml-3">Register</a>
	</form>
</div>

<?php

include 'backend/footer.php';

?>