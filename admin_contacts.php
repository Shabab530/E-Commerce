<?php
include "dbcon.php";
session_start();

$admin_id = $_SESSION["admin_id"] ?? null;

if (!$admin_id) {
    header("location:login.php");
    exit();
}

// Delete message
if (isset($_GET["delete"])) {
    $delete_id = $_GET["delete"];
    $delete_message = $conn->prepare("DELETE FROM `message` WHERE id = ?");
    $delete_message->execute([$delete_id]);
    header("location:admin_contacts.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Messages</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
	<link rel="stylesheet" href="css/admin_style.css">
</head>
<body>

<?php include "admin_header.php"; ?>

<section class="messages">
	<h1 class="title">User Messages</h1>
	<div class="box-container">
		<?php
  $select_message = $conn->prepare("SELECT * FROM `message` ORDER BY id DESC");
  $select_message->execute();

  if ($select_message->rowCount() > 0) {
      while ($fetch_message = $select_message->fetch(PDO::FETCH_ASSOC)){ 
      	?>
		<div class="box">
			<p>User ID: <span><?= htmlspecialchars($fetch_message["user_id"]) ?></span></p>
			<p>Name: <span><?= htmlspecialchars($fetch_message["name"]) ?></span></p>
			<p>Number: <span><?= htmlspecialchars($fetch_message["number"]) ?></span></p>
			<p>Email: <span><?= htmlspecialchars($fetch_message["email"]) ?></span></p>
			<p>Message: <span><?= htmlspecialchars($fetch_message["message"]) ?></span></p>
			<a href="admin_contacts.php?delete=<?= $fetch_message["id"] ?>" onclick="return confirm('Delete this message?');" class="delete-btn">Delete</a>
		</div>

		<?php 
				}
		  } else {
		      echo '<p class="empty">You have no messages!</p>';
		  }
  	?>
	</div>

</section>
<script src="js/script.js"></script>

</body>
</html>
