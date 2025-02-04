<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

// if(isset($_POST['update_order'])){

//    $order_update_id = $_POST['order_id'];
//    $update_payment = $_POST['update_payment'];
//    mysqli_query($conn, "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_update_id'") or die('query failed');
//    $message[] = 'payment status has been updated!';

// }

if(isset($_POST['update_order'])){
    $order_update_id = $_POST['order_id'];
    $update_status_arrival = $_POST['update_status_arrival'];
    $update_status_condition = $_POST['update_status_condition'];

    mysqli_query($conn, "UPDATE `purchase` SET arrival_status = '$update_status_arrival', goods_condition = '$update_status_condition' WHERE purchase_id = '$order_update_id'") or die('query failed');
    $message[] = 'Order status has been updated!';
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Record Goods Recheiveble</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

   <style>
      .table-container {
  max-width: 100%;
  overflow-x: auto;
}

table {
  width: 100%;
  border-collapse: collapse;
}

thead {
  background-color: #f2f2f2;
}

th, td {
  padding: 10px;
  border-bottom: 1px solid #ddd;
  text-align: left;
}

th {
  font-weight: bold;
}

tbody tr:nth-child(even) {
  background-color: #f2f2f2;
}

tbody tr:hover {
  background-color: #ddd;
}

select, input[type="submit"] {
  padding: 8px 12px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 4px;
  background-color: #f2f2f2;
  cursor: pointer;
}

option[disabled] {
  color: #999;
}

.option-btn, .delete-btn {
  padding: 8px 16px;
  margin-right: 5px;
  border: none;
  border-radius: 4px;
  color: #fff;
  text-decoration: none;
  cursor: pointer;
}

.option-btn {
  background-color: #007bff;
}

.delete-btn {
  background-color: #dc3545;
}

.option-btn:hover, .delete-btn:hover {
  background-color: #0056b3;
}

.empty {
  text-align: center;
  padding: 10px 0;
  font-size: 20px;
}

   </style>

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="revenue">

   <h1 class="title">Record Recheiveble Goods</h1>
   <a href="admin_record_rawmaterial.php">Received Raw Material</a>

   <div class="table-container">
      <table>
         <thead>
            <tr>
               <th>ID</th>
               <th>Vendor</th>
               <th>Purchase Date</th>
               <th>Buyer</th>
               <th>Total Price</th>
               <th>Expected arrival</th>
               <th>arrival Status</th>
               <th>Goods Condition</th>
               <th>Action</th>
            </tr>
         </thead>
         <tbody> 
            <?php
            $select_orders = mysqli_query($conn, "SELECT * FROM `purchase`") or die('query failed');
            if(mysqli_num_rows($select_orders) > 0){
               while($fetch_orders = mysqli_fetch_assoc($select_orders)){
            ?>
         ...
            <tr>
               <td><?php echo $fetch_orders['purchase_id']; ?></td>
               <td><?php echo $fetch_orders['vendor']; ?></td>
               <td><?php echo $fetch_orders['date']; ?></td>
               <td><?php echo $fetch_orders['buyer']; ?></td>
               <td>Rp. <?php echo number_format($fetch_orders['total']); ?></td>
               <td><?php echo $fetch_orders['arrival']; ?></td>
               <td><?php echo $fetch_orders['arrival_status']; ?></td>
               <td><?php echo $fetch_orders['goods_condition']; ?></td>
               <td>
                    <form action="" method="post">
                        <input type="hidden" name="order_id" value="<?php echo $fetch_orders['purchase_id']; ?>">
                        <select name="update_status_arrival">
                            <option value="" selected disabled>Arrival status</option>
                            <option value="Arrived">Arrived</option>
                            <option value="Unarrived">Unarrived</option>
                        </select>
                        <select name="update_status_condition">
                            <option value="" selected disabled>Goods Condition</option>
                            <option value="Perfect">Perfect</option>
                            <option value="Incomplete Goods">Incomplete Goods</option>
                            <option value="Defective Goods">Defective Goods</option>
                            <option value="Uncheck">Uncheck</option>
                        </select>
                        <input type="submit" value="Update" name="update_order" class="option-btn">
                    </form>
                </td>
...

            <?php
               }
            }else{
               echo '<tr><td colspan="7" class="empty">No purchase order placed yet!</td></tr>';
            }
            ?>
         </tbody>
      </table>
   </div>



</section>