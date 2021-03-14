<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width/initial-scale=1.0">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<body>


	<?php

	include 'config/database.php';
	session_start();
	if ($_SESSION['id'] == "") {
		header('location:login.php');
	}else if ($_SESSION['id'] != "") {
		$user_id = $_SESSION['id'];
	}

	function userIdToName($user_id)
	{
		$database = new database;
		$sql = "SELECT * From users where user_id = '$user_id'";
		$user_name = $database->view($sql);
		$user_name_data = $user_name->fetch_object();
		$userName = $user_name_data->name;
		return $userName;
	}

	function userIdToUpid($user_id)
	{
		$database = new database;
		$sql = "SELECT * From users where user_id = '$user_id'";
		$user_name = $database->view($sql);
		$user_name_data = $user_name->fetch_object();
		$up_id = $user_name_data->up_id;
		return $up_id;
	}
	function userIdToProfileImg($user_id)
	{
		$database = new database;
		$sql = "SELECT * From users where user_id = '$user_id'";
		$user_name = $database->view($sql);
		$user_name_data = $user_name->fetch_object();
		$profile_img = $user_name_data->profile_img;
		return $profile_img;
	}
	function userIdToUp($user_id)
	{
		$database = new database;
		$sql = "SELECT * From users where user_id = '$user_id'";
		$user_name = $database->view($sql);
		$user_name_data = $user_name->fetch_object();
		$up_id = $user_name_data->up_id;

		$up_sql = "SELECT * FROM user_positions Where up_id = $up_id";
		$up_name = $database->view($up_sql);
		$up_name_data = $up_name->fetch_object();
		$up = $up_name_data->up_name;

		return $up;
	}


	?>







	<div class="wrap">
		<nav class="navbar navbar-expand-md bg-dark navbar-dark sticky-top">
			<div class="container">
				<a href="index.php" class="navbar-brand">10MS Team</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapseNavbar">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="collapseNavbar">
					<ul class="navbar-nav" >
						<li class="nav-item"><a href="profile.php" class="nav-link">Profile</a></li>
						<li class="nav-item"><a href="users.php" class="nav-link">Users</a></li>
						<li class="nav-item"><a href="team.php" class="nav-link">My Team</a></li>
						<li class="nav-item"><a href="posts.php" class="nav-link">Posts</a></li>
						<li class="nav-item"><a href="recent_posts.php" class="nav-link">Recent Posts</a></li>
						<li class="nav-item">
							<form action="search.php" method="post" class="form-inline">
								<div class="form-group">
									<input type="text" name="search_input" class="form-control mr-1">
								</div>
								<input type="submit" name="search" value="Search" class="btn btn-success mr-3">
							</form>
						</li>
						<li class="nav-item"><a href="backend/validation.php?logout=<?php echo $_SESSION['id']?>" class="btn btn-secondary">Log out</a></li>
					</ul>
				</div>
			</div>
		</nav>