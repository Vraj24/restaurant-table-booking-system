<?php
    session_start();
    include "db_conn1.php";

    if(isset($_POST['name']) && isset($_POST['uname']) && isset($_POST['password'])){
        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);

            return $data;
        }
        $name = validate($_POST['name']);
        $uname = validate($_POST['uname']);
        $pass = validate($_POST['password']);
        
        if(empty($name)){
            header("Location: signup.php?error=Your Name is required");
            exit();
        }
        else if(empty($uname)){
            header("Location: signup.php?error=User Name is required");
            exit();
        }
        else if(empty($pass)){
            header("Location: signup.php?error=Password is required");
            exit();
        }
        else{
            $sql = "INSERT INTO users VALUES(NULL,'$uname', '$pass', '$name');";

            $result = mysqli_query($conn,$sql);

            // if(mysqli_num_rows($result) == 1){
            //     $row = mysqli_fetch_assoc($result);

            //     if($row['user_name'] === $uname && $row['password'] === $pass){
            //         $_SESSION['user_name'] = $row['user_name'];
            //         $_SESSION['name'] = $row['name'];
            //         $_SESSION['id'] = $row['id'];

            //         // echo $_SESSION['name'];
            //         // header("Location: index.php");
            //         // exit();
            //     }
            //     else{
            //         header("Location: login.php?error=Incorrect User Name or Password");
            //         exit();
            //     }
            // }
            // else{
            //     header("Location: login.php?error=Incorrect User Name or Password");
            //     exit();
            // }
        }

    }
    // else{
    //     header("Location: signup.php");
    //     exit();
    // }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="icon" type="image/x-icon" href="./logo.svg">
    <link rel="stylesheet" href="./login.css">
</head>
<body>
    <div class="container">
        <form action="index.php" method="post">
            <h2>Log In</h2>
            <?php if(isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error'] ?></p>
            <?php } ?>
            <label for="uname">User Name</label>
            <input type="text" name="uname" placeholder="User Name">
    
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Password">        
            <a href="./signup.php">You don't have account? Sign Up</a>
    
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>