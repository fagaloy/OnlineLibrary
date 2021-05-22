<?php

    // Insert the content of connection.php file
    include('mylibrary-functions/connection.php');
    
    // Insert data into the database
    if(ISSET($_POST['sendData']))
    {
        
        $book_id = $_POST['updateId'];
        $book_title = $_POST['updateTitle'];
        $book_author = $_POST['updateAuthor'];
        $book_publisher = $_POST['updatePublisher'];
        $book_genre = $_POST['updateGenre'];
        $status = $_POST['status'];
        $borrower = $_POST['borrower'];

        $sql = "INSERT INTO issue_book (book_id,book_title, book_author, book_publisher, book_genre,status,borrower) VALUES('$book_id','$book_title', '$book_author', '$book_publisher', '$book_genre', '$status','$borrower')";       
        $result = mysqli_query($conn, $sql);

        $sql2 = "UPDATE books SET quantity=quantity-1 WHERE book_id='$book_id'";       
        $result2 = mysqli_query($conn, $sql2);
        $sql3 = "UPDATE books SET stat='' WHERE book_id='$book_id'";       
        $result3 = mysqli_query($conn, $sql3);
        
        if($result&&$result2&&$result3){
            echo '<script> alert("Data saved."); </script>';
             echo("<script>location.href ='browse-books.php';</script>");
        }else{
            echo '<script> alert("Data Not saved."); </script>';
                         echo("<script>location.href ='browse-books.php';</script>");

        }
    }
?>