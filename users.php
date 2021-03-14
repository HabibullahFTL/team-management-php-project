


<?php

include 'backend/header.php';

?>
<div class="container">
	<div class="mt-2">
		<h2>User List</h2>
	</div>
	<ul class='nav nav-tabs' role='tablist'>
		<?php 
		if (isset($_SESSION['up_id']) && $_SESSION['up_id'] == 2) {
			echo "<li class='nav-item'>
			<a class='nav-link active' data-toggle='tab' href='#all_team_members' style='text-decoration: none;color: #333!important;'><h6>All Team Members</h6></a>
		</li>
		<li class='nav-item'>
			<a class='nav-link' data-toggle='tab' href='#new_member' style='text-decoration: none;color: #333!important;'><h6>New Member</h6></a>
		</li>
		<li class='nav-item'>
			<a class='nav-link' data-toggle='tab' href='#user_promotion' style='text-decoration: none;color: #333!important;'><h6>User Promotion</h6></a>
		</li>
		<li class='nav-item'>
			<a class='nav-link' data-toggle='tab' href='#pending_users' style='text-decoration: none;color: #333!important;'><h6>Pending Users</h6></a>
		</li>
		<li class='nav-item'>
			<a class='nav-link' data-toggle='tab' href='#blocked_users' style='text-decoration: none;color: #333!important;'><h6>Blocked Users</h6></a>
		</li>";
		}else{
			echo "<li class='nav-item'>
			<a class='nav-link active' data-toggle='tab' href='#all_team_members' style='text-decoration: none;color: #333!important;'><h6>All Team Members</h6></a>
		</li>
		";
		}
		?>
		
	</ul>
	<div class='tab-content'>
		<?php
		if (isset($_SESSION['up_id']) && $_SESSION['up_id'] == 2) {
			echo "<div id='all_team_members' class='container-fluid tab-pane active'><br>
			<table class='table table-striped table-bordered'>
				<tr>
					<th>Profile Photo</th>
					<th>Name</th>
					<th>Email</th>
					<th>Phone</th>
					<th>Address</th>
					<th>Position</th>
					<th class='tw200'>Action</th>
				</tr>";

				$sql_dm = "SELECT * FROM users WHERE user_team ='Digital Marketing Team' and up_id != '100' and up_id != '101' and up_id != '102' ORDER BY up_id";
				$sql_cm = "SELECT * FROM users WHERE user_team ='Content Management Team' and up_id != '100' and up_id != '101' and up_id != '102' ORDER BY up_id";
				$sql_tt = "SELECT * FROM users WHERE user_team ='Tech Team' and up_id != '100' and up_id != '101' and up_id != '102' ORDER BY up_id";
				$database = new database;
				$users_dm = $database->view($sql_dm);
				$users_cm = $database->view($sql_cm);
				$users_tt = $database->view($sql_tt);

				//For Digital Maketing Team
				echo "<tr><td colspan='7'><h6 class='m-auto'>Digital Maketing Team</h6></td></tr>";
				while ($data_dm = $users_dm->fetch_object()) {

					$sql_up = "SELECT * FROM user_positions Where up_id = $data_dm->up_id";
					$up = $database->view($sql_up);
					$data_up = $up->fetch_object();
					$position = $data_up->up_name;

					echo "<tr>";
					echo "<td><img src='user_img/$data_dm->profile_img' width='100px'/> </td>";
					echo "<td>$data_dm->name </td>";
					echo "<td>$data_dm->email </td>";
					echo "<td>$data_dm->phone </td>";
					echo "<td>$data_dm->address </td>";
					echo "<td>$position </td>";
					echo "<td><a class='btn btn-primary mr-2' href='profile.php?user_id=$data_dm->user_id'>Profile</a> <a class='btn btn-danger' href='backend/validation.php?user_id=$data_dm->user_id&up_id=102'>Block</a></td>";
					echo "</tr>";
				}

				//For Content Management Team
				echo "<tr><td colspan='7'><h6 class='m-auto'>Content Mangement Team</h6></td></tr>";
				while ($data_cm = $users_cm->fetch_object()) {

					$sql_up = "SELECT * FROM user_positions Where up_id = $data_cm->up_id";
					$up = $database->view($sql_up);
					$data_up = $up->fetch_object();
					$position = $data_up->up_name;

					echo "<tr>";
					echo "<td><img src='user_img/$data_cm->profile_img' width='100px'/> </td>";
					echo "<td>$data_cm->name </td>";
					echo "<td>$data_cm->email </td>";
					echo "<td>$data_cm->phone </td>";
					echo "<td>$data_cm->address </td>";
					echo "<td>$position </td>";
					echo "<td><a class='btn btn-primary mr-2' href='profile.php?user_id=$data_cm->user_id'>Profile</a><a class='btn btn-danger' href='backend/validation.php?user_id=$data_cm->user_id&up_id=102'>Block</a> </td>";
					echo "</tr>";
				}

				//For Content Tech Team
				echo "<tr><td colspan='7'><h6 class='m-auto'>Tech Team</h6></td></tr>";
				while ($data_tt = $users_tt->fetch_object()) {

					$sql_up = "SELECT * FROM user_positions Where up_id = $data_tt->up_id";
					$up = $database->view($sql_up);
					$data_up = $up->fetch_object();
					$position = $data_up->up_name;

					echo "<tr>";
					echo "<td><img src='user_img/$data_tt->profile_img' width='100px'/> </td>";
					echo "<td>$data_tt->name </td>";
					echo "<td>$data_tt->email </td>";
					echo "<td>$data_tt->phone </td>";
					echo "<td>$data_tt->address </td>";
					echo "<td>$position </td>";
					echo "<td><a class='btn btn-primary mr-2' href='profile.php?user_id=$data_tt->user_id'>Profile</a><a class='btn btn-danger' href='backend/validation.php?user_id=$data_tt->user_id&up_id=102'>Block</a> </td>";
					echo "</tr>";
					
				}
				echo "			</table>
		</div>";

		//For New Member
				echo "<div id='new_member' class='container tab-pane fade'><br>
			<table class='table table-striped table-bordered '>
				<tr>
					<th>Profile Photo</th>
					<th>Name</th>
					<th>Email</th>
					<th>Phone</th>
					<th>Address</th>
					<th>Type of user</th>
					<th class='tw200'>Action</th>
				</tr>";
				$sql = "SELECT * FROM users WHERE up_id = '101'";
				$database = new database;
				$users = $database->view($sql);
				while ($data = $users->fetch_object()) {

					$sql_up = "SELECT * FROM user_positions Where up_id = $data->up_id";
					$up = $database->view($sql_up);
					$data_up = $up->fetch_object();
					$position = $data_up->up_name;

					echo "<tr>";
					echo "<td><img src='user_img/$data->profile_img' width='100px'/> </td>";
					echo "<td>$data->name </td>";
					echo "<td>$data->email </td>";
					echo "<td>$data->phone </td>";
					echo "<td>$data->address </td>";
					echo "<td>$position </td>";
					echo "<td><form action='backend/validation.php' method='post'>
			<div class='form-group'>
				<select class='form-control' name='up_id'>
					<option value='4'>Ambassdor</option>
					<option value='3'>Contributor</option>
					<option value='2'>Team Leader</option>
				</select>
			</div>
			<div class='form-group'>
				<select class='form-control' name='user_team'>
					<option value='DM'>Digital Marketing Team</option>
					<option value='CM'>Content Mangement Team</option>
					<option value='Tech'>Tech Team</option>
				</select>
			</div>
			<input type='hidden' name='user_id' value='$data->user_id'>
			<input type='submit' class='btn btn-success mr-2' name='user_promotion' value='Recruit'><a class='btn btn-danger' href='backend/validation.php?user_id=$data->user_id&up_id=102'>Block</a>
		</form> </td>";
					echo "</tr>";
				}
				echo "</table>
				</div>";

				//For Promotion Users

				echo "<div id='user_promotion' class='container tab-pane fade'><br>
			<table class='table table-striped table-bordered ' id='myTable'>
				<tr>
					<th>Profile Photo</th>
					<th>Name</th>
					<th>Email</th>
					<th>Phone</th>
					<th>Team</th>
					<th>Type of user</th>
					<th class='tw200'>Action</th>
				</tr>";

			$sql = "SELECT * FROM users WHERE user_team != '' and up_id != '100' and up_id != '101' and up_id != '102' order by up_id asc";
				$database = new database;
				$users = $database->view($sql);
				while ($data = $users->fetch_object()) {

					$sql_up = "SELECT * FROM user_positions Where up_id = $data->up_id";
					$up = $database->view($sql_up);
					$data_up = $up->fetch_object();
					$position = $data_up->up_name;

					echo "<tr>";
					echo "<td><img src='user_img/$data->profile_img' width='100px'/> </td>";
					echo "<td>$data->name </td>";
					echo "<td>$data->email </td>";
					echo "<td>$data->phone </td>";
					echo "<td>$data->user_team </td>";
					echo "<td>$position </td>";
					echo "<td><form action='backend/validation.php' method='post'>
			<div class='form-group'>
				<select class='form-control' name='up_id'>
					<option value='4'>Ambassdor</option>
					<option value='3'>Contributor</option>
					<option value='2'>Team Leader</option>
				</select>
			</div>
			<div class='form-group'>
				<select class='form-control' name='user_team'>
					<option value='DM'>Digital Marketing Team</option>
					<option value='CM'>Content Mangement Team</option>
					<option value='Tech'>Tech Team</option>
				</select>
			</div>
			<input type='hidden' name='user_id' value='$data->user_id'>
			<input type='submit' class='btn btn-success mr-2' name='user_promotion' value='Recruit'><a class='btn btn-danger' href='backend/validation.php?user_id=$data->user_id&up_id=102'>Block</a>
		</form> </td>";
					echo "</tr>";
				}
					echo "			</table>
			
		</div>";


				//For Pending Users
				echo "<div id='pending_users' class='container tab-pane fade'><br>
			<table class='table table-striped table-bordered  table-responsive'>
				<tr>
					<th>Profile Photo</th>
					<th>Name</th>
					<th>Email</th>
					<th>Phone</th>
					<th>Address</th>
					<th>Type of user</th>
					<th class='tw200'>Action</th>
				</tr>";
				$sql = "SELECT * FROM users WHERE up_id = '100'";
				$database = new database;
				$users = $database->view($sql);
				while ($data = $users->fetch_object()) {
					
					$sql_up = "SELECT * FROM user_positions Where up_id = $data->up_id";
					$up = $database->view($sql_up);
					$data_up = $up->fetch_object();
					$position = $data_up->up_name;

					echo "<tr>";
					echo "<td><img src='user_img/$data->profile_img' width='100px'/> </td>";
					echo "<td>$data->name </td>";
					echo "<td>$data->email </td>";
					echo "<td>$data->phone </td>";
					echo "<td>$data->address </td>";
					echo "<td>$position </td>";
					echo "<td><a class='btn btn-success mr-2' href='backend/validation.php?user_id=$data->user_id&up_id=101'>Approve</a><a class='btn btn-danger' href='backend/validation.php?user_id=$data->user_id&up_id=102'>Block</a> </td>";
					echo "</tr>";
				}

				echo "			</table>
			
		</div>";


		//For Blocked Users
		echo "<div id='blocked_users' class='container tab-pane fade'><br>
			<table class='table table-striped table-bordered '>
				<tr>
					<th>Profile Photo</th>
					<th>Name</th>
					<th>Email</th>
					<th>Phone</th>
					<th>Address</th>
					<th>Type of user</th>
					<th class='tw200'>Action</th>
				</tr>";
				$sql = "SELECT * FROM users WHERE up_id = '102'";
				$database = new database;
				$users = $database->view($sql);
				while ($data = $users->fetch_object()) {
					
					$sql_up = "SELECT * FROM user_positions Where up_id = $data->up_id";
					$up = $database->view($sql_up);
					$data_up = $up->fetch_object();
					$position = $data_up->up_name;

					echo "<tr>";
					echo "<td><img src='user_img/$data->profile_img' width='100px'/> </td>";
					echo "<td>$data->name </td>";
					echo "<td>$data->email </td>";
					echo "<td>$data->phone </td>";
					echo "<td>$data->address </td>";
					echo "<td>$position </td>";
					echo "<td><a class='btn btn-success mr-2' href='backend/validation.php?user_id=$data->user_id&up_id=101'>Approve</a><a class='btn btn-danger' href='backend/validation.php?user_id=$data->user_id&up_id=Delete_User'>Delete</a> </td>";
					echo "</tr>";
				}

				echo "			</table>
			
		</div>";




		}else{
			echo "<div id='all_team_members' class='container-fluid tab-pane active'><br>
			<table class='table table-striped table-bordered'>
				<tr>
					<th>Profile Photo</th>
					<th>Name</th>
					<th>Email</th>
					<th>Address</th>
					<th>Position</th>
					<th class='tw200'>Action</th>
				</tr>";

				$sql_dm = "SELECT * FROM users WHERE user_team ='Digital Marketing Team' and up_id != '100' and up_id != '101' and up_id != '102' ORDER BY up_id";
				$sql_cm = "SELECT * FROM users WHERE user_team ='Content Management Team' and up_id != '100' and up_id != '101' and up_id != '102' ORDER BY up_id";
				$sql_tt = "SELECT * FROM users WHERE user_team ='Tech Team' and up_id != '100' and up_id != '101' and up_id != '102' ORDER BY up_id";
				$database = new database;
				$users_dm = $database->view($sql_dm);
				$users_cm = $database->view($sql_cm);
				$users_tt = $database->view($sql_tt);

				//For Digital Maketing Team
				echo "<tr><td colspan='7'><h6 class='m-auto'>Digital Maketing Team</h6></td></tr>";
				while ($data_dm = $users_dm->fetch_object()) {

					$sql_up = "SELECT * FROM user_positions Where up_id = $data_dm->up_id";
					$up = $database->view($sql_up);
					$data_up = $up->fetch_object();
					$position = $data_up->up_name;

					echo "<tr>";
					echo "<td><img src='user_img/$data_dm->profile_img' width='100px'/> </td>";
					echo "<td>$data_dm->name </td>";
					echo "<td>$data_dm->email </td>";
					echo "<td>$data_dm->address </td>";
					echo "<td>$position </td>";
					echo "<td><a class='btn btn-primary mr-2' href='profile.php?user_id=$data_dm->user_id'>Profile</a></td>";
					echo "</tr>";
				}

				//For Content Management Team
				echo "<tr><td colspan='7'><h6 class='m-auto'>Content Mangement Team</h6></td></tr>";
				while ($data_cm = $users_cm->fetch_object()) {

					$sql_up = "SELECT * FROM user_positions Where up_id = $data_cm->up_id";
					$up = $database->view($sql_up);
					$data_up = $up->fetch_object();
					$position = $data_up->up_name;

					echo "<tr>";
					echo "<td><img src='user_img/$data_cm->profile_img' width='100px'/> </td>";
					echo "<td>$data_cm->name </td>";
					echo "<td>$data_cm->email </td>";
					echo "<td>$data_cm->address </td>";
					echo "<td>$position </td>";
					echo "<td><a class='btn btn-primary mr-2' href='profile.php?user_id=$data_cm->user_id'>Profile</a></td>";
					echo "</tr>";
				}

				//For Content Tech Team
				echo "<tr><td colspan='7'><h6 class='m-auto'>Tech Team</h6></td></tr>";
				while ($data_tt = $users_tt->fetch_object()) {

					$sql_up = "SELECT * FROM user_positions Where up_id = $data_tt->up_id";
					$up = $database->view($sql_up);
					$data_up = $up->fetch_object();
					$position = $data_up->up_name;

					echo "<tr>";
					echo "<td><img src='user_img/$data_tt->profile_img' width='100px'/> </td>";
					echo "<td>$data_tt->name </td>";
					echo "<td>$data_tt->email </td>";
					echo "<td>$data_tt->address </td>";
					echo "<td>$position </td>";
					echo "<td><a class='btn btn-primary mr-2' href='profile.php?user_id=$data_tt->user_id'>Profile</a></td>";
					echo "</tr>";
					
				}
				echo "			</table>
		</div>";

		}
		?>

	</div>

	
</div>


<?php

include 'backend/footer.php';

?>
