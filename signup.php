<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="icon" type="image/x-icon" href="./logo.svg">
    <link rel="stylesheet" href="./login.css">
</head>
<body>
    <div class="container">
        <form action="login.php" method="post">
            <h2>Sign Up</h2>
            <?php if(isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error'] ?></p>
            <?php } ?>
            <label for="name">Your Name</label>
            <input type="text" name="name" placeholder="Enter Your Name">
            <label for="uname">User Name</label>
            <input type="text" name="uname" placeholder="Create User Name">
    
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Create Password">        
            <a href="./login.php">You already have account? Log In</a>
            <button type="submit">Sign Up</button>
        </form>
    </div>

</body>
</html>