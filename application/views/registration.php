<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Title</title>
</head>
<body>
<h2>User Registration Form</h2>
<br/>

<?php
if((isset($error))&&($error==true)){
	echo "<p style='color: red; font-size: 22px;'>".$error_reason."</p>";
}

?>


<form action="<?=site_url('user/registration')?>" method="post" name="registration">
	<label>Email:</label>
	<input type="email" name="email" placeholder="Enter Your Email" size="50"; required>
	<br/><br/>
	<label>New Password:</label>
	<input type="password" minlength="8" name="password" placeholder="Enter New Password" size="30" required>
	<br/><br/>
	<label>Confirm Password:</label>
	<input type="password" minlength="8" name="password_confirm" placeholder="Enter Password Again" size="30" required>
	<br/><br/>
	<input type="submit" name="save" value="Register Now">
	<br/>
</form>

<br/>
<br/>
<br/>
<a href="<?=site_url('user/login')?>">Login Form</a>

</body>
</html>
