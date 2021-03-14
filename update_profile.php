	<?php

	include 'backend/header.php';

	?>
	<div class="container">
		
		<?php
		if (isset($_SESSION['up_id']) && $_SESSION['up_id'] != 2 && isset($_GET['user_id']) && $_SESSION['id'] != $_GET['user_id']) {
			header('location:profile.php');
		}else if (isset($_GET['user_id']) && $_SESSION['up_id'] == 2) {
			$user_id = $_GET['user_id'];
		}else if (!isset($_GET['user_id'])) {
			$user_id = $_SESSION['id'];
		}

		if (isset($_GET['action']) && $_GET['action'] != 'update_email' && $_GET['action'] != 'update_password' && $_GET['action'] != 'update_profile' && $_SESSION['up_id'] != 2) {
			header('location:profile.php');
		}else if (!isset($_GET['action'])){
			header('location:profile.php');
		}else if (isset($_GET['action']) && $_GET['action'] != 'update_email' && $_GET['action'] != 'update_password' && $_GET['action'] != 'update_profile' && $_SESSION['up_id'] == 2) {
			header('location:users.php');
		}

		$database = new database;
		?>
		<div class='mt-2'>
			<h4>Edit Profile Info</h4>
		</div>
		<div class='row'>
			<div class='col-md-6'>
				<?php

				// For UPDATE EMAIL
				if (isset($_GET['action']) && $_GET['action'] == 'update_email') {
					echo "<form action='' name='myform' method='post' enctype='multipart/form-data' >
					<div id='err'>";
					if (isset($_POST['update_email'])) {
						$email = $_POST['email'];
						if ($email == "") {
							echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>You should input a email address.</div>";
						}else if($email != "" && !filter_var($email, FILTER_VALIDATE_EMAIL)){
							echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>This is not a valid email address.</div>";
						}else if($email != "" && filter_var($email, FILTER_VALIDATE_EMAIL)){
							$is_email = $database->check_email($email);
							if ($is_email) {
								echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>This email address is already exist. Try another one.</div>";
							}else{
								$sql = "UPDATE users SET email = '$email' where user_id = '$user_id'";
								$database->post($sql);
								echo "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>&times;</button>Your email updated successfully.</div>";
							}
						}
					}
					
					


						//For getting valus from database
					$sql_users = "SELECT * FROM users Where user_id = $user_id";
					$users = $database->view($sql_users);
					$data_users = $users->fetch_object();
					$name = $data_users->name;
					$email = $data_users->email;
					$phone = $data_users->phone;
					$address = $data_users->address;
					$about = $data_users->about;
					$image = $data_users->profile_img;

					echo "</div>
					<div class='form-group'>
					<label for='email'>Enter new email address:<b class='reg-mandatory'>*</b></label>
					<input type='text' class='form-control' name='email' id='email' onkeyup='' value='$email'>
					</div>
					<input type='Submit' class='btn btn-success' value='Change Email Address' name='update_email'>
					</form>";

				}


				// For UPDATE PASSWORD (For Admin)
				if (isset($_GET['action']) && $_GET['action'] == 'update_password' && isset($_GET['user_id'])) {
					echo "<form action='' name='myform' method='post' enctype='multipart/form-data' >
					<div class='err'>";

					$sql_users = "SELECT * FROM users Where user_id = $user_id";
					$users = $database->view($sql_users);
					$data_users = $users->fetch_object();
					$name = $data_users->name;
					if (isset($_POST['update_password'])) {
						$new_pass = $_POST['npwd'];
						$confirm_pass = $_POST['cpwd'];
						$md_password = md5($_POST['cpwd']);
						if ($new_pass == "" || $confirm_pass == "") {
							echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>Any password field must not empty.</div>";
						}else if($new_pass != "" && $confirm_pass != ""){
							if ($new_pass == $confirm_pass) {
								$sql = "UPDATE users SET password = '$md_password' where user_id = '$user_id'";
								$database->post($sql);
								echo "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>&times;</button>$name's password updated successfully.</div>";
							}else if($new_pass != $confirm_pass){
								
								echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>New password and confirm password did not match.</div>";
							}
						}
					}

						//For getting valus from database
					$sql_users = "SELECT * FROM users Where user_id = $user_id";
					$users = $database->view($sql_users);
					$data_users = $users->fetch_object();
					$name = $data_users->name;
					$email = $data_users->email;
					$phone = $data_users->phone;
					$address = $data_users->address;
					$about = $data_users->about;
					$image = $data_users->profile_img;
					$password = $data_users->password;

					
					echo "</div>

					<div class='form-group'>
					<label for='npwd'>Enter New Password:<b class='reg-mandatory'>*</b></label>
					<input type='password' class='form-control' name='npwd' id='npwd'>
					</div>";
					echo "					<div class='form-group'>
					<label for='cpwd'>Confirm Password:<b class='reg-mandatory'>*</b></label>
					<input type='password' class='form-control' name='cpwd' id='cpwd'>
					</div>
					<input type='Submit' class='btn btn-success' value='Change Password' name='update_password'>
					</form>";

				}

				// For UPDATE PASSWORD (For user)
				if (isset($_GET['action']) && $_GET['action'] == 'update_password' && !isset($_GET['user_id'])) {
					echo "<form action='' name='myform' method='post' enctype='multipart/form-data' >
					<div class='err'>";
					if (isset($_POST['update_password'])) {
						$old_pass = md5($_POST['opwd']);
						$new_pass = $_POST['npwd'];
						$confirm_pass = $_POST['cpwd'];
						$md_password = md5($_POST['cpwd']);
						if ($old_pass == "" || $new_pass == "" || $confirm_pass == "") {
							echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>Any password field must not empty.</div>";
						}else if($old_pass != "" && $new_pass != "" && $confirm_pass != ""){
							$is_pass = $database->check_password($old_pass,$user_id);
							if ($is_pass && $new_pass == $confirm_pass) {
								$sql = "UPDATE users SET password = '$md_password' where user_id = '$user_id'";
								$database->post($sql);
								echo "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>&times;</button>Your password updated successfully.</div>";
							}else if($new_pass == $confirm_pass){
								
								echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>Your old password did not match.</div>";
							}else if($new_pass != $confirm_pass){
								
								echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>New password and confirm password did not match.</div>";
							}
						}
					}

						//For getting valus from database
					$sql_users = "SELECT * FROM users Where user_id = $user_id";
					$users = $database->view($sql_users);
					$data_users = $users->fetch_object();
					$name = $data_users->name;
					$email = $data_users->email;
					$phone = $data_users->phone;
					$address = $data_users->address;
					$about = $data_users->about;
					$image = $data_users->profile_img;
					$password = $data_users->password;

					echo "</div>
					<div class='form-group'>
					<label for='opwd'>Enter Old Password:<b class='reg-mandatory'>*</b></label>
					<input type='password' class='form-control' name='opwd' id='opwd'>
					</div>";
					echo "
					<div class='form-group'>
					<label for='npwd'>Enter New Password:<b class='reg-mandatory'>*</b></label>
					<input type='password' class='form-control' name='npwd' id='npwd'>
					</div>";
					echo "
					<div class='form-group'>
					<label for='cpwd'>Confirm Password:<b class='reg-mandatory'>*</b></label>
					<input type='password' class='form-control' name='cpwd' id='cpwd'>
					</div>
					<input type='Submit' class='btn btn-success' value='Change Password' name='update_password'>
					</form>";

				}


					//For UPDATE PROFIE INFO
				if (isset($_GET['action']) && $_GET['action'] == 'update_profile') {
					echo "<form action='' name='myform' method='post' enctype='multipart/form-data' >
					<div class='err'>";

					if (isset($_POST['update_profile'])) {
						$update_name = $_POST['name'];
						$update_phone = $_POST['phone'];
						$update_address = $_POST['address'];
						$update_about = $_POST['about'];
						$sql = "UPDATE users SET name = '$update_name', phone = '$update_phone', address = '$update_address', about = '$update_about' where user_id = '$user_id'";
						if ($update_name != "" && $update_phone != "" && $update_address != "" && $update_about != "") {
							$database->post($sql);
							echo "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>&times;</button>You profile updated successfully.</div>";
						}else{
							echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>Any field must not empty.</div>";
						}

					}


						//For getting valus from database
					$sql_users = "SELECT * FROM users Where user_id = $user_id";

					$users = $database->view($sql_users);
					$data_users = $users->fetch_object();

					$name = $data_users->name;
					$email = $data_users->email;
					$phone = $data_users->phone;
					$address = $data_users->address;
					$about = $data_users->about;
					$image = $data_users->profile_img;

					echo "</div>";
					echo "<div class='form-group'>
					<label for='name'>Name:<b class='reg-mandatory'>*</b></label>
					<input type='text' class='form-control' name='name' id='name' value='".$name."'>
					</div>
					<div class='form-group'>
					<label for='phone'>Phone:<b class='reg-mandatory'>*</b></label>
					<input type='text' class='form-control' name='phone' id='phone' value='".$phone."'>
					</div>
					<div class='form-group'>
					<label for='address'>Address:<b class='reg-mandatory'>*</b></label>
					<input type='text' class='form-control' name='address' id='address' value='".$address."'>
					</div>
					<div class='form-group'>
					<label for='about'>About:</label>
					<textarea class='form-control' name='about' id='about' rows='3'>".$about."</textarea>
					</div>
					<input type='Submit' class='btn btn-success' value='Update Profile' name='update_profile'>
					</form>";
				}
				?>
			</div>
			<div class='col-md-6 mt-sm-3 mt-md-1'>
				<div class='card'>
					<div class='card-body'>
						<img src='user_img/<?php echo $image; ?>' alt='' class='mx-auto d-block rounded-circle' width='150px'>
						<h5 class='card-title m-auto pt-3'><?php echo $name; ?></h5>
						<hr>
						<div class='row'>
							<p class='card-text col-md-4 col-lg-3'><b>Email </b></p>
							<p class='card-text col-md-8 col-lg-9'><?php echo $email; ?></p>
							<p class='card-text col-md-4 col-lg-3'><b>Phone </b></p>
							<p class='card-text col-md-8 col-lg-9'><?php echo $phone; ?></p>
							<p class='card-text col-md-4 col-lg-3'><b>Adress </b></p>
							<p class='card-text col-md-8 col-lg-9'><?php echo $address; ?></p>
							<p class='card-text col-md-4 col-lg-3'><b>About </b> </p> 
							<p class='card-text col-md-8 col-lg-9'><?php echo $about; ?></p>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>



	<?php

	include 'backend/footer.php';

	?>