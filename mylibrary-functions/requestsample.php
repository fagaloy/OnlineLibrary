     <?php
         include "connection.php";
     if(isset($_POST['request']))
    {
     $sql="INSERT INTO issue_books (username, book_id,book_title) 
     SELECT username, book_id,book_title 
     FROM users, books 
     WHERE id='$id'
     AND book_id='$book_id'";
     $conn->close();
     }

     ?>