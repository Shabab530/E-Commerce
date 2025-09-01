<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['update_payment'])){
   $order_id = $_POST['order_id'];
   $payment_status = $_POST['payment_status'] ?? ''; // null coalescing operator
   $payment_status = filter_var($payment_status, FILTER_SANITIZE_STRING);

   if(!empty($payment_status)){
      $update_payment = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
      $update_payment->execute([$payment_status, $order_id]);
      $message[] = 'Payment status updated!';
   } else {
      $message[] = 'Please select a payment status!';
   }
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
   $delete_order->execute([$delete_id]);
   header('location:placed_orders.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Placed Orders</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="orders">

   <h1 class="heading">Placed Orders</h1>

   <table>
      <thead>
         <tr>
            <th>ID</th>
            <th>Placed On</th>
            <th>Name</th>
            <th>Number</th>
            <th>Address</th>
            <th>Total Products</th>
            <th>Total Price</th>
            <th>Payment Method</th>
            <th>Payment Status</th>
            <th>Actions</th>
         </tr>
      </thead>
      <tbody>
         <?php
            $select_orders = $conn->prepare("SELECT * FROM `orders`");
            $select_orders->execute();
            if($select_orders->rowCount() > 0){
               while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
         ?>
         <tr>
            <td><?= $fetch_orders['id']; ?></td>
            <td><?= $fetch_orders['placed_on']; ?></td>
            <td><?= $fetch_orders['name']; ?></td>
            <td><?= $fetch_orders['number']; ?></td>
            <td><?= $fetch_orders['address']; ?></td>
            <td><?= $fetch_orders['total_products']; ?></td>
            <td>$<?= $fetch_orders['total_price']; ?>/-</td>
            <td><?= $fetch_orders['method']; ?></td>
            <td>
               <form action="" method="post" style="display:flex; flex-direction:column; align-items:center; gap:5px;">
                  <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
                  <select name="payment_status" class="select">
                     <option selected disabled><?= $fetch_orders['payment_status']; ?></option>
                     <option value="pending">pending</option>
                     <option value="completed">completed</option>
                  </select>
                  <input type="submit" value="Update" class="option-btn" name="update_payment">
               </form>
            </td>
            <td>
               <a href="placed_orders.php?delete=<?= $fetch_orders['id']; ?>" 
                  class="delete-btn" 
                  onclick="return confirm('Delete this order?');">Delete</a>
            </td>
         </tr>
         <?php
               }
            } else {
               echo '<tr><td colspan="10">No orders placed yet!</td></tr>';
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
      .btn {
         padding: 5px 10px;
         text-decoration: none;
         border-radius: 5px;
      }
      .delete-btn {
         background: #e74c3c;
         color: #fff;
      }
      .option-btn {
         background: #3498db;
         color: #fff;
      }
      select {
         padding: 5px;
      }

   </style>
