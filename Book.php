
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="BookStream.css">
    <title>Book Stream</title>
</head>
<body>
  <ul class="nav">
    <li><a href="index.php">All Books</a></li>
    <li><a href="Popular.php">Best Sellers</a></li>
    <li><a href="Author.php">Authors</a></li>
  </ul>
  <?php
    $title = $_GET['book_title'];
    include 'mysqlFunctions.php';
    $conn = dbConnect();
    $book = getBook($conn,$title);
    $review = getReview($conn,$title);
    $book_info = mysqli_fetch_assoc($book);
    $review_info = mysqli_fetch_assoc($review);
  ?>
  <div class="bookOuput">
    <h1><?php echo $book_info['title']; ?></h1>
    <h2>Age Rating: <?php echo $book_info['age_rating'];?> Rating (out of 5):
      <?php echo $review_info['rating'];?> Price: $<?php echo $book_info['price']?>
    </h2>
    <h3>Comments:</h3>
    <p> <?php echo $review_info['comment'];?></p>
  </div>
  <form method="post" action="MakePurchase.php">
    <input type="text" value="<?php echo $book_info['title'];?>" name="booktitle">
    <input type="submit" value="Buy" name="purchase">
  </form>
  <?php
    dbDisconnect($conn);
  ?>
</body>
</html>
