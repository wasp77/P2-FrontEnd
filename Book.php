
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
  <?php
    $title = $_GET['book_title'];
    include 'mysqlFunctions.php';
    $conn = dbConnect();
    $book = getBook($conn,$title);
    $review = getReview($conn,$title);
    $book_info = mysqli_fetch_assoc($book);
    //Output the book's details
  ?>
  <div class="bookOuput">
    <img class="purchaseImg" src="/Pictures/<?php echo $book_info['title']?>.jpg">
    <h1><?php echo $book_info['title']; ?></h1>
    <h2>Age Rating: <?php echo $book_info['age_rating'];?> Price: $<?php echo $book_info['price']?>
    </h2>
    <form class="buy" method="post" action="MakePurchase.php">
      <input type="hidden" value="<?php echo $book_info['title'];?>" name="booktitle">
      <input type="submit" value="Buy" name="purchase">
    </form>
  </div>
  <div class="reviews">
    <h1>Customer Reviews:</h1>
    <?php
      //Output all the book's reviews
      while ($review_info = mysqli_fetch_assoc($review)) {
    ?>
      <h2><?php echo $review_info['rating'];?> out of 5</h2>
      <p>"<?php echo $review_info['comment'];?>"</p>
    <?php
      }
    ?>
  </div>
  <?php
    dbDisconnect($conn);
  ?>
</body>
</html>
