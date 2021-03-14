//Email Validation in js
function emailValid(){
	var email = document.getElementById('email');
	var err = document.getElementById('err');	
	var emailRegEx = /([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})/;
	
	if(/\s/.test(email.value)){
		err.innerHTML = "<div class='alert alert-danger mt-2'><button type='button' class='close' data-dismiss='alert'>&times;</button>Don't use white space.</div>";
	}else if(email.value == ""){
		err.innerHTML = "<div class='alert alert-danger mt-2'><button type='button' class='close' data-dismiss='alert'>&times;</button>Email address should not be empty.</div>";
	}else if (!emailRegEx.test(email.value)){
		err.innerHTML = "<div class='alert alert-danger mt-2'><button type='button' class='close' data-dismiss='alert'>&times;</button>This is not a email address. Please, enter a valid email address.</div>";
	}else{
		err.innerHTML = "";
	}
};

//For registration form edit && Post Validation
function posts(){
	//For register
	var name = document.getElementById('name').value;
	var email = document.getElementById('email');
	var err = document.getElementById('err');	
	var emailRegEx = /([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})/;
	var phone = document.getElementById('phone').value;
	var address = document.getElementById('address').value;
	var pwd = document.getElementById('pwd').value;
	var chk = document.getElementById('chk').checked;
	var profile_img = document.getElementById('profile_img_value').value;


	//For post
	var titles = document.myform.title.value;
	var description = document.myform.description.value;
	
	var image = document.getElementById('isImage').value;
	var err = document.getElementById('err');

	//For Registration indivisul field validation 
	if (name == "") {
		err.innerHTML = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>Please, Your full name.</div>";
		return false;
	}
	if(/\s/.test(email.value)){
		err.innerHTML = "<div class='alert alert-danger mt-2'><button type='button' class='close' data-dismiss='alert'>&times;</button>Don't use white space in email address.</div>";
		return false;
	}else if(email.value == ""){
		err.innerHTML = "<div class='alert alert-danger mt-2'><button type='button' class='close' data-dismiss='alert'>&times;</button>Email address should not be empty.</div>";
		return false;
	}else if (!emailRegEx.test(email.value)){
		err.innerHTML = "<div class='alert alert-danger mt-2'><button type='button' class='close' data-dismiss='alert'>&times;</button>This is not a email address. Please, enter a valid email address.</div>";
		return false;
	}else{
		err.innerHTML = "";
	}
	if (phone == "" || !/[0-9]/.test(phone)) {
		err.innerHTML = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>Please, enter your valid phone number.</div>";
		return false;
	}
	if (address == "") {
		err.innerHTML = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>Please, enter your address.</div>";
		return false;
	}
	if (pwd == "") {
		err.innerHTML = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>Please, enter a password for your account.</div>";
		return false;
	}
	if (profile_img == "") {
		err.innerHTML = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>You must select an image.</div>";
		
		return false;
	}
	if (chk == "") {
		err.innerHTML = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>You must agree with our term and condition.</div>";
		return false;
	}

	//For Registration
	if (name == "" && email == "" && phone == "" && address == "" && pwd == "" && chk =="") {
		err.innerHTML = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>Please, Filled up all the fields.</div>";
		return false;
	}
};
profile_img
//For pushing image value in input type hidden
function profileImg(event) {
	document.getElementById('profile_img_value').value = URL.createObjectURL(event.target.files[0]);
};
//For pushing image value in input type hidden
function loadFile(event) {
	document.getElementById('isImage').value = URL.createObjectURL(event.target.files[0]);
};
//For preview image in editing page
function loadImage(event) {
	document.getElementById('preview').src = URL.createObjectURL(event.target.files[0]);
};


//For onkeyup change in preview in post edit page
function titleUpdate(){
	var title = document.getElementById('title').value;
	document.getElementById('updateTitle').innerHTML = title;
}

//For onkeyup change in preview in post edit page
function descriptionUpdate(){
	var description = document.getElementById('description').value;
	document.getElementById('updateDescription').innerHTML = description;
}