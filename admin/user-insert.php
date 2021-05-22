<?php

    // Insert the content of connection.php file
    include('connection.php');
    
    // Insert data into the database
    if(ISSET($_POST['insertData']))
    {
        $username = $_POST['username'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $user_type = $_POST['user_type'];
        $password = $_POST['password'];

        $sql = "INSERT INTO users (username, firstname, lastname, gender,email,user_type,password) VALUES('$username', '$firstname', '$lastname', '$gender', '$email', '$user_type', '$password'";       
        $result = mysqli_query($conn, $sql);

        if($result){
            echo '<script> alert("Data saved."); </script>';
            echo("<script>location.href ='manage-user.php';</script>");
        }else{
            echo '<script> alert("Data Not saved."); </script>';
        }
    }
?>
