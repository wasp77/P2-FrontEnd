<?php
  include "mysqlFunctions.php";
  $conn = dbConnect();
  //Check if the submit button was clicked
  if (isset($_POST['purchase'])) {
    $ISBN = getISBN($conn, $_POST['booktitle']); //Get the book's title from the hidden input
    $row = mysqli_fetch_assoc($ISBN);
    makePurchase($conn,$row['ISBN']);
  }
  dbDisconnect($conn);
 ?>
 <html lang="en">
 <head>
     <meta charset="utf-8">
     <link rel="stylesheet" href="BookStream.css">
     <title>Book Stream</title>
 </head>
 <body style="background-image: url(/Pictures/background.jpg)">
   <ul class="nav">
     <li><a href="index.php">All Books</a></li>
     <li><a href="Popular.php">Best Sellers</a></li>
     <li><a href="Author.php">Authors</a></li>
   </ul>
   <h1 class="purchaseOutput">Thank you for your purchase!</h1>
 </body>
 </html>
