<?php
   include_once 'header.php';
?>

<section class="main-container">
	<div class ="main-wrapper">
		<h2>SignUp</h2>
		<form class ="signup-form" action="includes/signup.inc.php" method="POST">
			<input type="text" name="uid" placeholder="UserName">
			<input type="text" name="email" placeholder="E-Mail">
			<input type="password" name="pwd" placeholder="Password">
			<input type="password" name="pwd_2" placeholder="Confirm Password">
			<input type="text" name="country" placeholder="Country">
            <button type="submit" name="submit">Sign Up</button>
		</form>
	</div>
</section>

<?php
   include_once 'footer.php';
?>