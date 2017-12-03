<?php
    define('DB_USER','jbd8');
    define('DB_PASSWORD','Sh2QFU.5W08AhJ');
    define('DB_HOST','jbd8.host.cs.st-andrews.ac.uk');
    define('DB_NAME','jbd8_cs3101_db');

    function dbConnect() {
      $conn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
      if(!$conn) {
          echo 'Could not connect';
          exit;
      } else {
        return $conn;
      }
    }

    function dbDisconnect($conn) {
      mysqli_close($conn);
    }



    function getAllBooks($conn) {
      $all_books = 'SELECT title FROM audio_book';
      $result = mysqli_query($conn, $all_books);
      if(mysqli_num_rows($result) > 0) {
        return $result;
      } else {
        echo 'Nothing <br>';
        exit;
      }
    }

    function getBook($conn, $title) {
      $real_title = mysqli_real_escape_string($conn, $title);
      $book = "SELECT title, age_rating, price FROM audio_book WHERE title = '$real_title'";
      $result = mysqli_query($conn, $book);
      if(mysqli_num_rows($result) > 0) {
        return $result;
      } else {
        echo 'Nothing book <br>';
        exit;
      }
    }

    function getPopular($conn) {
      $popular = "SELECT title, age_rating, price FROM audio_book INNER JOIN purchase On audio_book.ISBN = purchase.ISBN GROUP BY title ORDER BY count(purchase.ISBN) DESC LIMIT 6";
      $result = mysqli_query($conn, $popular);
      if(mysqli_num_rows($result) > 0) {
        return $result;
      } else {
        echo 'Nothing <br>';
        exit;
      }
    }

    function getAuthors($conn) {
      $authors = "SELECT first_name, last_name FROM author";
      $result = mysqli_query($conn, $authors);
      if(mysqli_num_rows($result) > 0) {
        return $result;
      } else {
        echo "Nothing";
        exit;
      }
    }

    function getAuthorBooks($conn,$first_name, $last_name) {
      $author_books = "SELECT title FROM audio_book INNER JOIN writes ON audio_book.ISBN = writes.ISBN AND writes.author_id IN (
        SELECT author_id FROM author WHERE first_name = '$first_name' AND last_name = '$last_name')";
      $result = mysqli_query($conn, $author_books);
      if(mysqli_num_rows($result) > 0) {
        return $result;
      } else {
        echo 'Nothing author books<br>';
        exit;
      }
    }

    function getReview($conn,$title) {
      $real_title = mysqli_real_escape_string($conn, $title);
      $review = "SELECT rating, comment FROM  review INNER JOIN audio_book ON review.ISBN = audio_book.ISBN AND audio_book.title = '$real_title'";
      $result = mysqli_query($conn, $review);
      if(mysqli_num_rows($result) > 0) {
        return $result;
      } else {
        echo 'Nothing <br>';
        exit;
      }
    }

    function getISBN($conn,$title) {
      $real_title = mysqli_real_escape_string($conn, $title);
      $ISBN = "SELECT ISBN FROM audio_book WHERE title = '$real_title'";
      $result = mysqli_query($conn, $ISBN);
      if(mysqli_num_rows($result) > 0) {
        return $result;
      } else {
        echo 'Nothing ISBN<br>';
        exit;
      }
    }

    function makePurchase($conn,$ISBN) {
      $purchase = "INSERT INTO purchase (ISBN,date) VALUES ('$ISBN',NOW())";
      if(mysqli_query($conn, $purchase)) {
        echo "New record created";
      } else {
        echo 'Nothing <br>';
        exit;
      }
    }
 ?>
