<?php
include 'backend/header.php';

$year = $_GET['year'];

?>


<div class="container">
	<div class="row">
		<div class="col-md-9 col-12 pl-0">
			<div class="article_wrap mt-2 mb-2">
				<h4>Archived Posts of <?php echo $year; ?></h4>
				<table class='table'>
					<?php
					$database = new database;
					$sql = "SELECT * FROM posts where post_status = 'Approved' and Year(created_at) = $year ORDER by post_id DESC LIMIT 0,5";
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
						$at = "at";
						echo "<tr>";
						echo "<td><img src='user_img/$data->image' width='100px' alt=''></td>";
						echo "<td>";
						echo "<h5><a href='view_post.php?post_id=$data->post_id'>".$data->title."</a></h5>";
						echo "<P class='post-author float-left'>$name</p><p class='d-block float-left author-group'> [ $position ] </p><p class='post-time d-block'>".date("M d, Y",strtotime($data->created_at))." at ".date("g:i A",strtotime($data->created_at))." </p>";
						echo "<p class='post-description mt-3'>".mb_substr($data->description,0,300)." . . .<a href='view_post.php?post_id=$data->post_id'><b>Read More »</b></a></p>";
						echo "</td>";
						echo "</tr>";

					}
					?>
				</table>
			</div>
		</div>
		<div class="col-md-3 col-12 p-0">
			<div class="sidebar_right mt-2 mb-2">
				<h5>Archived Posts</h5>
				
				<?php 
				$database = new database;
				$arc_sql = "SELECT created_at FROM posts";
				$arc_list = $database->view($arc_sql);
				$arc_year = []; 
				while($data_list= $arc_list->fetch_object()){
					$arc_year[] = date("Y",strtotime($data_list->created_at));
				}
				$arc_unique_year = array_unique($arc_year);

				for ($i=0; $i <= count($arc_year); $i++) { 
					if (isset($arc_unique_year[$i]) && $arc_unique_year[$i] != "") {
						echo "<div class='sidebar_link'>";
						echo "<a href='archived_posts.php?year=".$arc_unique_year[$i]."'>".$arc_unique_year[$i]."</a>";
						echo "</div>";
						
					}
				}
				
				
				

				?>
			</div>
		</div>
	</div>


</div>



<?php

include 'backend/footer.php';

?>