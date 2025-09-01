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
<title>Orders</title>

<!-- font awesome cdn link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

<!-- custom css file link -->
<link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="orders">

<h1 class="heading">Placed Orders</h1>

<?php
if($user_id == ''){
   echo '<p class="empty">Please login to see your orders</p>';
}else{
   $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
   $select_orders->execute([$user_id]);
   if($select_orders->rowCount() > 0){
?>

<table>
   <thead>
      <tr>
         <th>Placed On</th>
         <th>Name</th>
         <th>Email</th>
         <th>Number</th>
         <th>Address</th>
         <th>Payment Method</th>
         <th>Total Products</th>
         <th>Total Price</th>
         <th>Payment Status</th>
      </tr>
   </thead>
   <tbody>
      <?php while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){ ?>
      <tr>
         <td><?= $fetch_orders['placed_on']; ?></td>
         <td><?= $fetch_orders['name']; ?></td>
         <td><?= $fetch_orders['email']; ?></td>
         <td><?= $fetch_orders['number']; ?></td>
         <td><?= $fetch_orders['address']; ?></td>
         <td><?= $fetch_orders['method']; ?></td>
         <td><?= $fetch_orders['total_products']; ?></td>
         <td>$<?= $fetch_orders['total_price']; ?>/-</td>
         <td class="<?= $fetch_orders['payment_status'] == 'pending' ? 'pending' : 'completed'; ?>">
            <?= $fetch_orders['payment_status']; ?>
         </td>
      </tr>
      <?php } ?>
   </tbody>
</table>

<?php
   } else {
      echo '<p class="empty">No orders placed yet!</p>';
   }
}
?>

</section>

<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

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
   .pending {
      color: red;
      font-weight: bold;
   }
   .completed {
      color: green;
      font-weight: bold;
   }
</style>
