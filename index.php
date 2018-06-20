<?php

require_once "./resources/init.php";

$quote = new Quote();

// if no id passed in URL
if (empty($_GET['id'])) {
	$results = $quote->fetch();
// if URL has id
} else {
	$results = $quote->fetch($_GET['id']);
	if (!$results) {
		Redirect::to('404 Not Found!', 'error');
	}
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<title>Project 1</title>
		<link rel="stylesheet" href="./public/dist/css/style.css?version=<?php echo uniqid(); ?>">
	</head>
	<body>
	<?php require_once 'navigation.php'; ?>
	<?php if (isset($_SESSION['msg'])): ?>
		<?php echo Notification::message('success', $_SESSION['msg']); ?>
		<?php unset($_SESSION['msg']); ?>
	<?php endif ?>
	<div class="container">
		<div class="div_mainbody">
			<div class="div_container_text">
				<div class="div_wait">
					<p>Please wait...</p>
				</div>
				<div class="div_text">
					<p id='ptext'><?php echo htmlspecialchars($results['text']); ?></p>
					<p id='pauthor'><?php echo htmlspecialchars($results['author']); ?></p>
				</div>
			</div>
			<div class="div_button">
				<a class="next">
					next
				</a>
				<a class="sharefb">
					<img src="./public/img/fb.jpg" alt="fb_logo">
				</a>
				<a class="sharetw">
					<img src="./public/img/tw.png" alt="fb_logo">
				</a>
			</div>
		</div>
	</div>
		<script>
			// add id to URL onload
			window.onload = function() {
				var url = window.location.href.indexOf('?') ? window.location.href.substr(0, window.location.href.indexOf('?')) : window.location.href;
				window.history.replaceState('', '', url + "?id=<?php echo $results['id'];?>");
			};
		</script>
		<script src="./public/dist/js/main.js?version=<?php echo uniqid(); ?>"></script>
		<script src="./public/dist/js/notification.js?version=<?php echo uniqid(); ?>"></script>
	</body>
</html>
