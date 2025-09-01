<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="about">

   <div class="row">

      <div class="image">
         <img src="images/about-img.svg" alt="">
      </div>

      <div class="content">
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
      </div>

   </div>

</section>

<section class="reviews">
   
   <h1 class="heading">client's reviews</h1>

   <div class="swiper reviews-slider">

   <div class="swiper-wrapper">

      <div class="swiper-slide slide">
         <img src="images/pic-1.png" alt="">
         <p>In a world where smartphones are extensions of ourselves, finding the right accessories is crucial for both protection and personalization. MAS Mobile Accessories steps into this space with a clear and compelling mission: "to enhance your smartphone experience" by providing "a curated selection of top-quality phone accessories that not only protect and complement your device but also reflect your unique style."</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
         <h3>Mehedi Akram Shabab</h3>
      </div>

      <div class="swiper-slide slide">
         <img src="images/pic-2.png" alt="">
         <p>What immediately stands out about MAS Mobile Accessories is their genuine passion. It’s not just about selling products; it's about enriching how you interact with your device. This holistic approach ensures that every item in their collection is chosen with the end-user experience in mind. They understand that an accessory isn’t just a add-on, but a vital component that can improve functionality.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Jemima Rahman Mim</h3>
      </div>

      <div class="swiper-slide slide">
         <img src="images/pic-3.png" alt="">
         <p>In an oversaturated market, the phrase "curated selection" is music to a consumer's ears. MAS avoids the pitfalls of overwhelming choice by meticulously selecting their inventory. This commitment to "top-quality" means you can trust that their accessories are built to last and perform effectively. From durable cases that genuinely protect against drops and scratches, to high-performance chargers.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Kim Hung</h3>
      </div>

      <div class="swiper-slide slide">
         <img src="images/pic-4.png" alt="">
         <p>In a market often saturated with generic options, the promise to help customers "reflect your unique style" is a significant draw. This suggests that MAS understands that a smartphone is not just a tool but an extension of one's personality. We can anticipate finding a diverse range of designs, colors, and materials that allow users to truly personalize their devices, moving beyond mere functionality to genuine aesthetic appeal.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Jecyka</h3>
      </div>

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>

<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".reviews-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
        slidesPerView:1,
      },
      768: {
        slidesPerView: 2,
      },
      991: {
        slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>
