<?php
  include "mysqlFunctions.php";
  $conn = dbConnect();
  if (isset($_POST['purchase'])) {
    $ISBN = getISBN($conn, $_POST['booktitle']);
    $row = mysqli_fetch_assoc($ISBN);
    makePurchase($conn,$row['ISBN']);
  }
  dbDisconnect($conn);
 ?>
