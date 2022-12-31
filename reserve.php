<?php
    session_start();
    require "db_conn1.php";

    if(isset($_POST['location']) && isset($_POST['date']) && isset($_POST['persons']) && isset($_POST['session']) && isset($_POST['time'])){
        // function validate($data){
        //     $data = trim($data);
        //     $data = stripslashes($data);
        //     $data = htmlspecialchars($data);

        //     return $data;
        // }
        // $uname = validate($_POST['uname']);
        // $pass = validate($_POST['password']);

        $location = $_POST['location'];
        $date = $_POST['date'];
        $persons = $_POST['persons'];
        $session = $_POST['session'];
        $time = $_POST['time'];

        if(empty($location)){
            header("Location: index.php?error=location is required");
            exit();
        }
        else if(empty($date)){
            header("Location: index.php?error=date is required");
            exit();
        }
        else if(empty($persons)){
            header("Location: index.php?error=persons is required");
            exit();
        }
        else if(empty($session)){
            header("Location: index.php?error=session is required");
            exit();
        }
        else if(empty($time)){
            header("Location: index.php?error=time is required");
            exit();
        }
        else{
            // $sql = "SELECT * FROM users WHERE user_name='$uname' AND password='$pass'";
            $sql = "INSERT INTO reserve VALUES(NULL, '$location', '$date', '$persons', '$session', '$time')";
            $result1 = mysqli_query($conn,$sql);
            
            $sql = "SELECT location, date, persons, session, time FROM reserve";
            $result = mysqli_query($conn,$sql);

            if(mysqli_num_rows($result)  > 0){
                $row = mysqli_fetch_assoc($result);

                // echo $location . " " . $date . " " . $persons . " " . $session . " " . $time . "<br>";
                
                ?>
                <div style="font-family: 'Gill Sans', 'Gill Sans MT', 'Calibri', 'Trebuchet MS', sans-serif;position: relative; background-color:#000;background-image: url(./bg2.jpg) ; background-position: center; background-repeat:no-repeat;margin: 0; padding: 0; align-items: center;"><br>
                    <div style="font-family: 'Gill Sans', 'Gill Sans MT', 'Calibri', 'Trebuchet MS', sans-serif; background: white; opacity: 0.8; border-radius: 20px; padding: 10px; margin-left: 50px; width: 41vh;">
                        <h2>Your Reservation Details:</h2>
                        <p><b>Location : <b><?php echo $location ?></p>
                        <p><b>Date : <b><?php echo $date ?></p>
                        <p><b>No. of Persons : <b><?php echo $persons ?></p>
                        <p><b>Session : <b><?php echo $session ?></p>
                        <p><b>Time : <b><?php echo $time ?></p>
                    </div>
                    <form action="logout_reserve.php" method="post">
                        <button type="submit" style="font-family: 'Gill Sans', 'Gill Sans MT', 'Calibri', 'Trebuchet MS', sans-serif; margin-top:-250px;margin-left: 79%; padding: 8px;border-radius: 20px;color: #fff;background: #FC4412; cursor: pointer; height: 45px;">Log out</button>
                    </form>
                    <div style="font-family: 'Gill Sans', 'Gill Sans MT', 'Calibri', 'Trebuchet MS', sans-serif; background: white; opacity: 0.8; border-radius: 20px; padding: 10px; margin-left: 650px; margin-top: -170px ; width: 100vh;">
                        <div style="font-family: 'Gill Sans', 'Gill Sans MT', 'Calibri', 'Trebuchet MS', sans-serif;text-align: center;">
                            <h2>Add your food to avoid waiting...</h2>
                            <form action="add.php" method="post">
                                <?php if(isset($_GET['mess']) && $_GET['mess'] == 'error'){ ?>
                                    <input type="textarea" name="title" placeholder="Enter Your Favourite Food" style=" border-color: #ff6666;font-family: 'Gill Sans', 'Gill Sans MT', 'Calibri', 'Trebuchet MS', sans-serif; width: 60%; font-size: 20px; padding:10px ; border-radius: 20px; color: #FC4412;">
                                    <button type="submit" style="font-family: 'Gill Sans', 'Gill Sans MT', 'Calibri', 'Trebuchet MS', sans-serif;padding: 8px;border-radius: 20px;color: #fff;background: #FC4412; cursor: pointer; height: 45px;">Add &nbsp; <span>&#43;</span></button>
                                <?php }else{ ?>
                                    <input type="textarea" name="title" placeholder="Enter Your Favourite Food" style="font-family: 'Gill Sans', 'Gill Sans MT', 'Calibri', 'Trebuchet MS', sans-serif; width: 60%; font-size: 20px; padding:10px ; border-radius: 20px; color: #FC4412;">
                                    <button type="submit" style="font-family: 'Gill Sans', 'Gill Sans MT', 'Calibri', 'Trebuchet MS', sans-serif;padding: 8px;border-radius: 20px;color: #fff;background: #FC4412; cursor: pointer; height: 45px;">Add &nbsp; <span>&#43;</span></button>
                                <?php } ?>
                            </form>
                        </div>
                    </div>
                    

                <?php 
                    $sql = "SELECT * FROM todos";
                    $todos = mysqli_query($conn,$sql);
                ?>

                    <div style="font-family: 'Gill Sans', 'Gill Sans MT', 'Calibri', 'Trebuchet MS', sans-serif; background: white; opacity: 0.9; border-radius: 20px;padding:0.002vh; margin-left:20%; margin-top:50px;width: 60%;">
                        <?php if(mysqli_num_rows($result) === 0){ ?>
                            <div style="background:rgb(197, 186, 186); width: 90%; margin:3%; padding: 3px;">
                                <div>
                                    <img src="./bg1.jpg" width="100%" />    
                                </div>
                            </div>
                        <?php } ?> 

                        <?php while($todo = mysqli_fetch_assoc($todos)) { ?>
                            <div style="background:rgb(197, 186, 186); border-radius:20px ;width: 87%; margin:3%; padding: 10px;padding-left:50px;">
                                <span id = "<?php echo $todo['id']; ?>" class="remove-to-do" style="float: right;margin-right:4px;border-radius:50%;cursor:pointer;" onMouseOver="this.style.color='rgb(139, 97, 93)'" onMouseOut="this.style.color='#000'">x</span>
                                <h2><?php echo $todo['title'] ?></h2> 
                            </div>
                        <?php } ?>
                    </div>
                </div>
                
                <script src="jquery-3.2.1.min.js"></script>

                <script>
                    $(document).ready(function(){
                        $('.remove-to-do').click(function(){
                            const id = $(this).attr('id');

                            $.post("remove.php",
                            {
                                id: id
                            },
                            (data) => {
                                if(data){
                                    $(this).parent().hide(600);
                                }
                            }
                            );
                        });
                    });
                </script>

                <?php
                
            }
            else{
                header("Location: index.php");
                exit();
            }
        }
    }
    else{
        header("Location: index.php");
        exit();
    }
?>