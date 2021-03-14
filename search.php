<?php
include 'backend/header.php';

$database = new database;

if (isset($_POST['search'])) {
	$search_input = $_POST['search_input'];
}

?>




<div class="container">
	<div class="article_wrap mt-2 mb-2">
		<?php 
		if (isset($_POST['search'])) {
			echo "<h4>Showing results of '$search_input'</h4>"; 
		}
		$is_check_search = $database->check_search($search_input);
		if ($is_check_search) {
			echo "<p>No data found</p>"; 
		}
		?>

		<?php
		$sql = "SELECT * FROM posts where post_status = 'Approved' and title LIKE '%$search_input%' or description LIKE '%$search_input%'";
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
			$title = $data->title;
			$description = $data->description;
			$at = "at";
			
			echo "<table class='table'>";
			echo "<tr>";
			echo "<td><img src='user_img/$data->image' width='100px' alt=''></td>";
			echo "<td>";
			echo "<h5><a href='view_post.php?post_id=$data->post_id'>".str_replace($search_input,"<span style='background:yellow'>".$search_input."</span>", $title)."</a></h5>";
			echo "<P class='post-author float-left'>$name</p><p class='d-block float-left author-group'> [ $position ] </p><p class='post-time d-block'>".date("M d, Y",strtotime($data->created_at))." at ".date("g:i A",strtotime($data->created_at))." </p>";
			echo "<p class='post-description mt-3'>".mb_substr(str_replace($search_input,"<span style='background:yellow'>".$search_input."</span>",$description),0,300)." . . .<a href='view_post.php?post_id=$data->post_id'><b>Read More »</b></a></p>";
			echo "</td>";
			echo "</tr>";
			echo "</table>";

		}
		?>

	</div>
	
</div>



<?php

include 'backend/footer.php';

?>