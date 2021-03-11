<?php

    session_start();
    
    // connection setup
    require_once 'config/conn.php';

    // special functions
    require_once 'class/edUpDel.php';

    if(isset($_POST['submit'])){

        $username = $email = $message = $image = "";

        // function to validate form input
        function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
        }

        // implementing defined function text_input
        $username = test_input($_POST['username']);
        $email = test_input($_POST['email']);
        $message = test_input($_POST['message']);
        
        // file upload
        $image = $_FILES['image']['name'];
        $path = "upload/".$image;
        move_uploaded_file($_FILES['image']['tmp_name'], $path);

        
        $sql = "INSERT INTO user (username, email, image, message) VALUES (?, ?, ?, ?)";
        
        //function to process the sql has been defined in class folder edUpDel
        insertData($sql, $conn, $username, $email, $image, $message);

        $_SESSION['message'] = 'Your data has been uploaded';
        $_SESSION['alert'] = 'success';
         header("location: index.php?uploaded");

    }



    elseif(isset($_GET['delete'])){
        $id = $_GET['id'];

        $sql = "DELETE FROM user WHERE id = $id";
        $result = $conn->query($sql);
        
        $_SESSION['message'] = "Record has been deleted!";
        $_SESSION['alert'] = "danger";        
    
        header('location: index.php?deleted'); 
        
    }

    elseif(isset($_POST['update'])){
        $id = $_POST['id'];

         // function to validate form input
         function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
            }

        // implementing defined function text_input
        $username = test_input($_POST['username']);
        $email = test_input($_POST['email']);
        $message = test_input($_POST['message']);
        
        // file upload
        $image = $_FILES['image']['name'];
        $path = "upload/".$image;
        move_uploaded_file($_FILES['image']['tmp_name'], $path);

        $sql = "UPDATE user SET 
                username = ?,
                email = ?,
                image = ?,
                message = ?
                WHERE id = ?";
    
        updateData($sql, $conn, $username, $email, $image, $message, $id);
          
        

    }


    else{
        header('location: index.php');
    }

 
 ?>

