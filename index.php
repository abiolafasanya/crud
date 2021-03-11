
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>PHP CRUD</title>
</head>
<body>
    <div class="container">
        <?php  
        // connection setup
        require_once 'config/conn.php';
        // special functions
        require_once 'class/edUpDel.php'; 
        ?>
        <div class="jumbotron text-center text-info">
                <h1>Crud Application</h1>
        </div>

        
                <?php 
                    session_start();
                    if(isset($_GET['uploaded'])){
                        flash($_SESSION['alert'], $_SESSION['message']);
                    }
                   elseif(isset($_GET['updated'])){
                        flash($_SESSION['alert'], $_SESSION['message']);
                    }
                   elseif(isset($_GET['deleted'])){
                        flash($_SESSION['alert'], $_SESSION['message']);
                    }
                    else{
                            //  a future welcome alert
                    }

                ?>
                       
                

            <div class="row justify-content-center">
                <form action="process.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $id; ?>">

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" value="<?= $username; ?>"">
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" class="form-control" value="<?= $email; ?>">
                    </div>
                    <div class="custom-file">
                        <input type="file" name="image" value="<?= $image; ?>" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose an Image</label>
                    </div>
                    <div class="form-group">
                        <label for="username">Message</label>
                        <textarea name="message"  class="form-control" cols="30" rows="10"><?= $message; ?></textarea>
                    </div>

                    <?php  if(isset($_GET['edit'])): ?>
                        <div class="form-group">
                            <button type="submit" name="update" class="btn btn-success">Update</button>
                        </div>
                    
                    <?php else: ?>
                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            </div>
                    <?php endif; ?>
                    
                </form>
            </div>

            <div class="row-justify-center">
                <table class="table table-responsive table-striped">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Image</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <?php
                        $result = $conn->query("SELECT * FROM user");
                        while($row = $result->fetch_assoc()):
                    ?>
                    <tr>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['message']; ?></td>
                        <td><img src="upload/<?=$row['image'] ?>" width="200px"></td>
                        <td>
                            <form>
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="edit" class="btn btn-primary">Edit</button>
                            </form>
                        </td>
                        <td>
                            <form action="process.php">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php endwhile ?>
                </table>
    </div>
        
    </div>
</body>
</html>