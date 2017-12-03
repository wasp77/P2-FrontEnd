
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="BookStream.css">
    <title>Book Stream</title>
</head>
<body style="background-image: url(/Pictures/background.jpg)">
  <ul class="nav">
    <li><a class="active" href="index.php">All Books</a></li>
    <li><a href="Popular.php">Best Sellers</a></li>
    <li><a href="Author.php">Authors</a></li>
  </ul>
  <ul class="output">
    <?php
      include 'mysqlFunctions.php';
      $conn = dbConnect();
      $result = getAllBooks($conn);
      //Loop through each book outputting the title
      while($row = mysqli_fetch_assoc($result)) {
    ?>
      <li>
        <img src="/Pictures/<?php echo $row['title']?>.jpg">
        <br>
        <a href="Book.php?book_title=<?php echo $row['title']; ?>">
          <?php echo $row['title'];?>
        </a>
      </li>
    <?php
      }
      dbDisconnect($conn);
    ?>
  </ul>
</body>
</html>
