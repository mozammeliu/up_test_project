<!DOCTYPE html>
<html>
<head>
	<title>Home Page</title>
</head>
<body style="text-align: center;">

<h2>Your are logged in as <?=$this->session->userdata('email')?></h2>
<br/><br/>
<?php

if((isset($_GET['email']))&&(isset($_GET['email'])=="verified"))
{
	?>

	<p style="color: #009900; font-size: 22px;">
		Your Email is now verified <br/> Thank you.</p>
	<?php
}


if($user_data->verification_status=="unverified"){
	?>

	<p style="color: red; font-size: 22px;">
		Your Email is not verified, Please check your email inbox, <br/>
		You will see an email from us containing verification link,<br/>
	Please click on that verification link to verify your email,<br/>
	And then you will be able to use our portal.</p>
	<?php
}

?>
<br/>
<br/>
<br/>
<br/>
<a href="<?=site_url('user/logout')?>">Logout Now</a>

<p><?php
/*	var_dump($user_data);
	*/?></p>

</body>
</html>
