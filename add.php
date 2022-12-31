<?php
    if(isset($_POST['title'])){
        require './db_conn1.php';

        $title = $_POST['title'];

        if(empty($title)){
            header("Location: ./reserve.php?mess=error");
        }
        else{
            $stmt = $conn->prepare("INSERT INTO todos(title) VALUE(?)");
            $res = $stmt->execute([$title]);

            if($res){
                header("Location: ./reserve.php?mess=success");
            }
            else{
                header("Location: ./reserve.php");
            }
            $conn=null;
            exit();
        }
    }
    else{
        header("Location: ./reserve.php?mess=error");
    }
?>