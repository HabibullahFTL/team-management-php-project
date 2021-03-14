<?php

include 'backend/header.php';
if (isset($_GET['user_id'])) {
	$user_id = $_GET['user_id'];
}else{
	$user_id = $_SESSION['id'];
}

if (isset($_GET['user_id']) && $_GET['user_id'] != "") {
	$user_id = $_GET['user_id'];
}else if (isset($_GET['user_id']) && $_GET['user_id'] == "") {
	header("location:profile.php");
}else if (!isset($_GET['post_id'])) {
	$user_id = $_SESSION['id'];
}

$database = new database;
$sql_users = "SELECT * FROM users Where user_id = $user_id";

$users = $database->view($sql_users);
$data_users = $users->fetch_object();

if (isset($data_users)) {
	$name = $data_users->name;
	$image = $data_users->profile_img;
	$up_id = $data_users->up_id;
	$team = $data_users->user_team;
	$about = $data_users->about;

	$sql_up = "SELECT * FROM user_positions Where up_id = $up_id";
	$up = $database->view($sql_up);
	$data_up = $up->fetch_object();

	$position = $data_up->up_name;
}else{
	header("location:profile.php");
}



?>
<div class="container">
	<div class="mt-2">
		<h2>Profile</h2>
	</div>
	<div class="card">
		<div class="card-body row">
			<div class="col-8 col-sm-6 col-md-4 col-lg-3">
				<img class="img-thumbnail mx-auto d-block" src="user_img/<?php echo $image ?>" alt="">
			</div>
			<div class="col-12 col-sm-6 col-md-8 col-lg-9">
				<h4 class="user-name"><?php echo $name ?></h4>
				<p class="user-position"><?php echo $position?></p>
				<p class="user-team"><?php echo $team?></p>
				<?php
				if (isset($_GET['user_id'])) {
					$user_id = $_GET['user_id'];
					echo "<p class='user-about'><b>About $name </b>$about</p>";
				}else if(!isset($_GET['user_id'])){
					echo "<p class='user-about'><b>About me</b>$about</p>";
				}
				?>
			</div>
		</div>
	</div>
	<?php
	if (isset($_GET['user_id']) && $_GET['user_id'] == $_SESSION['id']) {
		echo "<div class='d-block mt-3'>
		<b>
		<a href='create_post.php' class='btn btn-success tw200 mr-1 mb-1'>Create Post</a>
		<a href='update_profile.php?action=update_profile' class='btn btn-primary tw200 mr-1 mb-1'>Update Profile Info</a>
		<a href='update_profile.php?action=update_email' class='btn btn-info tw200mr-1 mb-1'>Change Email Address</a>
		<a href='update_profile.php?action=update_password' class='btn btn-secondary tw200 mr-1 mb-1'>Change Password</a>
		</b>
		</div>";
		echo "	<div class='mt-2'>
		<h2 class='d-block'>My posts</h2>		
		</div>";
	}else if (isset($_GET['user_id']) && $_SESSION['up_id'] == 2 && $_GET['user_id'] != $_SESSION['id']) {
		$user_id = $_GET['user_id'];
		echo "<div class='d-block mt-3'>
		<b>
		<a href='update_profile.php?user_id=$user_id&action=update_profile' class='btn btn-primary tw200 mr-1 mb-1'>Update Profile Info</a>
		<a href='update_profile.php?action=update_email' class='btn btn-info tw200 mr-1 mb-1'>Change Email Address</a>
		<a href='update_profile.php?user_id=$user_id&action=update_password' class='btn btn-secondary tw200 mr-1 mb-1'>Change Password</a>
		</b>
		</div>";
		echo "	<div class='mt-2'>
		<h2 class='d-block'>$name's Posts</h2>		
		</div>";
	}else if(!isset($_GET['user_id'])){
		echo "<div class='d-block mt-3'>
		<b>
		<a href='create_post.php' class='btn btn-success tw200 mr-1 mb-1'>Create Post</a>
		<a href='update_profile.php?action=update_profile' class='btn btn-primary tw200 mr-1 mb-1'>Update Profile Info</a>
		<a href='update_profile.php?action=update_email' class='btn btn-info tw200 mr-1 mb-1'>Change Email Address</a>
		<a href='update_profile.php?action=update_password' class='btn btn-secondary tw200 mr-1 mb-1'>Change Password</a>
		</b>
		</div>";
		echo "	<div class='mt-1'>
		<h2 class='d-block'>My posts</h2>		
		</div>";
	}else{
		echo "	<div class='mt-1'>
		<h2 class='d-block'>$name's posts</h2>		
		</div>";
	}
	?>
	
	<div style="clear: both;">
		<ul class="nav nav-tabs" role="tablist">
			<li class="nav-item">
				<a class="nav-link active" data-toggle="tab" href="#approved_posts" style="text-decoration: none;color: #333!important;"><h5>Recent Posts</h5></a>
			</li>
			<?php
			if (isset($_GET['user_id']) && $_GET['user_id'] == $_SESSION['id']) {
				echo "<li class='nav-item'>
				<a class='nav-link' data-toggle='tab' href='#pending_posts' style='text-decoration: none;color: #333!important;'><h5>Pending Posts</h5></a>
				</li>";
			}else if (isset($_GET['user_id']) && $_SESSION['up_id'] == 2 && $_GET['user_id'] != $_SESSION['id']) {
				$user_id = $_GET['user_id'];
				echo "<li class='nav-item'>
				<a class='nav-link' data-toggle='tab' href='#pending_posts' style='text-decoration: none;color: #333!important;'><h5>Pending Posts</h5></a>
				</li>";
			}else if(!isset($_GET['user_id'])){
				echo "<li class='nav-item'>
				<a class='nav-link' data-toggle='tab' href='#pending_posts' style='text-decoration: none;color: #333!important;'><h5>Pending Posts</h5></a>
				</li>";
			}else{
				echo "";
			}
			?>
			
		</ul>
		<div class="tab-content">
			<div id="approved_posts" class="container tab-pane active"><br>
				<table class="table table-striped">
					<?php
					$database = new database;
					$sql = "SELECT * FROM posts where user_id = $user_id && post_status = 'Approved' ORDER by post_id DESC LIMIT 0,5";
					$posts = $database->view($sql);
					while($data= $posts->fetch_object()){
						if (isset($_GET['user_id']) && $_GET['user_id'] == $_SESSION['id']) {
							echo "<tr>";
							echo "<td colspan='2'>
							<a href='edit_post.php?post_id=$data->post_id' class='btn btn-primary mr-3'>Edit Post</a>
							<a href='backend/validation.php?post_id=$data->post_id&post_status=User_Delete' class='btn btn-danger'>Delete Post</a>
							</td>";
							echo "</tr>";
						}else if (isset($_GET['user_id']) && $_SESSION['up_id'] == 2 && $_GET['user_id'] != $_SESSION['id']) {
							$user_id = $_GET['user_id'];
							echo "";
						}else if(!isset($_GET['user_id'])){
							echo "<tr>";
							echo "<td colspan='2'>
							<a href='edit_post.php?post_id=$data->post_id' class='btn btn-primary mr-3'>Edit Post</a>
							<a href='backend/validation.php?post_id=$data->post_id&post_status=User_Delete' class='btn btn-danger'>Delete Post</a>
							</td>";
							echo "</tr>";
						}else{
							echo "";
						}
						echo "<tr>";
						echo "<td colspan='2'>
						<h5><a href='view_post.php?post_id=$data->post_id'>".$data->title."</a></h5>
						</td>";
						echo "<tr></tr>";
						echo "</tr>";


						echo "<tr>
						<td><img src='user_img/$data->image' width='200px' alt=''>
						</td>";
						echo "<td>";
						echo "<P class='post-author'>$name</p><p class='post-time'><b>Posted at:</b> ".$data->created_at." </p><p class='author-group'>[ $position ]</p>";
						echo "<p class='post-description mt-3'>".mb_substr($data->description,0,600)." . . .<a href='view_post.php?post_id=$data->post_id'><b>Read More »</b></a></p>";
						echo "</td>";
						echo "</tr>";;
					}
					?>
				</table>
			</div>

			<?php
			if (isset($_GET['user_id']) && $_GET['user_id'] == $_SESSION['id']) {
				$user_id = $_GET['user_id'];
				echo "<div id='pending_posts' class='container tab-pane fade'><br>
				<table class='table table-striped table-bordered'>";
				$database = new database;
				$sql = "SELECT * FROM posts where user_id = $user_id && post_status = 'Pending' ORDER by post_id DESC LIMIT 0,5";
				$posts = $database->view($sql);
				while($data= $posts->fetch_object()){
					echo "<tr>";
					echo "<td colspan='2'>
					<a href='edit_post.php?post_id=$data->post_id' class='btn btn-primary mr-3'>Edit Post</a>
					<a href='backend/validation.php?post_id=$data->post_id&post_status=User_Delete' class='btn btn-danger'>Delete Post</a>
					</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td colspan='2'>
					<h5><a href='view_post.php?post_id=$data->post_id'>$data->title
					</a></h5>
					</td>";
					echo "</tr>";

					echo "<tr>
					<td><img src='user_img/$data->image' width='200px' alt=''>
					</td>";
					echo "<td>";
					echo "<P class='post-author'>Habibullah Bahar</p><p class='post-time'><b>Posted at:</b>$data->created_at </p><p class='author-group'>[ Contributor ]</p>";
					echo "<p class='post-description mt-3'>".mb_substr($data->description,0,600)." . . .<a href='view_post.php?post_id=$data->post_id'><b>Read More »</b></a></p>";
					echo "</td>";
					echo "</tr>";
				}

				echo "</table>
				</div>";
			}else if (isset($_GET['user_id']) && $_SESSION['up_id'] == 2 && $_GET['user_id'] != $_SESSION['id']) {
				$user_id = $_GET['user_id'];
				echo "<div id='pending_posts' class='container tab-pane fade'><br>
				<table class='table table-striped table-bordered'>";
				$database = new database;
				$sql = "SELECT * FROM posts where user_id = $user_id && post_status = 'Pending' ORDER by post_id DESC LIMIT 0,5";
				$posts = $database->view($sql);
				while($data= $posts->fetch_object()){
					echo "<tr>";
					echo "<td colspan='2'>
					<h5><a href='view_post.php?post_id=$data->post_id'>".$data->title."</a></h5>
					</td>";
					echo "</tr>";

					echo "<tr>
					<td><img src='user_img/$data->image' width='200px' alt=''>
					</td>";
					echo "<td>";
					echo "<P class='post-author'>Habibullah Bahar</p><p class='post-time'><b>Posted at:</b> $data->created_at </p><p class='author-group'>[ Contributor ]</p>";
					echo "<p class='post-description mt-3'>".mb_substr($data->description,0,600)." . . .<a href='view_post.php?post_id=$data->post_id'><b>Read More »</b></a></p>";
					echo "</td>";
					echo "</tr>";
				}

				echo "</table>
				</div>";
			}else if(!isset($_GET['user_id'])){
				echo "<div id='pending_posts' class='container tab-pane fade'><br>
				<table class='table table-striped table-bordered'>";
				$database = new database;
				$sql = "SELECT * FROM posts where user_id = $user_id && post_status = 'Pending' ORDER by post_id DESC LIMIT 0,5";
				$posts = $database->view($sql);
				while($data= $posts->fetch_object()){
					echo "<tr>";
					echo "<td colspan='2'>
					<a href='edit_post.php?post_id=$data->post_id' class='btn btn-primary mr-3'>Edit Post</a>
					<a href='backend/validation.php?post_id=$data->post_id&post_status=User_Delete' class='btn btn-danger'>Delete Post</a>
					</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td colspan='2'>
					<h5><a href='view_post.php?post_id=$data->post_id'>".$data->title."</a></h5>
					</td>";
					echo "</tr>";

					echo "<tr>
					<td><img src='user_img/$data->image' width='200px' alt=''>
					</td>";
					echo "<td>";
					echo "<P class='post-author'>Habibullah Bahar</p><p class='post-time'><b>Posted at:</b> $data->created_at </p><p class='author-group'>[ Contributor ]</p>";
					echo "<p class='post-description mt-3'>".mb_substr($data->description,0,600)." . . .<a href='view_post.php?post_id=$data->post_id'><b>Read More »</b></a></p>";
					echo "</td>";
					echo "</tr>";
				}

				echo "</table>
				</div>";
			}else{
				echo "";
			}
			
			?>
		</div>
	</div>
</div>
<?php


include 'backend/footer.php';

?>