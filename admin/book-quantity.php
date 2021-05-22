<?php

    // Insert the content of connection.php file
    include('connection1.php');
    
    // Insert data into the database
    if(ISSET($_POST['sendQ']))
    {
        
        $book_id = $_POST['deleteId'];

        $sql = "UPDATE multilogin.books 
  SET quantity = quantity +1
  WHERE book_id = $book_id";       
        $result = mysqli_query($conn, $sql);

        if($result){
            echo '<script> alert("Data saved."); </script>';
             echo("<script>location.href ='manage-transactions.php';</script>");
        }else{
            echo '<script> alert("Data Not saved."); </script>';
        }
    }
?>