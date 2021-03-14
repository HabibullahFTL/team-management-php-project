<?php

include 'backend/header.php';
if (isset($_GET['user_id'])) {
	$user_id = $_GET['user_id'];
}else{
	$user_id = $_SESSION['id'];
}

//Getting post id from url
if (isset($_GET['post_id']) && $_GET['post_id'] != "") {
	$post_id = $_GET['post_id'];
}else if (!isset($_GET['post_id'])) {
	header("location:posts.php");
}



//(Start) Who seeing the post[Getting info]
$database = new database;
$sql_users = "SELECT * FROM users Where user_id = $user_id";

$users = $database->view($sql_users);
$data_users = $users->fetch_object();

$name = $data_users->name;
$image = $data_users->profile_img;
$up_id = $data_users->up_id;
$team = $data_users->user_team;
$about = $data_users->about;

$sql_up = "SELECT * FROM user_positions Where up_id = $up_id";
$up = $database->view($sql_up);
$data_up = $up->fetch_object();

$position = $data_up->up_name;
//(End) Who seeing the post[Getting info]




//(Start) Post Details
$sql_posts = "SELECT * FROM posts Where post_id = $post_id";
$up = $database->view($sql_posts);
$data_posts = $up->fetch_object();
if (isset($data_posts)) {
	$post_user_id = $data_posts->user_id;
	$image = $data_posts->image;
	$title = $data_posts->title;
	$description = $data_posts->description;
	$post_status = $data_posts->post_status;
	$created_at = $data_posts->created_at;

}else{
    header('location:posts.php');
}





//(end) Post Details




//For general user, can't view if the post is not approved 
if ($_SESSION['up_id'] == 2 && isset($_GET['post_id']) && $_GET['post_id'] != "") {
	$post_id = $_GET['post_id'];
}else if (isset($_GET['post_id']) && $_GET['post_id'] != "" && $post_status == "Approved" && $_SESSION['id'] != $post_user_id) {
	$post_id = $_GET['post_id'];
}else if(isset($_GET['post_id']) && $_GET['post_id'] != "" && $post_status != "User Deleted" && $_SESSION['id'] == $post_user_id){
	$post_id = $_GET['post_id'];
}else{
	header("location:posts.php");
}



