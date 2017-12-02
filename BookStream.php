<?php
    define('DB_USER','jbd8');
    define('DB_PASSWORD','Sh2QFU.5W08AhJ');
    define('DB_HOST','jbd8.host.cs.st-andrews.ac.uk');
    define('DB_NAME','jbd8_cs3101_db');

    $conn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    if(!$conn) {
        die('Could not connect');
    } else {
      echo "connected \n";
    }

    function printAllBooks($conn) {
      $all_books = 'SELECT title, age_rating, price FROM audio_book';
      $result = mysqli_query($conn, $all_books);
      if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          echo '<div class=\"output\">Title: '.$row['title'].' Age Rating: '.$row['age_rating'].' Price:'.$row['price'].'</div>'."\n  ";
        }
        $result->free();
      } else {
        echo 'Nothing <br>';
      }
    }

    function printPopular($conn) {
      $popular = "SELECT title, age_rating, price FROM audio_book INNER JOIN purchase on 'audio_book.ISBN = purchase.ISBN' GROUP BY title ORDER BY 'count(purchase.ISBN)' DESC LIMIT '5'";
      $result = mysqli_query($conn, $popular);
      if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          echo '<div class=\"output\">Title: '.$row['title'].' Age Rating: '.$row['age_rating'].' Price:'.$row['price'].'</div>'."\n  ";
        }
        $result->free();
      } else {
        echo 'Nothing <br>';
      }
    }

    function printAuthor($conn,$first_name, $last_name) {
      $author_books = "SELECT title, age_rating, price FROM audio_book INNER JOIN writes ON 'audio_book.ISBN = writes.ISBN' AND 'writes.author_id' IN (
        SELECT author_id FROM author WHERE first_name '=' $first_name AND last_name '=' $last_name)";
      $result = mysqli_query($conn, $author_books);
      if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          echo '<div class=\"output\">Title: '.$row['title'].' Age Rating: '.$row['age_rating'].' Price:'.$row['price'].'</div>'."\n  ";
        }
        $result->free();
      } else {
        echo 'Nothing <br>';
      }
    }

    function printReview($conn,$title) {
      $review = "SELECT rating, comment FROM  review INNER JOIN audio_book ON 'review.ISBN = audio_book.ISBN' and 'audio_book.title =' $title";
      $result = mysqli_query($conn, $review);
      if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          echo '<div class=\"output\">Title: '.$row['title'].' Age Rating: '.$row['age_rating'].' Price:'.$row['price'].'</div>'."\n  ";
        }
        $result->free();
      } else {
        echo 'Nothing <br>';
      }
    }

    function makePurchase($ISBN, $date) {
      $purchase = "INSERT INTO purchase (ISBN, 'date') VALUES ($ISBN,$date)";
      $result = mysqli_query($conn, $purchase);
      if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          echo '<div class=\"output\">Title: '.$row['title'].' Age Rating: '.$row['age_rating'].' Price:'.$row['price'].'</div>'."\n  ";
        }
        $result->free();
      } else {
        echo 'Nothing <br>';
      }
    }

    printAllBooks($conn);

    mysqli_close($conn);
 ?>
