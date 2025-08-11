<?php
include 'dbcon.php';
session_start();

if (isset($_POST['submit'])) {
	$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
	$pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);

	$select = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
	$select->execute([$email, $pass]);

	if ($select->rowCount() > 0) {
		$row = $select->fetch(PDO::FETCH_ASSOC);

		if ($row['user_type'] == 'admin') {
			$_SESSION['admin_id'] = $row['id'];
			header('location:admin_page.php');
			exit();
		} elseif ($row['user_type'] == 'user') {
			$_SESSION['user_id'] = $row['id'];
			header('location:home.php');
			exit();
		} else {
			$message[] = 'Unknown user type!';
		}
	} else {
		$message[] = 'Incorrect email or password!';
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
	<link rel="stylesheet" href="css/components.css">
</head>
<body>

<?php
if (isset($message)) {
	foreach ($message as $msg) {
		echo '
		<div class="message">
			<span>' . $msg . '</span>
			<i class="fas fa-times" onclick="this.parentElement.remove();"></i>
		</div>';
	}
}
?>

<section class="form-container">
	<form action="" method="POST" enctype="multipart/form-data">
		<h3>Login</h3>
		<input type="email" name="email" class="box" placeholder="Enter your email" required>
		<input type="password" name="pass" class="box" placeholder="Enter your password" required>

		<input type="submit" value="Login" class="btn" name="submit">
		<p>You do not have an account? <a href="register.php">Register</a></p>
	</form>
</section>

</body>
</html>
