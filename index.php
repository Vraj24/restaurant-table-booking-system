<?php
    session_start();
    include "db_conn1.php";

    if(isset($_POST['uname']) && isset($_POST['password'])){
        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);

            return $data;
        }
        $uname = validate($_POST['uname']);
        $pass = validate($_POST['password']);

        if(empty($uname)){
            header("Location: login.php?error=User Name is required");
            exit();
        }
        else if(empty($pass)){
            header("Location: login.php?error=Password is required");
            exit();
        }
        else{
            $sql = "SELECT * FROM users WHERE user_name='$uname' AND password='$pass'";

            $result = mysqli_query($conn,$sql);

            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_assoc($result);

                if($row['user_name'] === $uname && $row['password'] === $pass){
                    $_SESSION['user_name'] = $row['user_name'];
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['id'] = $row['id'];

                    // echo $_SESSION['name'];
                    // header("Location: index.php");
                    // exit();
                }
                else{
                    header("Location: login.php?error=Incorrect User Name or Password");
                    exit();
                }
            }
            else{
                header("Location: login.php?error=Incorrect User Name or Password");
                exit();
            }
        }

    }
    else{
        header("Location: login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barbeque Nation</title>
    <link rel="icon" type="image/x-icon" href="./logo.svg">
    <link rel="stylesheet" href="./style.css">
    <link rel=”stylesheet” href=”https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css”>
    <!-- <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script> -->

    <style>
        .btn:hover{
            color:#FC4412;
            background:white;
        }
        .reserve{
            border:2px solid black;
        }
        .reserve:hover{
            color:#FC4412;
            background:white;
        }
    </style>
</head>
<body>
<div>
    <header class="head">
        <img src="./logo.svg" class="logo" alt="logo">
        <select name="location" id="location">
            <option value="select location" selected disabled>Select Location</option>
            <option value="anand">Anand</option>
            <option value="Vadodara">Vadodara</option>
            <option value="Ahmedabad">Ahmedabad</option>
            <option value="Surat">Surat</option>
        </select>
        <nav class="navbar">
            <form action="./logout.php" method="post">
            <ul class="ul">
                <li><a href="">HAPPINESS CARD</a></li>
                <li><a href="">WHAT'S ON BBQN</a></li>
                <li><a href="">TODAY'S MENU</a></li>
                <li><a href="">SMILES</a></li>
                <li><button type="submit" class="btn">Log out</button></li>
                <li style="color:#FC4412;">Welcome, <?php echo $_SESSION['name'] ?></li>
            </ul>
            </form>
        </nav>
    </header>
</div>

<section class="section">
    <div>
        <img src="./bg1.jpg" alt="" class="inner-img" style="height: 600px;">
    </div>
    <div class="inner-data" style="height: 600px;margin-top: -695px;">
        <form action="./reserve.php" method="post">
            <h2>Let us serve you better</h2>
            <p class="details1">Don't wait in a line to enjoy your meal. <br> Reserve a table in advance with us.</p>

            <p class="details2">Location</p>
            <select name="location" id="inner-select">
                <option value="Select Location" selected disabled>Select Location</option>
                <option value="Anand">Anand</option>
                <option value="Vadodara">Vadodara</option>
                <option value="Ahmedabad">Ahmedabad</option>
                <option value="Surat">Surat</option>
            </select>

            <p class="details2">Date</p>
            <input type="date" class="date" name="date">

            <p class="details2">Persons</p>
            <input type="number" class="date" name="persons">

            <p class="details2">Session</p>
            <input type="radio" name="session" class="check" id="LUNCH" value="LUNCH"><label for="LUNCH" class="inner_check">LUNCH</label>
            <input type="radio" name="session" class="check" id="DINNER" value="DINNER"><label for="DINNER" class="inner_check">DINNER</label><br>
            
            <p class="details2">Time</p>
            <input type="time" class="date" name="time">

            <input type="submit" class="reserve" value="Reserve Table" style="margin-top: 30px;">
        </form>
    </div>
</section>

<!-- <h2 class="happiness">Latest Updates</h2> -->

<h2 class="happiness">Happiness card for you...</h2>
<main class="main">
    <div class="main1">
        <img src="https://d23ynomj6u3eig.cloudfront.net/sites/default/files/2022-04/happiness%20gift%20card_3.png" alt="">
        <div class="main1_inner">
            Happiness Gift Card- Treat for Four<br>
            <h2>@3,600</h2>
            <!-- <button class="happyBtn">Buy Now</button>            -->
        </div>
    </div>
    <div class="main1">
        <img src="https://d23ynomj6u3eig.cloudfront.net/sites/default/files/2022-04/happiness%20gift%20card_3.png" alt="">
        <div class="main2_inner">
            Happiness Gift Card- Treat for Two<br>
            <h2>@1,800</h2>
            <!-- <button class="happyBtn">Buy Now</button> -->
        </div>
    </div>
    <div class="main3">
        <img src="https://d23ynomj6u3eig.cloudfront.net/sites/default/files/2022-04/happiness%20gift%20card_3.png" alt="">
        <div class="main3_inner">
            Happiness Gift Card<br>
            <h2>@10,000</h2>
            <!-- <button class="happyBtn">Buy Now</button> -->
        </div>
    </div>
</main>

<div class="foot-cont">
    <footer>
        <div class="in-foot">
            <ul>
                <li><a href="">OUR STORY</a></li>
                <li><a href="">NEWS</a></li>
                <li><a href="">HAPPINESS CARD</a></li>
                <li><a href="">CAREERS</a></li>
                <li><a href="">FAQ</a></li>
                <li><a href="">INVESTOR RELATIONS</a></li>
                <li><a href="">BARBEQUE NATION PARTNERSHIP</a></li>
            </ul>
        </div>
        <div class="in-foot">
            <ul>
                <li><a href="">LOCATIONS</a></li>
                <li><a href="">BLOG</a></li>
                <li><a href="">WHATS'S ON BBQN</a></li>
                <li><a href="">CONTACT US</a></li>
                <li><a href="">CORPORATE ENQUIRY</a></li>
                <li><a href="">MEDIA CONVERAGE</a></li>
                <li><a href="">NUTRITION INFORMATION</a></li>
            </ul>
        </div>
        <div class="contact">
            <ul>
                <p class="foot-in">REACH Us</p>
                <p class="foot-in-in">Mail Us</p>
                <p class="foot-in-in-det">feedback@barbequenation.com</p>
                <p class="foot-in-in">Call Us</p>
                <p class="foot-in-in-det">08069028721</p>
            </ul>
            <ul class="ul-1">
                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="#"><i class="fab fa-instagram-f"></i></a></li>
                <li><a href="#"><i class="fab fa-youtube-f"></i></a></li>
            </ul>
        </div>
    </footer>
    <footer>
        <div class="copy">
            <img src="./logo.svg" alt="">
            <p class="copy-p">© 2019 Barbeque Nation Hospitality Ltd.
            <span class="term">Terms & Conditions</span>
            <span class="policy">Privacy Policy</span></p>
        </div>
    </footer>
</div>
</body>
</html>