<?php

    if(isset($_POST['id'])){
        require './db_conn1.php';

        $id = $_POST['id'];

        if(empty($id)){
            echo 0;
        }
        else{
            $stmt = $conn->prepare("DELETE FROM todos");
            $res = $stmt->execute([$id]);

            if($res){
                echo 1;
            }
            else{
                echo 0;
            }
            // $conn=null;
            // exit();
        }
    }
    // else{
    //     header("Location: reserve.php?mess=error");
    // }

    session_start();
    session_unset();
    session_destroy();

    header("Location: login.php");
?>