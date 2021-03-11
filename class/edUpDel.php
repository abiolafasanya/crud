<?php

function insertData($a, $b, $c, $d, $e, $f){
    $stmt = $b->prepare($a);
    $stmt->bind_param("ssss", $c, $d, $e, $f);
    if( $stmt->execute()){
        
        $_SESSION['message'] = 'Your data has been uploaded';
        $_SESSION['alert'] = 'success';
         header("location: index.php?uploaded");

    }
    else{
        // echo "There was an error .$a. " . $b->error;
        echo "Inserting Failed";
    }
}
function updateData($a, $b, $c, $d, $e, $f, $id){
    $stmt = $b->prepare($a);
    $stmt->bind_param("ssssi", $c, $d, $e, $f,  $id);
    if( $stmt->execute()){
        
        $_SESSION['message'] = "Message has been updated!";
        $_SESSION['alert'] = "success"; 
        header("location: index.php?updated");
        exit();
    }
    else{
        // echo "There was an error .$a. " . $b->error;
        echo "Update Failed";
    }
}



    function flash($a, $b){
        echo '<div class="alert alert-'.$a.' ">';
                    echo $b;
                    unset($b);
        echo '</div>';
    }

    // edit data to display on the form
   
    if(isset($_GET['edit'])){
       
        $id = $_GET['id'];

        $sql = "SELECT * FROM user WHERE id = ?";
        if($stmt = $conn->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("i", $id);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                $result = $stmt->get_result();
                
                if($result->num_rows == 1){
                    /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                    $row = $result->fetch_array();
                    $username = $row['username'];
                    $email = $row['email'];
                    $image = $row['image'];
                    $message = $row['message'];
                }

            }
        }
    }
        

?>

