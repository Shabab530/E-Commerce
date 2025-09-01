<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_admins = $conn->prepare("DELETE FROM `admins` WHERE id = ?");
   $delete_admins->execute([$delete_id]);
   header('location:admin_accounts.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Accounts</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="accounts">

   <h1 class="heading">Admin Accounts</h1>

   <p><a href="register_admin.php" class="option-btn">+ Add New Admin</a></p>

   <table>
      <thead>
         <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Actions</th>
         </tr>
      </thead>
      <tbody>
         <?php
            $select_accounts = $conn->prepare("SELECT * FROM `admins`");
            $select_accounts->execute();
            if($select_accounts->rowCount() > 0){
               while($fetch_accounts = $select_accounts->fetch(PDO::FETCH_ASSOC)){   
         ?>
         <tr>
            <td><?= $fetch_accounts['id']; ?></td>
            <td><?= $fetch_accounts['name']; ?></td>
            <td>
               <a href="admin_accounts.php?delete=<?= $fetch_accounts['id']; ?>" onclick="return confirm('Delete this account?')" class="btn delete-btn">Delete</a>
               <?php if($fetch_accounts['id'] == $admin_id){ ?>
                  <a href="update_profile.php" class="btn option-btn">Update</a>
               <?php } ?>
            </td>
         </tr>
         <?php
               }
            }else{
               echo '<tr><td colspan="3">No accounts available!</td></tr>';
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
         padding: 5px 5px;
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
   </style>