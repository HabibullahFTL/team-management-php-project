<?php
include 'backend/header.php';

?>
<div class="container">
	<div class="mt-2">
		<h2 style="width: 578px; display: block;margin:auto;">Create Post</h2>
	</div>

	<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" name="myform" method="post" enctype="multipart/form-data" onsubmit="return posts()" style="width: 578px; display: block;margin:auto;">
		<div id="err" class="mt-2">	

	<?php

function valid($data)
{
	$data = trim($data);
	$data = htmlspecialchars($data);
	$data = stripcslashes($data);
	return $data;
}

if (isset($_POST['post'])) {
	$user_id = $_SESSION['id'];
	$title = valid($_POST['title']);
	$description = valid($_POST['description']);
	$image = rand(0,9999449).$_FILES['image']['name'];
	$database = new database;
	$sql = "INSERT INTO posts(user_id,title,description,image,post_status) VALUES('$user_id','$title','$description','$image','Pending')";

	if ($title != "" && $description != "" && $image != "") {
	$database->post($sql);
	$move = "user_img/$image";
	move_uploaded_file($_FILES['image']['tmp_name'], $move);
	echo "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>&times;</button>Your post successfully submitted.</div>";
	}else if($title == "" && $description == "" && $image == ""){
		echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>'Title', 'Image' and 'Description' field must not empty.</div>";
	}else if($title == "" || $description == ""){
		echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>'Title' or 'Description' field must not empty.</div>";
	}else if($image == ""){
		echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>You must select an image.</div>";
	}
	
}

?>
	
	</div>
		<div class="form-group">
			<label for="title">Title:</label>
			<input type="text" class="form-control" name="title" id="title" value="<?php if(isset($_POST['post'])){
				if($title == "" || $description == "" || $image == ""){
					echo"$title";
				}
			} ?>">
		</div>
		<div class="form-group">
			<label for="description">Description:</label>
			<textarea class="form-control" name="description" rows="7" id="description"><?php if(isset($_POST['post'])){
				if($title == "" || $description == "" || $image == ""){
					echo"$description";
				}
			} ?></textarea>
		</div>
		<div class="form-group">
			<label for="image">Image:</label>
			<input type="file" class="form-control-file border" accept="image/*" name="image" id="image" onchange="loadFile(event)">
			<input type="hidden" id="isImage" value="">
		</div>
		<input type="Submit" class="btn btn-success" value="Post" name="post">
	</form>
</div>



<?php

include 'backend/footer.php';

?>