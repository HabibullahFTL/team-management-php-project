<?php

include 'backend/header.php';
$database = new database;
$my_team = $_SESSION['user_team'];


?>
<div class="container">
	<div class="mt-2">
		<h2>My Team Members</h2>
	</div>
	<?php


	$sql = "SELECT * FROM users WHERE user_team = '$my_team' and up_id != '100' and up_id != '101' and up_id != '102' Order by up_id";
	$users = $database->view($sql);
	while ($data = $users->fetch_object()) {

		$sql_up = "SELECT * FROM user_positions Where up_id = $data->up_id";
		$up = $database->view($sql_up);
		$data_up = $up->fetch_object();
		$position = $data_up->up_name;

		echo "<div class='card float-left mr-4 mb-4' style='width: 300px;'>
		<img src='user_img/$data->profile_img' class='card-img-top' width='300px' height='300px' alt=''>
		<div class='card-body'>
		<h5 class='card-title'>$data->name</h5>
		<p class='card-text'>$position<br>
		$data->user_team</p>
		<a class='btn btn-success btn-block' href='profile.php?user_id=$data->user_id'>See profile</a>
		</div>
		</div>";
	}
	?>
	
</div>











<?php

include 'backend/footer.php';

?>