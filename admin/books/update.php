<?php

    // Insert the content of connection.php file
    include('connection.php');

    // Update data into the database
    if(ISSET($_POST['updateData']))
    {   
        $book_id = $_POST['updateId'];
        $book_title = $_POST['updateTitle'];
        $book_author = $_POST['updateAuthor'];
        $book_publisher = $_POST['updatePublisher'];
        $book_genre = $_POST['updateGenre'];


        $sql = "UPDATE books SET book_title='$book_title',
                                        book_author='$book_author', 
                                        book_publisher='$book_publisher',
                                        book_genre=' $book_genre'
                                        WHERE book_id='$book_id'";

        $result = mysqli_query($conn, $sql);

        if($result)
        {
            echo '<script> alert("Data Updated Successfully."); </script>';
            echo("<script>location.href ='index.php';</script>");
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
        }
    }
?>