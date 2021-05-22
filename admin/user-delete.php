<?php

    // Insert the content of connection.php file
    include('connection1.php');
    
    // Delete data from the database
    if(ISSET($_POST['deleteData']))
    {
        $id = $_POST['deleteId']; 

        $sql = "DELETE FROM users WHERE id='$id'";
        $result = mysqli_query($conn, $sql);

        if($result){
            echo '<script> alert("Data Deleted."); </script>';
            echo("<script>location.href ='manage-user.php';</script>");
        }else{
            echo '<script> alert("Data Not Deleted."); </script>';
        }
    }
?>