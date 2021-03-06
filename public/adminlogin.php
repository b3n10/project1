<?php

require_once "../resources/init.php";

if (Session::check('id')) {
	Redirect::to('', 'adminpage');
	die();
}

if (isset($_POST['submit'])) {

	$login = new Login();

	$loginStatus = $login->user([
		'usertype'	=>	$_POST['usertype'],
		'password'	=>	$_POST['password']
	]);

	if ($loginStatus['id']) {
		$_SESSION['id'] = $loginStatus['id'];
		Session::create();
		Redirect::to('', 'adminpage');
		die();
	}

	$fail_msg = 'Log in attempt failure!';

}

$page_title = 'Login';
require_once 'navigation.php';
?>
	<?php if (isset($fail_msg)): ?>
		<?php echo Notification::message('fail', $fail_msg); ?>
	<?php endif ?>
	<div class="container">
		<div class="div_mainbody">
			<div class="div_login">
				<form action="" method="POST">
					<div>
						<label for="usertype">Log in as: </label>
						<select name="usertype">
							<option value="Guest">Guest</option>
							<option value="Admin">Admin</option>
						</select>
					</div>
					<div>
						<label for="password">Password:</label>
						<input id="password" type="password" name="password">
					</div>
					<div>
						<button type="submit" name="submit">Log in</button>
					</div>
				</form>
			</div>
		</div>
	</div>
		<script src="./dist/js/notification.js?version=<?php echo uniqid(); ?>"></script>
	</body>
</html>
