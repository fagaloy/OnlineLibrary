<?php

    // Insert the content of connection.php file
    include('connection1.php');

    // Update data into the database
    if(ISSET($_POST['updateData']))
    {   
        $id = $_POST['updateId'];
        $username = $_POST['updateUsername'];
        $firstname = $_POST['updateFirstname'];
        $lastname = $_POST['updateLastname'];
        $gender = $_POST['updateGender'];
        $email = $_POST['updateEmail'];
        $user_type = $_POST['updateUsertype'];
        $password = $_POST['updatePassword'];


        $sql = "UPDATE users SET username='$username',
                                        firstname='$firstname', 
                                        lastname='$lastname',
                                        gender='$gender',
                                        email='$email',
                                        user_type='$user_type',
                                        password='$password'
                                        WHERE id='$id'";

        $result = mysqli_query($conn, $sql);

        if($result)
        {
            echo '<script> alert("Data Updated Successfully."); </script>';
            echo("<script>location.href ='manage-user.php';</script>");
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
        }
    }
?>