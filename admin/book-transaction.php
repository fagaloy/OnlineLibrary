<?php

    // Insert the content of connection.php file
    include('connection1.php');
    
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

        $sql = "UPDATE issue_book SET book_title='$book_title',
                                        book_author='$book_author', 
                                        book_publisher='$book_publisher',
                                        book_genre=' $book_genre',
                                        status='$status',
                                        borrower='$borrower'   
                                        WHERE book_id='$book_id'";       
        $result = mysqli_query($conn, $sql);

        if($result){
            echo '<script> alert("Data saved."); </script>';
             echo("<script>location.href ='manage-transactions.php';</script>");
        }else{
            echo '<script> alert("Data Not saved."); </script>';
        }
    }
?>