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

        $sql = "INSERT INTO book (book_id,book_title, book_author, book_publisher, book_genre,created_date) VALUES('$book_id','$book_title', '$book_author', '$book_publisher', '$book_genre',NOW())";       
        $result = mysqli_query($conn, $sql);

        if($result){
            echo '<script> alert("Data saved."); </script>';
             echo("<script>location.href ='mylibrary.php';</script>");
        }else{
            echo '<script> alert("Data Not saved."); </script>';
                         echo("<script>location.href ='mylibrary.php';</script>");

        }
    }
?>