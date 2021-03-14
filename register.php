<?php

include 'backend/header_wo_lr.php';

?>
<div class="mt-2">
	<h2 style="width: 578px; display: block;margin:auto;">User Registration</h2>
</div>
<form form action="" name="myform" method="post" enctype="multipart/form-data" style="width: 578px; display: block;margin:auto;">
	<div id="err" class="mt-2">
		<?php
		function valid($data)
		{
			$data = trim($data);
			$data = htmlspecialchars($data);
			$data = stripcslashes($data);
			return $data;
		}
		if (isset($_POST['register'])) {
			$name = valid($_POST['name']);
			$email = valid($_POST['email']);
			$phone = valid($_POST['phone']);
			$address = valid($_POST['address']);
			$about = valid($_POST['about']);
			$image = $_FILES['profile_img']['name'];
			$password = md5($_POST['pwd']);

			$database = new database;

			if ($email == "") {
				echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>You should input a email address.</div>";
			}else if($email != "" && !filter_var($email, FILTER_VALIDATE_EMAIL)){
				echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>This is not a valid email address.</div>";
			}else if($email != "" && filter_var($email, FILTER_VALIDATE_EMAIL)){
				$is_email = $database->check_email($email);
				if ($is_email) {
					echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>This email address is already exist. Try another one.</div>";
					echo $image;
				}else{
					$sql_reg = "INSERT INTO users(name,email,phone,address,about,profile_img,up_id,password) VALUES('$name','$email','$phone','$address','$about','$image','100','$password')";
					$database->post($sql_reg);
					$move = "user_img/$image";
					move_uploaded_file($_FILES['profile_img']['tmp_name'], $move);
					echo "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>$name! </strong>You have successfully registered.</div>";
				}
			}
		}


		?>

	</div>
	<div class="form-group">
		<label for="name">Name:<b class="reg-mandatory">*</b></label>
		<input type="text" class="form-control" name="name" id="name" value="<?php 
		if (isset($_POST['register'])) {
			$name = $_POST['name'];
			echo $name;
		}
		?>">
	</div>
	<div class="form-group">
		<label for="email">Email:<b class="reg-mandatory">*</b></label>
		<input type="text" class="form-control" name="email" id="email" onchange="emailValid()" value="<?php 
		if (isset($_POST['register'])) {
			$email = $_POST['email'];
			echo $email;
		}
		?>">
	</div>
	<div class="form-group">
		<label for="phone">Phone:<b class="reg-mandatory">*</b></label>
		<input type="text" class="form-control" name="phone" id="phone" value="<?php 
		if (isset($_POST['register'])) {
			$phone = $_POST['phone'];
			echo $phone;
		}
		?>">
	</div>
	<div class="form-group">
		<label for="address">Address:<b class="reg-mandatory">*</b></label>
		<input type="text" class="form-control" name="address" id="address" value="<?php 
		if (isset($_POST['register'])) {
			$address = $_POST['address'];
			echo $address;
		}
		?>">
	</div>
	<div class="form-group">
		<label for="about">About yourself:</label>
		<textarea class="form-control" name="about" id="about" rows="3"><?php 
		if (isset($_POST['register'])) {
			$about = $_POST['about'];
			echo $about;
		}
		?></textarea>
	</div>
	<div class="form-group">
		<label for="pwd">Password:<b class="reg-mandatory">*</b></label>
		<input type="password" class="form-control" name="pwd" id="pwd">
	</div>
	<div class="form-group">
		<label for="image">Profile Picture:<b class="reg-mandatory">*</b></label>
		<input type="file" class="form-control-file border" accept="image/*" name="profile_img" id="profile_img" onchange="profileImg(event)">
		<input type="hidden" id="profile_img_value" value="">
	</div>
	<div class="form-check mb-2">
		<label for="chk" class="form-check-label">
			<input type="checkbox" id="chk"> I agree.
		</label>
	</div>

	<div style="display: none;">
		<div class="form-group">
			<label for="title">Title:</label>
			<input type="text" class="form-control" name="tite" id="title">
		</div>
		<div class="form-group">
			<label for="description">Description:</label>
			<textarea class="form-control" name="descrition" rows="7" id="description"></textarea>
		</div>
		<div class="form-group">
			<label for="image">Image:</label>
			<input type="file" class="form-control-file border" accept="image/*" id="image">
			<input type="hidden" id="isImage" value="">
		</div>
	</div>

	<input type="Submit" class="btn btn-success" value="Register" name="register">
	<a href="login.php" class="btn btn-primary ml-3">Login</a>
</form>



<?php

include 'backend/footer.php';

?>
<!--
<div class="form-group">
			<label for="uname">Name:</label>
			<input type="text" class="form-control" name="title" id="title">
		</div>
		<div class="form-group">
			<label for="email">Email:</label>
			<input type="text" class="form-control" name="email" id="email" onkeyup="emailValid()">
		</div>
		<div class="form-group">
			<label for="phone">Phone:</label>
			<input type="text" class="form-control" name="phone" id="phone">
		</div>
		<div class="form-group">
			<label for="address">Address:</label>
			<input type="text" class="form-control" name="address" id="address">
		</div>
		<div class="form-group">
			<label for="pwd">Password:</label>
			<input type="password" class="form-control" name="pwd" id="pwd">
		</div>
		<div class="form-check mb-2">
			<label for="chk" class="form-check-label">
				<input type="checkbox" id="chk"> I agree.
			</label>
		</div>
		<input type="Submit" class="btn btn-success" value="Login" name="login">
	</form>-->