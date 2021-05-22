<?php

    // Insert the content of connection.php file
    include('connection1.php');
    
    // Insert data into the database
    if(ISSET($_POST['insertData']))
    {
        $book_title = $_POST['book_title'];
        $book_author = $_POST['book_author'];
        $book_publisher = $_POST['book_publisher'];
        $book_genre = $_POST['book_genre'];
        $quantity = $_POST['quantity'];

        $sql = "INSERT INTO books (book_title, book_author, book_publisher, book_genre,quantity) VALUES('$book_title', '$book_author', '$book_publisher', '$book_genre','$quantity')";       
        $result = mysqli_query($conn, $sql);

        if($result){
            echo '<script> alert("Data saved."); </script>';
             echo("<script>location.href ='manage-books.php';</script>");
        }else{
            echo '<script> alert("Data Not saved."); </script>';
        }
    }
?>