<?php
    session_start();
    if($_SESSION["UserName"]==""){
        header('Location:login.php');
        
    }else{
        $userName=$_SESSION["UserName"];
    }
    
    $serverName="localhost";
    $DB_userName="root";
    $DB_userPassword="santosh1";
    $databaseName="users";
    $connect=new mysqli($serverName,$DB_userName,$DB_userPassword,$databaseName);
    if($connect){
        addTaskInDB($connect,$userName);
    }else{
        echo "Database Error : ".$connect->error;
    }
    function addTaskInDB($connect,$userName){
        $taskTitle=filter_var($_POST['TaskTitle'],FILTER_SANITIZE_STRING);
        $taskDisc=filter_var($_POST['TaskDescription'],FILTER_SANITIZE_STRING);
        $taskDate=filter_var($_POST['TaskDate'],FILTER_SANITIZE_STRING);
        $sqlRequest="INSERT INTO task(userName,taskName,taskDescription,taskTime) VALUES('$userName','$taskTitle','$taskDisc','$taskDate')";
        if($connect->query($sqlRequest)){
            echo "Added Successfully ";
        }
        else{
            echo "Error: ".$connect->error;
        }
    }
?>