<?php
include 'backend/header.php';

?>
<div class="container">



<?php
function valid($data)
{
	$data = trim($data);
	$data = htmlspecialchars($data);
	$data = stripcslashes($data);
	return $data;
}


//For Getting Valus from database
$post_id = $_GET['post_id'];
$database = new database;
$sql = "SELECT * FROM posts where post_id = $post_id";
$data = $database ->view($sql);
$data2 = $data->fetch_object();
$temp_user_id = $data2->user_id;
$title = $data2->title;
$description = $data2->description;
$image = $data2->image;


//Varifying user
if ($temp_user_id != $_SESSION['id']) {
	header("Location:index.php");
}


//For editing submitation
if (isset($_POST['edit'])) {
	$user_id = $_SESSION['id'];
	$post_id = $_POST['post_id'];
	$title = valid($_POST['title']);
	$description = valid($_POST['description']);
	$image = $_FILES['image']['name'];
	$database = new database;

	if ($title != "" && $description != "" && $image != "") {
		$sql = " UPDATE posts SET title = '$title', description = '$description', image = '$image' where post_id = '$post_id'";
		$database->post($sql);
		$move = "../user_img/$image";
		move_uploaded_file($_FILES['image']['tmp_name'], $move);
		$msg = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>&times;</button>You have successfully edited the post.</div>";

	}else if ($title != "" && $description != "") {
		$sql = " UPDATE posts SET title = '$title', description = '$description' where post_id = '$post_id'";
		$database->post($sql);
		$msg =  "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>&times;</button>You have successfully edited the post.</div>";

	}else{
		$msg = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>'Title' or 'Description' field must not empty.</div>";
	}
}else{
	$msg="";
}


	?>
	<div class="mt-2">
		<h2>Edit Your Post</h2>
	</div>
	<div class="row">
		<div class="col-lg-6 mb-2">
			<form action="" name="myform" method="post" enctype="multipart/form-data" >
				<div id="err"><?php echo $msg; ?></div>
				<input type="hidden" name="post_id" value="<?php echo $post_id ?>">
				<div id="err" class="mt-2"></div>
				<div class="form-group">
					<label for="title">Title:</label>
					<input type="text" class="form-control" onkeyup="titleUpdate()" name="title" id="title" value="<?php echo $title ?>">
				</div>
				<div class="form-group">
					<label for="description">Description:</label>
					<textarea class="form-control" onkeyup="descriptionUpdate()" name="description" rows="7" id="description"><?php echo $description ?></textarea>
				</div>
				<div class="form-group">
					<label for="image">Image:</label>
					<input type="file" class="form-control-file border" accept="image/*" name="image" id="image" onchange="loadImage(event)">
					<input type="hidden" id="isImage" value="">
				</div>
				<input type="Submit" class="btn btn-success" value="Edit Post" name="edit">


			</form>

		</div>

		<div class="col-lg-6">
			<h5 class="mt-2">Preview Editing Post</h5>
			<div class="overflow-scroll">
				<table class="table table-striped">
				<tr>
					<td colspan="2">
						<h4 id='updateTitle'><?php echo $title ?></h4>
					</td>
				</tr>
				<tr></tr>
				<tr>
					<td>
						<img  id="preview" src='user_img/<?php  if(isset($_POST['edit']) && $image != ""){
							echo $image;
							 }else{
							 	echo "$data2->image";
							 }
							?>' width="200px">
					</td>
					<td>
						<p class='post-description mt-4' id='updateDescription'><?php echo $description ?></p>
					</td>
				</tr>
			</table>
			</div>
			
		</div>
	</div>

</div>



<?php

include 'backend/footer.php';

?>