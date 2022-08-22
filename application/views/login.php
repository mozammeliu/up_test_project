<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Title</title>
</head>
<body>
<h2>User Login Form</h2>
<br/>

<?php
if((isset($error))&&($error==true)){
	echo "<p style='color: red; font-size: 22px;'>".$error_reason."</p>";
}

?>


<form action="<?=site_url('user/login')?>" method="post" name="login">
	<label>Email:</label>
	<input type="email" name="email" placeholder="Enter Your Email" size="50"; required>
	<br/><br/>
	<label>New Password:</label>
	<input type="password" minlength="8" name="password" placeholder="Enter New Password" size="30" required>
	<br/><br/>
	<input type="submit" name="save" value="Login">
	<br/>
</form>

</body>
</html>
