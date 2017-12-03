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
    <li><a class="active"href="Author.php">Authors</a></li>
  </ul>
  <ul class="authorOutput">
    <?php
      include 'mysqlFunctions.php';
      $conn = dbConnect();
      $authors = getAuthors($conn);
      //Output each other's name
      while($row = mysqli_fetch_assoc($authors)) {
    ?>
      <li>
        <h1><?php echo $row['first_name']." ".$row['last_name'];?></h1>
        <?php
          $author_books = getAuthorBooks($conn, $row['first_name'], $row['last_name']);
          //Output the author's books
          while($r = mysqli_fetch_assoc($author_books)) {
        ?>
          <a href="Book.php?book_title=<?php echo $r['title']; ?>">
            <?php echo $r['title'];?>
          </a>
        <?php } ?>
     </li>
    <?php
      }
      dbDisconnect($conn);
    ?>
  </ul>
</body>
</html>
