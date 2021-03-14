<?php


include 'backend/header.php';


?>
<div class="container">
	<div class="mt-2 ">
		<h2>Post List</h2>
	</div>
	<ul class='nav nav-tabs' role='tablist'>
		<?php
		if (isset($_SESSION['up_id']) && $_SESSION['up_id'] == 2) {
			echo "<li class='nav-item'>
			<a class='nav-link active' data-toggle='tab' href='#approved_posts' style='text-decoration: none;color: #333!important;'><h5>Approved Posts</h5></a>
			</li>
			<li class='nav-item'>
			<a class='nav-link' data-toggle='tab' href='#pending_posts' style='text-decoration: none;color: #333!important;'><h5>Pending Posts</h5></a>
			</li>
			<li class='nav-item'>
			<a class='nav-link' data-toggle='tab' href='#declined_posts' style='text-decoration: none;color: #333!important;'><h5>Declined Posts</h5></a>
			</li>
			<li class='nav-item'>
			<a class='nav-link' data-toggle='tab' href='#user_deleted_posts' style='text-decoration: none;color: #333!important;'><h5>User Deleted Posts</h5></a>
			</li>";}else{
				echo "<li class='nav-item'>
				<a class='nav-link active' data-toggle='tab' href='#approved_posts' style='text-decoration: none;color: #333!important;'><h5>All Posts</h5></a>
				</li>";
			}
			?>
		</ul>

		<!-- Tab panes -->
		<div class='tab-content'>
			<?php
