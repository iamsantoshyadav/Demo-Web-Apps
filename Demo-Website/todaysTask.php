<?php
    session_start();
    if($_SESSION["UserName"]==""){
        header('Location:login.php');
        
    }else{
        $userName=$_SESSION["UserName"];
    }
    
    //session_abort();
    $firstName=$lastName="";
    $serverName="localhost";
    $DB_userName="root";
    $DB_userPassword="santosh1";
    $databaseName="users";
    $connect=new mysqli($serverName,$DB_userName,$DB_userPassword,$databaseName);
    if($connect){
        showData($connect,$userName);
    }
    else{
        echo "Error : ".$connect->error;
    }
    
    function showData($connect,$userName){
        global $firstName,$lastName;
        $sqlRequest="SELECT firstName,lastName FROM user_details WHERE userName='$userName'";
        if($connect->query($sqlRequest)){
            $result=$connect->query($sqlRequest);
            if($result->num_rows>1){
                echo "Somthing gona wrong with the database";
            }else{
                $row=$result->fetch_assoc();
                $firstName=$row['firstName'];
                $lastName=$row['lastName'];
            }
        }
        else{
            echo "Database Error : ".$connect->error;
        }
    }

?>
<!DOCOTYPE html>
<html>
    <head>
        <title>Registration Page Using PHP and Mysql</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!--###################################### ALL CSS STYLES ARE HERE #################################################################################-->
        
        <style>
            
            .header,.header span{width: 100vw;
            margin: 0;
            height: 8vh;
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
            font-size: 4vh;
            color: grey;
            background-color: #ffffff;
            padding-top: 2vh;
            padding-bottom: 2vh;
            }
            
            .footer{
                width: 100vw;
                height: 8vh;
                position: relative;
                font-family: Arial, Helvetica, sans-serif;
                text-align: left;
                font-size: 2vh;
                color: grey;
                background-color: #ffffff;
                padding-left: 2vw;
                float: left;    
            }
            .navBar{width: 100vw;
                height: 3.5vh;
                overflow: hidden;
                background-color: #333;
                border: 2px solid #333;
                border-radius: 10px;
            }
            .navBar a span,.navBar div{float: left;
                font-size: 2vh;
                color: white;
                padding: 0.5vh 0.5vh;
                margin-left: 1vw;
                display: inline;
            }
            
            .content{width: 80vw;
                height : 80vh;
                margin-top: 1vh;
                margin-bottom: 1vh;
                float: right;  
                text-align:center;      
            }
            .container{width: 15vw;
                height: 80vh;
                margin-top: 1vh;
                margin-bottom: 1vh;
                margin-left: 1vh;
                float: left;
                clear: left;
                background-color: #f1f1f1;
                border: 2px solid #f1f1f1;
                border-radius: 10px;
            }
            .container a {background-color: #f78247;
                color: white;
                text-decoration: none;
                font-size: 2vh;
                font-family: Arial, Helvetica, sans-serif;
                display: block;
                margin-top: 0.3vh;
                border: 2px solid #333;
                border-radius: 10px;
                padding: 0.5vw 0.5vh;
            }
            .container a:hover{background-color: darkolivegreen;
            }
            .active{background-color: lightcoral;
                height: 2vh;
                border: 2px solid lightcoral;
                border-radius: 10px;
            }
            .left{
                float: left;
                width: 37vw;
                height: 85vh;
                margin-left: 2vw;
                margin-bottom: 1vh;
            }
            .right{
                
                width: 37vw;
                height: 85vh;
                float: right;
                margin-right: 2vw;
                margin-bottom: 1vh;
            }
            .formContainer{
                width: 10vw;
                height: 80vh;
                display: inline;
                text-align: left;
                padding-left: 1%;
                font-family: Arial, Helvetica, sans-serif;
                font-size: 2.5vh;
                color: #333;
            }
            .element{margin-top: 2  vh;
            }
            .inputTitle{color: grey;
                font-family: Arial, Helvetica, sans-serif;
                font-size: 2vh;
                float: left;http://localhost/Demo-Website/to-do-lists.php
                margin-left: 1vw;
                margin-top: 1vh;
                color: #333;
            }
            .require{font-family: Arial, Helvetica, sans-serif;
                font-size: 2vh;
                color: red;
            }
            .errmessage{color: red;
                font-size: 1.5vh;
                height: 2vh;
                margin-left: 3vw;
                }
            input[type=text],input[type=password]{
                width: 20vw;
                height: 3vh;
                border: none;
                border-bottom: 2px solid grey;
                background-color: #f1f1f1;
                transition: width 2s;
                -webkit-transition: width 2s; /* Safari 3.1 to 6.0 */

            }
            input[type=text]:focus,input[type=password]:focus{
                border-bottom:2px solid #f78247;
                
            }
            .login{width: 30vw;
                height: 50vh;http://localhost/Demo-Website/to-do-lists.php
                background-color: #f1f1f1;
                margin-left: 25vw;
                margin-top: 15vh;
                font-size: 2vh;
                font-family: Arial, Helvetica, sans-serif;
                -webkit-box-shadow: 9px 14px 36px 5px rgba(0,0,0,0.75);
                -moz-box-shadow: 9px 14px 36px 5px rgba(0,0,0,0.75);
                box-shadow: 9px 14px 36px 5px rgba(0,0,0,0.75);
                color: grey;
                text-align: left;
            }
            input[type=submit]{
                font-family: Arial, Helvetica, sans-serif;
                font-size: 2vh;
                width: 5vw;
                height: 4vh;
                margin-left: 12.5vw;
            }

        </style>
    </head>
    <body>
        <div class="header">Welcome <span style="color: lightcoral;padding: 0;"><?php echo $firstName." ".$lastName."."; ?></span></div>
        <div class="navBar">
            <a href="#nothing"><span><i class="fa fa-home"></i> Home</span></a> 
            <a href="#nothing"><span>My Assignments <i class="fa fa-caret-down"></i></span></i></a>
            <a href="#nothing"><span>Resources <i class="fa fa-leanpub"></i></span></a>
            <a href="#nothing"><span style="float: right;margin-right: 1vw"><?php echo $firstName." ".$lastName; ?></span> </a>
            <a href="http://localhost/Demo-Website/todaysTask.php"><span style="float: right;margin-right: 1vw"class="active">Today's Tasks</span> </a> 
        </div>

        <div class="container">
            <a href="#nothing">DUMYY Elements</a>
            <a href="">First Element</a>
            <a href="">Second Element</a>
            <a href="">Third Element</a>
            <a href="">Fourth Element</a>
            <a href="">Fifth Element</a>
            <a href="">Sixth Element</a>
            <a href="">Seventh Element</a>
            <a href="">Eight Element</a>
            <a href="">Ninth Element</a>
            <a href="">Dummy</a>
            <a href="">Eleventh Element</a>
            <a href="">Twelth Element</a>
            <a href="">Thirteenth Element</a>
            <a href="">Fifteenth Element</a>
        </div>
        <div class="content">
            <iframe src="http://localhost/Demo-Website/to-do-lists.php"width="100%"height="100%"style="border: none;border-radius: 5px;"></iframe> 
            
        </div>
        <!--Footer Section-->
        <div class="footer"><span style="color: lightcoral;font-size: 2vh;">Contect </span><span style="font-size: 2vh;">Details</span><br>
            <div style="font-size: 1.5vh;padding-left: 1.5vw;">Name : Santosh Yadav <br>
            Email Id : santosh@readybytes.in <br>
            Phone no : 8560870589 <br>
            </div>
        </div>
        <?php session_abort();?>
    </body>
</html>