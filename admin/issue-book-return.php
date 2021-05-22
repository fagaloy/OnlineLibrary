<?php

    // Insert the content of connection.php file
    include('connection1.php');
    
    // Delete data from the database
    if(ISSET($_POST['deleteData']))
    {
        $book_id = $_POST['deleteId']; 

        $sql = "UPDATE books 
  SET quantity = quantity+1
  WHERE book_id = $book_id";
  $result = mysqli_query($conn, $sql);
  $sql2= "DELETE FROM issue_book WHERE book_id='$book_id'";
        $result2 = mysqli_query($conn, $sql2);

         $sql3= "UPDATE books SET stat='Returned' WHERE book_id = $book_id ";
        $result3 = mysqli_query($conn, $sql3);

        if($result){
            echo '<script> alert("Book Returned."); </script>';
            echo("<script>location.href ='manage-transactions.php';</script>");
        }else{
            echo '<script> alert("Book Not Returned."); </script>';
        }
                if($result2){
            echo '<script> alert("Book Returned."); </script>';
            echo("<script>location.href ='manage-transactions.php';</script>");
        }else{
            echo '<script> alert("Book Not Returned."); </script>';
        }
        if($result3){
            echo '<script> alert("Book Returned."); </script>';
            echo("<script>location.href ='manage-transactions.php';</script>");
        }else{
            echo '<script> alert("Book Not Returned."); </script>';
        }
    }
?>