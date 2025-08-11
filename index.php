<?php

include 'dbcon.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
	header('location:login.php');
};

if (isset($_POST['add_to_wishlist'])) {
	$pid = $_POST['pid'];
	$pid = filter_var($pid, FILTER_SANITIZE_STRING);
	$p_name = $_POST['p_name'];
	$p_name = filter_var($p_name, FILTER_SANITIZE_STRING);
	$p_price = $_POST['p_price'];
	$p_price = filter_var($p_price, FILTER_SANITIZE_STRING);
	$p_image = $_POST['p_image'];
	$p_image = filter_var($p_image, FILTER_SANITIZE_STRING);

	$check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
	$check_wishlist_numbers->execute([$p_name, $user_id]);
	$check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
	$check_cart_numbers->execute([$p_name, $user_id]);

	if ($check_wishlist_numbers->rowCount() > 0) {
		$message[] = 'already added to wishlist!';
	}elseif($check_cart_numbers->rowCount() > 0){
		$message[] = 'already added to cart!';
	}else{
		$insert_wishlist = $conn->prepare("INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES (?,?,?,?,?)");
		$insert_wishlist->execute([$user_id, $pid, $p_name, $p_price, $p_image]);
		$message[] = 'added to wishlist!';
	}
}

if (isset($_POST['add_to_cart'])) {
	$pid = $_POST['pid'];
	$pid = filter_var($pid, FILTER_SANITIZE_STRING);
	$p_name = $_POST['p_name'];
	$p_name = filter_var($p_name, FILTER_SANITIZE_STRING);
	$p_price = $_POST['p_price'];
	$p_price = filter_var($p_price, FILTER_SANITIZE_STRING);
	$p_image = $_POST['p_image'];
	$p_image = filter_var($p_image, FILTER_SANITIZE_STRING);
	$p_qty = $_POST['p_qty'];
	$p_qty = filter_var($p_qty, FILTER_SANITIZE_STRING);

	$check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
	$check_cart_numbers->execute([$p_name, $user_id]);

	if ($check_cart_numbers->rowCount() > 0) {
		$message[] = 'already added to cart!';
	}else{
		$check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
		$check_wishlist_numbers->execute([$p_name, $user_id]);

		if ($check_wishlist_numbers->rowCount() > 0) {
			$delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE name = ? AND user_id = ?");
			$delete_wishlist->execute([$p_name, $user_id]);
		}

		$insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES (?,?,?,?,?,?)");
		$insert_cart->execute([$user_id, $pid, $p_name, $p_price, $p_qty, $p_image]);
		$message[] = 'added to cart!';
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>home page</title>

	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="css/components.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>

<?php include 'header.php'; ?>

<div class="home-bg">
	<section class="home">
		<div class="content">
			<span>"Welcome to MAS || Mobile Accessories"</span>
			<h3>Your Desire Destination for Stylish and Phone Accessories!</h3>
			<p>At MAS Mobile Accessories, we're passionate about enhancing your smartphone experience. Our mission is to provide you with a curated selection of top-quality phone accessories that not only protect and complement your device but also reflect your unique style.</p>
			<a href="about.php"class="btn">about us</a>
		</div>
	</section>
</div>
<section class="home-category">
	<h1 class="title">shop by category</h1>
	<div class="box-container">
		<div class="box">
			<img src="images/tws.jpeg" alt="">
			<h3>True Wireless Stereo (TWS) uses Bluetooth signals instead of wires to transfer sound.</h3>
			<a href="category.php?category=tws" class="btn">TWS</a>
		</div>
		<div class="box">
			<img src="images/bluetooth speaker.jpeg" alt="">
			<h3>based on brand, features, and sound quality.</h3>
			<a href="category.php?category=bluetooth speaker" class="btn">bluetooth speaker</a>
		</div>
		<div class="box">
			<img src="images/power bank.webp" alt="">
			<h3>True Wireless Stereo (TWS) uses Bluetooth signals instead of wires to transfer sound.</h3>
			<a href="category.php?category=Power Bank" class="btn">Power bank</a>
		</div>
		<div class="box">
			<img src="images/adapter.jpeg" alt="">
			<h3>True Wireless Stereo (TWS) uses Bluetooth signals instead of wires to transfer sound.</h3>
			<a href="category.php?category=Adapter" class="btn">Adapter</a>
		</div>
		<div class="box">
			<img src="images/cable.jpg" alt="">
			<h3>True Wireless Stereo (TWS) uses Bluetooth signals instead of wires to transfer sound.</h3>
			<a href="category.php?category=Cable" class="btn">Cable</a>
		</div>
	</div>
</section>
<section class="products">
	<h1 class="title">latest products</h1>
	<div class="box-container">
		<?php
			$select_products=$conn->prepare("SELECT * FROM `products` LIMIT 6");
			$select_products->execute();
			if ($select_products->rowCount() > 0) {
				while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
		?>
		<form action="" class="box" method="POST">
			<div class="price">$<span><?= $fetch_products['price']; ?></span>/-</div>
			<a href="view_page.php?pid=<?=$fetch_products['id'];?>" class="fas fa-eye"></a>
			<img src="uploaded_img/<?= $fetch_products['image'];?>" alt="">
			<div class="name"><?= $fetch_products['name']; ?></div>
			<input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
			<input type="hidden" name="p_name" value="<?= $fetch_products['name']; ?>">
			<input type="hidden" name="p_price" value="<?= $fetch_products['price']; ?>">
			<input type="hidden" name="p_image" value="<?= $fetch_products['image']; ?>">
			<input type="number" min="0" value="" name="p_qty" class="qty">
			<input type="submit" value="add to wishlist" class="option-btn" name="add_to_wishlist">
			<input type="submit" value="add to cart" class="btn" name="add_to_cart">
		</form>
		<?php
			}
		}else{
			echo '<p class="empty">no products added yet!</p>';
		}
		?>
	</div>
</section>
<?php include 'footer.php'; ?>
<script src="js/script.js"></script>
</body>
</html>
