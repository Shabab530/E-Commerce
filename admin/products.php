<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['add_product'])){

   $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
   $price = filter_var($_POST['price'], FILTER_SANITIZE_STRING);
   $details = filter_var($_POST['details'], FILTER_SANITIZE_STRING);

   $image_01 = filter_var($_FILES['image_01']['name'], FILTER_SANITIZE_STRING);
   $image_size_01 = $_FILES['image_01']['size'];
   $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
   $image_folder_01 = '../uploaded_img/'.$image_01;

   $image_02 = filter_var($_FILES['image_02']['name'], FILTER_SANITIZE_STRING);
   $image_size_02 = $_FILES['image_02']['size'];
   $image_tmp_name_02 = $_FILES['image_02']['tmp_name'];
   $image_folder_02 = '../uploaded_img/'.$image_02;

   $image_03 = filter_var($_FILES['image_03']['name'], FILTER_SANITIZE_STRING);
   $image_size_03 = $_FILES['image_03']['size'];
   $image_tmp_name_03 = $_FILES['image_03']['tmp_name'];
   $image_folder_03 = '../uploaded_img/'.$image_03;

   $select_products = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
   $select_products->execute([$name]);

   if($select_products->rowCount() > 0){
      $message[] = 'product name already exist!';
   }else{
      $insert_products = $conn->prepare("INSERT INTO `products`(name, details, price, image_01, image_02, image_03) VALUES(?,?,?,?,?,?)");
      $insert_products->execute([$name, $details, $price, $image_01, $image_02, $image_03]);

      if($insert_products){
         if($image_size_01 > 2000000 || $image_size_02 > 2000000 || $image_size_03 > 2000000){
            $message[] = 'image size is too large!';
         }else{
            move_uploaded_file($image_tmp_name_01, $image_folder_01);
            move_uploaded_file($image_tmp_name_02, $image_folder_02);
            move_uploaded_file($image_tmp_name_03, $image_folder_03);
            $message[] = 'new product added!';
         }
      }
   }  
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_product_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_img/'.$fetch_delete_image['image_01']);
   unlink('../uploaded_img/'.$fetch_delete_image['image_02']);
   unlink('../uploaded_img/'.$fetch_delete_image['image_03']);

   $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
   $delete_product->execute([$delete_id]);

   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
   $delete_cart->execute([$delete_id]);

   $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE pid = ?");
   $delete_wishlist->execute([$delete_id]);

   header('location:products.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Products</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
<link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="add-products">

<h1 class="heading">Add Product</h1>

<form action="" method="post" enctype="multipart/form-data">
   <div class="flex">
      <div class="inputBox">
         <span>Product Name (required)</span>
         <input type="text" class="box" required maxlength="100" placeholder="Enter product name" name="name">
      </div>
      <div class="inputBox">
         <span>Product Price (required)</span>
         <input type="number" min="0" class="box" required max="9999999999" placeholder="Enter product price" name="price">
      </div>
      <div class="inputBox">
         <span>Image 01 (required)</span>
         <input type="file" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
      </div>
      <div class="inputBox">
         <span>Image 02 (required)</span>
         <input type="file" name="image_02" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
      </div>
      <div class="inputBox">
         <span>Image 03 (required)</span>
         <input type="file" name="image_03" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
      </div>
      <div class="inputBox">
         <span>Product Details (required)</span>
         <textarea name="details" placeholder="Enter product details" class="box" required maxlength="500" cols="30" rows="5"></textarea>
      </div>
   </div>
   <input type="submit" value="Add Product" class="btn" name="add_product">
</form>

</section>

<section class="show-products">

<h1 class="heading">Products Added</h1>

<table>
   <thead>
      <tr>
         <th>ID</th>
         <th>Image 01</th>
         <th>Image 02</th>
         <th>Image 03</th>
         <th>Name</th>
         <th>Price</th>
         <th>Details</th>
         <th>Actions</th>
      </tr>
   </thead>
   <tbody>
      <?php
         $select_products = $conn->prepare("SELECT * FROM `products`");
         $select_products->execute();
         if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
      ?>
      <tr>
         <td><?= $fetch_products['id']; ?></td>
         <td><img src="../uploaded_img/<?= $fetch_products['image_01']; ?>" alt=""></td>
         <td><img src="../uploaded_img/<?= $fetch_products['image_02']; ?>" alt=""></td>
         <td><img src="../uploaded_img/<?= $fetch_products['image_03']; ?>" alt=""></td>
         <td><?= $fetch_products['name']; ?></td>
         <td>$<?= $fetch_products['price']; ?></td>
         <td><?= $fetch_products['details']; ?></td>
         <td>
            <a href="update_product.php?update=<?= $fetch_products['id']; ?>" class="btn option-btn">Update</a>
            <a href="products.php?delete=<?= $fetch_products['id']; ?>" class="btn delete-btn" onclick="return confirm('Delete this product?');">Delete</a>
         </td>
      </tr>
      <?php
            }
         } else {
            echo '<tr><td colspan="8">No products added yet!</td></tr>';
         }
      ?>
   </tbody>
</table>

</section>

<script src="../js/admin_script.js"></script>

</body>
</html>

<style>
   table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
   }
   table, th, td {
      border: 1px solid #ddd;
   }
   th, td {
      padding: 10px;
      text-align: center;
      vertical-align: middle;
   }
   th {
      background-color: #f4f4f4;
   }
   img {
      max-width: 100px;
      height: auto;
   }
   .btn {
      padding: 5px 10px;
      text-decoration: none;
      border-radius: 5px;
   }
   .option-btn {
      background: #3498db;
      color: #fff;
      margin: 2px;
   }
   .delete-btn {
      background: #e74c3c;
      color: #fff;
      margin: 2px;
   }
</style>