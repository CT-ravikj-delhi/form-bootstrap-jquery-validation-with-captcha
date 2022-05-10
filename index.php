<?php

// Make the page validate
ini_set('session.use_trans_sid', '0');

// Include the random string file
require 'rand.php';

// Begin the session
session_start();

// Set the session contents
$_SESSION['captcha_id'] = $str;

?>
<!DOCTYPE html>
<html>
<head>
<title>Bootstrap Form</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-8 offset-sm-2">
				<div class="border-bottom mb-4 mt-4 pb-2">
					<div class="alert alert-info" role="alert">
						<h6>This demo shows how to integrate JQuery-validation and the Bootstrap 4 framework.</h4>
					</div>
				</div>

				<div class="card">
					<div class="card-header">
						<h6 class="card-text">Simple Form</h3>
					</div>
					<div class="card-body">
						<form id="signupForm" method="post" class="form-horizontal" action="">
							<div class="form-group row">
								<label class="col-sm-4 col-form-label" for="firstname">First name</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="firstname" name="firstname" placeholder="First name" />
								</div>
							</div>

							<div class="form-group row">
								<label class="col-sm-4 col-form-label" for="lastname">Last name</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last name" />
								</div>
							</div>

							<div class="form-group row">
								<label class="col-sm-4 col-form-label" for="username">Username</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="username" name="username" placeholder="Username" />
								</div>
							</div>

							<div class="form-group row">
								<label class="col-sm-4 col-form-label" for="email">Email</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="email" name="email" placeholder="Email" />
								</div>
							</div>

							<div class="form-group row">
								<label class="col-sm-4 col-form-label" for="password">Password</label>
								<div class="col-sm-6">
									<input type="password" class="form-control" id="password" name="password" placeholder="Password" />
								</div>
							</div>

							<div class="form-group row">
								<label class="col-sm-4 col-form-label" for="confirm_password">Confirm Password</label>
								<div class="col-sm-6">
									<input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm password" />
								</div>
							</div>


							<div class="form-group row">
							<label class="col-sm-6 col-form-label" for="password">Select Single</label>
								<div class="col-sm-6 offset-sm-4">
								<div class="group">
									<div class="form-radio">
										<input type="radio" class="form-check-label" name="radio" id="radio1" required>
										<label class="form-check-label" for="radio1">One</label>
									</div>
									<div class="form-radio">
										<input type="radio" class="form-check-label" name="radio" id="radio2" required>
										<label class="form-check-label" for="radio2">One</label>
									</div>
									<div class="form-radio">
										<input type="radio" class="form-check-label" name="radio" id="radio3" required>
										<label class="form-check-label" for="radio3">One</label>
									</div>
								</div>
								</div>
							</div>
							
							<div class="form-group row">
							<label class="col-sm-6 col-form-label" for="password">Select Multiple</label>
								<div class="col-sm-6 offset-sm-4">
								<div class="group">
									<div class="form-check">
										<input type="checkbox" name="checkbox" id="colors1" value="colors1" class="form-check-input"/>
										<label class="form-check-label" for="colors1">Red</label>
									</div>
									<div class="form-check">
										<input type="checkbox" name="checkbox" id="colors2" value="colors2" class="form-check-input"/>
										<label class="form-check-label" for="colors2">Green</label>
									</div>
									<div class="form-check">
										<input type="checkbox" name="checkbox" id="colors3" value="colors3" class="form-check-input"/>
										<label class="form-check-label" for="colors3">Blue</label>
									</div>
								</div>
								</div>
							</div>
							
							<div class="form-group row">
								<div class="col-sm-9 offset-sm-4">
									<div id="captchaimage"><a href="<?php echo htmlEntities($_SERVER['PHP_SELF'], ENT_QUOTES); ?>" id="refreshimg" title="Click to refresh image"><img src="images/image.php?<?php echo time(); ?>" width="132" height="46" alt="Captcha image"></a></div>
		<label for="captcha">Enter the characters as seen on the image above (case insensitive):</label>
		<input type="text" maxlength="6" name="captcha" id="captcha" class="form-control" style="width:200px">
								</div>
							</div>
							
							<div class="form-group row">
								<div class="col-sm-9 offset-sm-4">
									<button type="submit" class="btn btn-primary" name="signup" value="Sign up">Sign up</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
<script type="text/javascript" src="js/jquery-1.11.1.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
	<script type="text/javascript">
	$("body").on("click", "#refreshimg", function(){
		$.post("newsession.php");
		$("#captchaimage").load("image_req.php");
		return false;
	});
	
		$.validator.setDefaults( {
			submitHandler: function () {
				alert( "Submitted!" );
				$('#signupForm').trigger("reset");
			}
		} );

		$( document ).ready( function () {
			$( "#signupForm" ).validate( {
				onkeyup: false,
				rules: {
					firstname: "required",
					lastname: "required",
					username: {
						required: true,
						minlength: 2
					},
					password: {
						required: true,
						minlength: 5
					},
					confirm_password: {
						required: true,
						minlength: 5,
						equalTo: "#password"
					},
					email: {
						required: true,
						email: true
					},
					radio: "required",
					checkbox: {
						required: true,
						minlength: 2
					},
					captcha: {
						required: true,
						remote: "process.php"
					}
				},
				messages: {
					password: {
						required: "Please provide a password",
						minlength: "Your password must be at least 5 characters long"
					},
					confirm_password: {
						required: "Please provide a password",
						minlength: "Your password must be at least 5 characters long",
						equalTo: "Please enter the same password as above"
					},
					captcha: "Correct captcha is required. Click the captcha to generate a new one"
				},
				errorElement: "em",
				errorPlacement: function ( error, element ) {
				error.addClass( "invalid-feedback" );
					//console.log(element.prop( "type" ));
					if ( element.prop( "type" ) === "radio" || element.prop( "type" ) === "checkbox") {
					error.insertAfter(element.closest("div.group"));
					} else {
					error.insertAfter( element );
					}
				},
				highlight: function ( element, errorClass, validClass ) {
					//$( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
				},
				unhighlight: function (element, errorClass, validClass) {
					//$( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
				}
			} );

		} );
	</script>
</body>
</html>
