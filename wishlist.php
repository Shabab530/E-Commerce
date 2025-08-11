<?php

include "dbcon.php";

session_start();

$user_id = $_SESSION["user_id"];

if (!isset($user_id)) {
    header("location:login.php");
}

if (isset($_POST["add_to_cart"])) {
    $pid = filter_var($_POST["pid"] ?? "", FILTER_SANITIZE_STRING);
    $p_name = filter_var($_POST["p_name"] ?? "", FILTER_SANITIZE_STRING);
    $p_price = filter_var($_POST["p_price"] ?? 0, FILTER_SANITIZE_STRING);
    $p_image = filter_var($_POST["p_image"] ?? "", FILTER_SANITIZE_STRING);
    $p_qty = filter_var($_POST["p_qty"] ?? 1, FILTER_SANITIZE_STRING);

    if ($pid && $p_name && $p_price && $p_image) {
        $check_cart_numbers = $conn->prepare(
            "SELECT * FROM `cart` WHERE name = ? AND user_id = ?"
        );
        $check_cart_numbers->execute([$p_name, $user_id]);

        if ($check_cart_numbers->rowCount() > 0) {
            $message[] = "already added to cart!";
        } else {
            $check_wishlist_numbers = $conn->prepare(
                "SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?"
            );
            $check_wishlist_numbers->execute([$p_name, $user_id]);

            if ($check_wishlist_numbers->rowCount() > 0) {
                $delete_wishlist = $conn->prepare(
                    "DELETE FROM `wishlist` WHERE name = ? AND user_id = ?"
                );
                $delete_wishlist->execute([$p_name, $user_id]);
            }

            $insert_cart = $conn->prepare(
                "INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)"
            );
            $insert_cart->execute([$user_id,$pid, $p_name, $p_price, $p_qty, $p_image,]);
        }
    } else {
        $message[] = "already added to cart!";
    }
}

if (isset($_GET["delete"])) {
    $delete_id = $_GET["delete"];
    $delete_wishlist_item = $conn->prepare(
        "DELETE FROM `wishlist` WHERE id = ?"
    );
    $delete_wishlist_item->execute([$delete_id]);
    header("location:wishlist.php");
}

if (isset($_GET["delete_all"])) {
    $delete_wishlist_item = $conn->prepare(
        "DELETE FROM `wishlist` WHERE user_id = ?"
    );
    $delete_wishlist_item->execute([$user_id]);
    header("location:wishlist.php");
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>wishlist</title>

	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/components.css">
</head>
<body>

<?php include "header.php"; ?>

<section class="wishlist">
	<h1 class="title">products added</h1>
	<div class="box-container">
		<?php
          $grand_total = 0;
          $select_wishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
          $select_wishlist->execute([$user_id]);
          if ($select_wishlist->rowCount() > 0) {
              while ($fetch_wishlist = $select_wishlist->fetch(PDO::FETCH_ASSOC)) { 
        ?>
		<form action="" method="POST" class="box">
			<a href="wishlist.php?delete=<?= $fetch_wishlist["id"] ?>" class="fas fa-times" onclick="return confirm('delete this from wishlist');"></a>
			<a href="view_page.php?pid=<?= $fetch_wishlist["pid"] ?>" class="fas fa-eye"></a>
			<img src="uploaded_img/<?= $fetch_wishlist["image"] ?>" alt="">
			<div class="name"><?= $fetch_wishlist["name"] ?></div>
			<div class="price">$<?= $fetch_wishlist["price"] ?>/-</div>
			<input type="number" min="1" value="1" class="qty" name="p_qty">
			<input type="hidden" name="pid" value="<?= $fetch_wishlist["id"] ?>">
			<input type="hidden" name="p_name" value="<?= $fetch_wishlist["name"] ?>">
			<input type="hidden" name="p_price" value="<?= $fetch_wishlist["price"] ?>">
			<input type="hidden" name="p_image" value="<?= $fetch_wishlist["image"] ?>">
			<input type="submit" value="add to cart" name="add_to_cart" class="btn">
		</form>
		<?php $grand_total = $fetch_wishlist["price"];}
  } else {
      echo '<p class = "empty"> your wishlist is empty</p>';
  }
  ?>
	</div>
	<div class="wishlist-total">
		<p>grand total: <span>$<?= $grand_total ?>/-</span></p>
		<a href="shop.php" class="option-btn">continue shopping</a>
		<a href="wishlist.php?delete_all" class="delete-btn <?= $grand_total > 1 ?>'':'disable'; ?>">delete all</a>
	</div>
</section>

<?php include "footer.php"; ?>
<script src="js/script.js"></script>

</body>
</html>