if (isset($_SESSION['up_id']) && $_SESSION['up_id'] == 2) {
		// For showing Approved Post
			echo "<div id='approved_posts' class='container tab-pane active'><br>
			<table class='table table-striped'>";
			$database = new database;
			$sql = "SELECT * FROM posts where post_status = 'Approved' ORDER by post_id DESC LIMIT 0,5";
			$posts = $database->view($sql);
			while($data= $posts->fetch_object()){

				//(Start) This code for showing post author name and position
				$user_id =$data->user_id;
				$sql_users = "SELECT * FROM users Where user_id = $user_id";
				$users = $database->view($sql_users);
				$data_users = $users->fetch_object();
				$user_up_id = $data_users->up_id;
				$name = $data_users->name;

				$sql_up = "SELECT * FROM user_positions Where up_id = $user_up_id";
				$up = $database->view($sql_up);
				$data_up = $up->fetch_object();
				$position = $data_up->up_name;
				//(Start) This code for showing post author name and position

				echo "<tr>";
				echo "<td colspan='3'>
				<a href='backend/validation.php?post_id=$data->post_id&post_status=Under_Review' class='btn btn-primary mr-1'>Under Review</a>
				<a href='backend/validation.php?post_id=$data->post_id&post_status=Declined' class='btn btn-danger'>Decline</a>
				</td>";
				echo "</tr>";

				echo "<tr>";
				echo "<td><img src='user_img/$data->image' width='100px' alt=''></td>";
				echo "<td>";
				echo "<h5><a href='view_post.php?post_id=$data->post_id'>".$data->title."</a></h5>";
				echo "<P class='post-author'>$name</p><p class='post-time'><b>Posted at:</b> ".$data->created_at." </p><p class='author-group'> [ $position ] </p>";
				echo "<p class='post-description mt-3'>".mb_substr($data->description,0,500)." . . .<a href='view_post.php?post_id=$data->post_id'><b>Read More »</b></a></p>";
				echo "</td>";
				echo "</tr>";
			}
			echo "</table>
			</div>";

		// For showing Pendin Post
			
				echo "<div id='pending_posts' class='container tab-pane fade'><br>

				<table class='table table-striped'>";
				$database = new database;
				$sql = "SELECT * FROM posts where post_status = 'Pending' ORDER by post_id DESC LIMIT 0,5";
				$posts = $database->view($sql);
				while($data= $posts->fetch_object()){

				//(Start) This code for showing post author name and position
					$user_id =$data->user_id;
					$sql_users = "SELECT * FROM users Where user_id = $user_id";
					$users = $database->view($sql_users);
					$data_users = $users->fetch_object();
					$user_up_id = $data_users->up_id;
					$name = $data_users->name;

					$sql_up = "SELECT * FROM user_positions Where up_id = $user_up_id";
					$up = $database->view($sql_up);
					$data_up = $up->fetch_object();
					$position = $data_up->up_name;
				//(End) This code for showing post author name and position

					echo "<tr>";
					echo "<td colspan='3'>
					<a href='backend/validation.php?post_id=$data->post_id&post_status=Approved' class='btn btn-success mr-1'>Approve</a>
					<a href='backend/validation.php?post_id=$data->post_id&post_status=Declined' class='btn btn-danger'>Decline</a>
					</td>";
					echo "</tr>";

					echo "<tr>";
					echo "<td><img src='user_img/$data->image' width='100px' alt=''></td>";
					echo "<td>";
					echo "<h5><a href='view_post.php?post_id=$data->post_id'>".$data->title."</a></h5>";
					echo "<P class='post-author'>$name</p><p class='post-time'><b>Posted at:</b> ".$data->created_at." </p><p class='author-group'> [ $position ] </p>";
					echo "<p class='post-description mt-3'>".mb_substr($data->description,0,500)." . . .<a href='view_post.php?post_id=$data->post_id'><b>Read More »</b></a></p>";
					echo "</td>";
					echo "</tr>";
				}
				echo "</table>
				</div>";


		// For showing Declined Post
				echo "<div id='declined_posts' class='container tab-pane fade'><br>
				<table class='table table-striped'>";
				$database = new database;
				$sql = "SELECT * FROM posts where post_status = 'Declined' ORDER by post_id DESC LIMIT 0,5";
				$posts = $database->view($sql);
				while($data= $posts->fetch_object()){

				//(Start) This code for showing post author name and position
					$user_id =$data->user_id;
					$sql_users = "SELECT * FROM users Where user_id = $user_id";
					$users = $database->view($sql_users);
					$data_users = $users->fetch_object();
					$user_up_id = $data_users->up_id;
					$name = $data_users->name;

					$sql_up = "SELECT * FROM user_positions Where up_id = $user_up_id";
					$up = $database->view($sql_up);
					$data_up = $up->fetch_object();
					$position = $data_up->up_name;
				//(End) This code for showing post author name and position

					echo "<tr>";
					echo "<td colspan='3'>
					<a href='backend/validation.php?post_id=$data->post_id&post_status=Under_Review' class='btn btn-success mr-1'>Under Review</a>
					<a href='backend/validation.php?post_id=$data->post_id&post_status=Delete' class='btn btn-danger'>Delete</a>
					</td>";
					echo "</tr>";

					echo "<tr>";
					echo "<td><img src='user_img/$data->image' width='100px' alt=''></td>";
					echo "<td>";
					echo "<h5><a href='view_post.php?post_id=$data->post_id'>".$data->title."</a></h5>";
					echo "<P class='post-author'>$name</p><p class='post-time'><b>Posted at:</b> ".$data->created_at." </p><p class='author-group'>[ $position ]</p>";
					echo "<p class='post-description mt-3'>".mb_substr($data->description,0,500)." . . .<a href='view_post.php?post_id=$data->post_id'><b>Read More »</b></a></p>";
					echo "</td>";
					echo "</tr>";;
				}
				echo "</table>
				</div>";

		// For showing User-Delete Post
				echo "<div id='user_deleted_posts' class='container tab-pane fade'><br>
				<table class='table table-striped'>";
				$database = new database;
				$sql = "SELECT * FROM posts where post_status = 'User Deleted'";
				$posts = $database->view($sql);
				while($data= $posts->fetch_object()){

				//(Start) This code for showing post author name and position
					$user_id =$data->user_id;
					$sql_users = "SELECT * FROM users Where user_id = $user_id";
					$users = $database->view($sql_users);
					$data_users = $users->fetch_object();
					$user_up_id = $data_users->up_id;
					$name = $data_users->name;

					$sql_up = "SELECT * FROM user_positions Where up_id = $user_up_id";
					$up = $database->view($sql_up);
					$data_up = $up->fetch_object();
					$position = $data_up->up_name;
				//(End) This code for showing post author name and position

					echo "<tr>";
					echo "<td colspan='3'>
					<a href='backend/validation.php?post_id=$data->post_id&post_status=Under_Review' class='btn btn-success mr-1'>Under Review</a>
					<a href='backend/validation.php?post_id=$data->post_id&post_status=Delete' class='btn btn-danger'>Delete</a>
					</td>";
					echo "</tr>";

					echo "<tr>";
					echo "<td><img src='user_img/$data->image' width='100px' alt=''></td>";
					echo "<td>";
					echo "<h4><a href='view_post.php?post_id=$data->post_id'>".$data->title."</a></h4>";
					echo "<P class='post-author'>$name</p><p class='post-time'><b>Posted at:</b> ".$data->created_at." </p><p class='author-group'>[ $position ]</p>";
					echo "<p class='post-description mt-3'>".mb_substr($data->description,0,500)." . . .<a href='view_post.php?post_id=$data->post_id'><b>Read More »</b></a></p>";
					echo "</td>";
					echo "</tr>";;
				}
				echo "</table>
				</div>";
			}else if(isset($_SESSION['up_id']) && $_SESSION['up_id'] != 2){
				echo "<div id='approved_posts' class='container tab-pane active'><br>
				<table class='table table-striped'>";
				$database = new database;
				$sql = "SELECT * FROM posts where post_status = 'Approved' ORDER by post_id DESC LIMIT 0,5";
				$posts = $database->view($sql);
				while($data= $posts->fetch_object()){

				//(Start) This code for showing post author name and position
					$user_id =$data->user_id;
					$sql_users = "SELECT * FROM users Where user_id = $user_id";
					$users = $database->view($sql_users);
					$data_users = $users->fetch_object();
					$user_up_id = $data_users->up_id;
					$name = $data_users->name;

					$sql_up = "SELECT * FROM user_positions Where up_id = $user_up_id";
					$up = $database->view($sql_up);
					$data_up = $up->fetch_object();
					$position = $data_up->up_name;
				//(Start) This code for showing post author name and position

					echo "<tr>";
					echo "<td><img src='user_img/$data->image' width='100px' alt=''></td>";
					echo "<td>";
					echo "<h5><a href='view_post.php?post_id=$data->post_id'>".$data->title."</a></h5>";
					echo "<P class='post-author'>$name</p><p class='post-time'><b>Posted at:</b> ".$data->created_at." </p><p class='author-group'> [ $position ] </p>";
					echo "<p class='post-description mt-3'>".mb_substr($data->description,0,500)." . . .<a href='view_post.php?post_id=$data->post_id'><b>Read More »</b></a></p>";
					echo "</td>";
					echo "</tr>";
				}
				echo "</table>
				</div>";
			}
			?>
		</div>



	</div>
	<?php

	include 'backend/footer.php';

	?>