?>
<div class="container">
	<div class="card mt-2">
		
		<?php
		if ($_SESSION['up_id'] == 2) {
			if ($post_status == "Approved") {
				echo "<div class='p-2 border'>
				<div class='float-left'>
				<a href='backend/validation.php?post_id=$post_id&post_status=Under_Review' class='btn btn-primary mr-1'>Under Review</a>
				<a href='backend/validation.php?post_id=$post_id&post_status=Declined' class='btn btn-danger'>Decline</a>
				</div>";
				echo "<div class='float-right badge badge-pill badge-success p-2 mt-2'>".$post_status." Post</div>
				</div>";
			}else if ($post_status == "Pending") {
				echo "<div class='p-2 border'>
				<div class='float-left'>
				<a href='backend/validation.php?post_id=$post_id&post_status=Approved' class='btn btn-success mr-1'>Approve</a>
				<a href='backend/validation.php?post_id=$post_id&post_status=Declined' class='btn btn-danger'>Decline</a>
				</div>";
				echo "<div class='float-right badge badge-pill badge-warning p-2 mt-2'>".$post_status." Post</div>
				</div>";
			}else if ($post_status == "Declined") {
				echo "<div class='p-2 border'>
				<div class='float-left'>
				<a href='backend/validation.php?post_id=$post_id&post_status=Approved' class='btn btn-success mr-1'>Approve</a>
				<a href='backend/validation.php?post_id=$post_id&post_status=Delete' class='btn btn-danger'>Delete</a>
				</div>";
				echo "<div class='float-right badge badge-pill badge-danger p-2 mt-2'>".$post_status." Post</div>
				</div>";
			}else if ($post_status == "User Deleted") {
				echo "<div class='p-2 border'>
				<div class='float-left'>
				<a href='backend/validation.php?post_id=$post_id&post_status=Under_Review' class='btn btn-primary mr-1'>Under Review</a>
				<a href='backend/validation.php?post_id=$post_id&post_status=Delete' class='btn btn-danger'>Delete</a>
				</div>";
				echo "<div class='float-right badge badge-pill badge-danger p-2 mt-2'>".$post_status." Post</div>
				</div>";
			}
		}else if ($_SESSION['id'] == $post_user_id) {
			echo "<div class='p-2 border'>
			<div class='float-left'>
			<a href='edit_post.php?post_id=$post_id' class='btn btn-primary mr-2'>Edit Post</a>
			<a href='backend/validation.php?post_id=$post_id&post_status=User_Delete' class='btn btn-danger'>Delete Post</a>
			</div>";
			if ($post_status == "Approved") {
				echo "<div class='float-right badge badge-pill badge-success p-2 mt-2'>".$post_status." Post</div>
				</div>";
			}else if ($post_status == "Pending") {
				echo "<div class='float-right badge badge-pill badge-warning p-2 mt-2'>".$post_status." Post</div>
				</div>";
			}			
			
		}

		?>
		
		<div class="card-header">
			<h4 class="post-title">
				<?php echo $title; ?>
			</h4>
		</div>
		<div class="card-body">
			<div class="post-details mb-2">
				<p class="card-text">
					<b><?php echo "<a href='profile.php?user_id=$post_user_id' style='font-size:1.005em;'>".userIdToName($post_user_id)."</a>";?></b>
					<small class="author-group">[ <?php echo userIdToUp($post_user_id);?> ]</small><br>
					<span class="single-post-time">
						<b> <?php echo date("M d, Y",strtotime($created_at))." at ".date("g:i A",strtotime($created_at)); ?></b>
					</span>
				</p>				
			</div>
			<div class="post-img mb-2 mr-3">
				<img src="user_img/<?php echo $image; ?>" class="d-block img-fluid" alt="">
			</div>
			<p class="text-justify" style="line-height:1.6em">
				<?php echo $description; ?>
			</p>
			<div class="comment_area mt-4">
				<h5>Comments</h5>
				<?php

					if(isset($_POST['comment']) && $_POST['comment_text'] != ""){
						$comment_text = $_POST['comment_text'];
						$comment_user_id = $_SESSION['id'];

						$sql_insert_comment = "INSERT INTO `comments` (`comment_id`, `comment_text`, `post_id`, `comment_user_id`) VALUES (NULL, '$comment_text', '$post_id', '$user_id')";
						$insert_comment = $database->post($sql_insert_comment);
					}
				?>
				<hr>
				<form action="" method="post">
					<table class="mb-2">
						<tr>
							<td>
								<textarea name="comment_text" id="" cols="25" rows="2" class="p-1"></textarea>
							</td>
							<td>
								<input type="submit" name="comment" value="Comment" class="btn btn-primary ml-1">
							</td>
						</tr>
					</table>
				</form>

				<?php
				$comment_sql = "SELECT * From comments Where post_id = '$post_id' order by comment_id DESC";
				$comment = $database->view($comment_sql);

				while ($comment_data = $comment->fetch_object()) {
					echo "<div class='single_comment row mb-2'>";
					echo "<div class='comment_img ml-2' style=''>";
					echo "<img src='user_img/".userIdToProfileImg($comment_data->comment_user_id)."' alt='' width='40px' class='rounded-circle mr-1'>";
					echo "</div>";

					echo "<div class='comment col-9 col-md-10 col-lg-11'>";
					echo "<div class='comment_name_text'>";
					echo "<a href='profile.php?user_id=".$comment_data->comment_user_id."' class='mr-2'><b>".userIdToName($comment_data->comment_user_id)."</b></a>";
					echo "<span>".$comment_data->comment_text."</span>";
					echo "</div>";
					echo "<div class='comment_time ml-3'>".date("M d, Y",strtotime($comment_data->commented_at))." at ".date("g:i A",strtotime($comment_data->commented_at))."</div></div>";
					echo "</div>";
				}
				?>
						
						
					
				</div>
			</div>
			
		</div>
	</div>
</div>
<?php

include 'backend/footer.php';

?>