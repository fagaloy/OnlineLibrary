<?php

    // Insert the content of connection.php file
    include('connection.php');
    
    // Delete data from the database
    if(ISSET($_POST['deleteData']))
    {
        $book_id = $_POST['deleteId']; 

        $sql = "DELETE FROM books WHERE book_id='$book_id'";
        $result = mysqli_query($conn, $sql);

        if($result){
            echo '<script> alert("Data Deleted."); </script>';
            echo("<script>location.href ='index.php';</script>");
        }else{
            echo '<script> alert("Data Not Deleted."); </script>';
        }
    }
?>