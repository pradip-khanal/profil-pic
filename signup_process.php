<?php

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['newUsername'];
    $password = $_POST['newPassword'];
    $cpassword = $_POST['confirmPassword'];

    // Check if password and confirm password match
    if ($password !== $cpassword) {
        echo "Passwords do not match.";
        exit();
    }

    // Check if user already exists
    $checkUserQuery = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $checkUserQuery);

    if (mysqli_num_rows($result) > 0) {
        echo "User already exists.";
        exit();
    }

    if(isset($_FILES['profileImage'])){
        $errors= array();
        $file_name = $_FILES['profileImage']['name'];
        $file_size = $_FILES['profileImage']['size'];
        $file_tmp = $_FILES['profileImage']['tmp_name'];
        $file_type = $_FILES['profileImage']['type'];
        
        

        

        
        if(empty($errors)==true) {
           move_uploaded_file($file_tmp,"images/".$file_name);
                // Insert new user into the database if user does not exist
            $sql = "INSERT INTO users (username, password, profile) VALUES ('$username','$password', '$file_name')";
            if (mysqli_query($conn, $sql)) {
                echo "New record created successfully";
            } else {
                 echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }       
        }
        else{
           print_r($errors);
        }
     }
    mysqli_close($conn);
}