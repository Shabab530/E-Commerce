<?php

include "dbcon.php";

session_start();

$user_id = $_SESSION["user_id"];

if (!isset($user_id)) {
    header("location:login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>about</title>

	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<?php include "header.php"; ?>

<section class="about">
	<div class="row">
		<div class="box">
			<img src="images/about-img-1.jpg" alt="">
			<p>"Welcome to MAS || Mobile  Accessories"- Your Desire Destination for Stylish and Functional Phone Accessories! 📱✨
			MAS Mobile Accessories, we're passionate about enhancing your smartphone experience. Our mission is to provide you with a curated selection of top-quality phone accessories that not only protect and complement your device but also reflect your unique style.
			<h3>Why choose us?</h3>
			<p>🔥 Trendy and Innovative: Stay ahead of the tech game with the latest and greatest phone accessories, from trendy cases and screen protectors to wireless chargers and more.</p>
			<p>🌟 Quality Assurance:
			We believe in quality over everything. Every product in our inventory undergoes rigorous testing to ensure it meets the highest standards of durability and performance.</p>
			<p>💼 Style & Functionality:
			Whether you're a fashion enthusiast or a tech-savvy professional, our range of accessories caters to every taste and need. From sleek and minimalistic designs to rugged and protective gear, we've got you covered.</p>
			<p>🚢 Shipping:
			No matter where you are, we'll deliver your favorite accessories right to your doorstep. We offer fast and reliable shipping options to make your shopping experience hassle-free.</p>
			<p>👍 Customer Satisfaction:
			Your satisfaction is our priority. Our dedicated customer support team is here to assist you with any questions or concerns you may have.
			Join the MAS || Mobile Accessories family today and elevate your smartphone game! Explore our catalog, discover exciting deals, and get ready to accessorize your phone like never before.</p>
			<p>Follow us on social media MAS Mobile Accessories  for the latest updates, exclusive offers, and tech inspiration. Thank you for choosing MAS || Mobile Accessories for all your phone accessory needs! 🙌🛒</p>
			<a href="contact.php" class="btn">contact us</a>
			<a href="shop.php" class="btn">our shop</a>
		</div>
	</div>
</section>
<section class="reviews">
	<h1 class="title">clients reviews</h1>
	<div class="box-container">
		<div class="box">
			<img src="images/pic-1.png" alt="">
			<p>In a world where smartphones are extensions of ourselves, finding the right accessories is crucial for both protection and personalization. MAS Mobile Accessories steps into this space with a clear and compelling mission: "to enhance your smartphone experience" by providing "a curated selection of top-quality phone accessories that not only protect and complement your device but also reflect your unique style."</p>
			<div class="stars">
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
				<i class="fas fa-star-half-alt"></i>
			</div>
		<h3>kim hung</h3>
		</div>
		<div class="box">
			<img src="images/pic-2.png" alt="">
			<p>What immediately stands out about MAS Mobile Accessories is their genuine passion. It’s not just about selling products; it's about enriching how you interact with your device. This holistic approach ensures that every item in their collection is chosen with the end-user experience in mind. They understand that an accessory isn’t just a add-on, but a vital component that can improve functionality, usability, and even your mood.</p>
			<div class="stars">
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
			</div>
		<h3>Jecyka</h3>
		</div>
		<div class="box">
			<img src="images/pic-3.png" alt="">
			<p>In an oversaturated market, the phrase "curated selection" is music to a consumer's ears. MAS avoids the pitfalls of overwhelming choice by meticulously selecting their inventory. This commitment to "top-quality" means you can trust that their accessories are built to last and perform effectively. From durable cases that genuinely protect against drops and scratches, to high-performance chargers that optimize power delivery.</p>
			<div class="stars">
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
			</div>
		<h3>Mahim</h3>
		</div>
	</div>
</section>

<?php include "footer.php"; ?>
<script src="js/script.js"></script>

</body>
</html>