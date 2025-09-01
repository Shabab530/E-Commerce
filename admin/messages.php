<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_message = $conn->prepare("DELETE FROM `messages` WHERE id = ?");
   $delete_message->execute([$delete_id]);
   header('location:messages.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Messages</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="contacts">

   <h1 class="heading">Messages</h1>

   <table>
      <thead>
         <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Number</th>
            <th>Message</th>
            <th>Action</th>
         </tr>
      </thead>
      <tbody>
         <?php
            $select_messages = $conn->prepare("SELECT * FROM `messages`");
            $select_messages->execute();
            if($select_messages->rowCount() > 0){
               while($fetch_message = $select_messages->fetch(PDO::FETCH_ASSOC)){
         ?>
         <tr>
            <td><?= $fetch_message['id']; ?></td>
            <td><?= $fetch_message['user_id']; ?></td>
            <td><?= $fetch_message['name']; ?></td>
            <td><?= $fetch_message['email']; ?></td>
            <td><?= $fetch_message['number']; ?></td>
            <td><?= $fetch_message['message']; ?></td>
            <td>
               <a href="messages.php?delete=<?= $fetch_message['id']; ?>" 
                  onclick="return confirm('Delete this message?');" 
                  class="btn delete-btn">Delete</a>
            </td>
         </tr>
         <?php
               }
            } else {
               echo '<tr><td colspan="7">You have no messages</td></tr>';
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
   </style>