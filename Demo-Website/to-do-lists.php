<?php
    session_start();
    $allTask="";
    $taskErr="";
    //################################################################################ Showing the Task From the databese ###############################################################################################
    if($_SESSION["UserName"]==""){
        header('Location:login.php');
        
    }else{
        $userName=$_SESSION["UserName"];
    }
    if($userName!=""){
        $allTask=showTasks($userName);

    }else{
        echo "Error : somthing with user name";
    }
    //Show all the Available Task 
    function showTasks($userName){
        $tasks="";
        $serverName="localhost";
        $DB_userName="root";
        $DB_userPassword="santosh1";
        $databaseName="users";
        $date=date("Y/m/d");
        $connect=new mysqli($serverName,$DB_userName,$DB_userPassword,$databaseName);
        $sqlRequest="SELECT userName,taskName,taskDescription,taskTime FROM task WHERE userName='$userName' AND taskTime='$date'";
        if($connect){
            if($connect->query($sqlRequest)){
                $taskNu=1;
                $result=$connect->query($sqlRequest);
                while($row=$result->fetch_assoc()){
                    $tasks=$tasks."<span class='text'>".$taskNu.". ".$row['taskName']."<i class='fa fa-check'style='float: right;margin-right: 1vw;'></i><i class='fa fa-info-circle'style='float: right;margin-right: 1vw;'></i><br></span><span class='description'style='border-bottom: none;padding-left: 2vw;margin-top: 1vh;display: none;color: yellow;'>".$row['taskDescription']."</span><br><br>";
                    $taskNu++;
                }
                return $tasks;
           }else{
               echo "Error : ".$connect->error;
           }
        }
        else{
            echo "Error : ".$connect->error;
        }
    }
?>
<!DOCOTYPE html>
<html>
    <head>
        <title>This an example of to-do application</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script>
            $(document).ready(function(){
                //For all input sections
                $(".input").focus(function(){
                    $(this).animate({width: '90%'});
                });
                //for nevigations bar
                $(".todoes").mouseup(function(){
                    $(this).css("opacity","1");
                    $(".addlist").css('opacity','0.1');
                    $(".container1").slideDown(1000);
                    $(".container2").css('display','none');
                   // $(".container2").slideUp(300);
                });
                $(".addlist").click(function(){
                    $(this).css("opacity","1");
                    $(".todoes").css('opacity','0.1');
                    $(".container2").slideDown(1000);
                    $(".container1").css('display','none');
                    //$(".container1").slideUp(300);  
                });
                // For task complete
                $(".fa-check").click(function(){
                    $(this).parent().css('text-decoration','line-through');
        
                });
                $(".fa-info-circle").click(function(){
                    $(".description").fadeToggle();
                });
                $(".buttonSub").click(function(){
                    var taskTitle=$('#TaskTitle').val();
                    var taskDisc=$('#TaskDescription').val();
                    var taskDate=$('#TaskDate').val();
                    if(taskTitle==""||taskDisc==""||taskDate==""){
                        alert("Please Fill all the field")
                    }else{
                        $.ajax({
                           type: 'POST',
                            url: 'addTask.php',
                           data: $("form").serialize(),
                            success: function(response){
                                alert(response);
                             }
                        });

                    }
                });

            });
        </script>
        <style>
            body{
                margin: 0;
                padding: 0;
            }
            .backGround{
                background: url('image/back6.jpeg');
                height: 100vh;
                width: 100vw;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                padding: 0;
                margin: 0;
                opacity: 1;
            }
            .container,.container2{
                width: 45vw;
                height: 80vh;
                background: rgba(0, 0, 0, 0.2);
                box-sizing: border-box;
                box-shadow: 0 2px 6px 1px rgba(0, 0, 0, .5), inset 0 0 150px 50px rgba(0, 0, 0, 1);
                border-radius: 3px;
                margin-left: 27.5vw;
                margin-top: 10vh;
                display: none;
                position: fixed;
                top: 0.3vh;
               
            }
            .container1{
                width: 45vw;
                height: 80vh;
                background: rgba(0, 0, 0, 0.2);
                box-sizing: border-box;
                box-shadow: 0 2px 6px 1px rgba(0, 0, 0, .5), inset 0 0 150px 50px rgba(0, 0, 0, 1);
                border-radius: 3px;
                margin-left: 27.5vw;
                margin-top: 10vh;
                position: fixed;
                top: 0.3vh;
               
            }
            .container1:hover,.container2:hover{
                cursor: move;
                background: rgba(0, 0, 0, .4);
            }
            .neviBar{
                width: 50vw;
                height: 5vh;
                margin-left: 27.5vw;
                position: fixed;
                top: 5vh;public 
            }
            .neviBar span{
                float: left;
                width: 22.3vw;
                height: 4.8vh;
                border: 2px solid rgba(0, 0, 0, .2);
                border-radius: 3px;
                margin-top: 0;
                text-align: center;
                font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
                font-size: 3vh;
                color: white;
                letter-spacing: .05em;
                text-transform: uppercase;
                background: rgba(0, 0, 0, 0.2);
                box-shadow: 0 2px 6px 1px rgba(0, 0, 0, .2), inset 0 0 150px 1px rgba(0, 0, 0, 0.8);
            }
            .notes,.Title{
                width: 97.5%;
                height: 5%;
                margin-top: 3vh;
                font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
                font-size: 3vh;
                color: white;
                letter-spacing: .05em;
                padding-left: 1vw;
            }
            .text{
                border-bottom: 2px solid red;
            }
            .text span{
                border: none;
            }
            .input{
                background: none;
                width: 10vw;
                height: 4vh;
                color: aliceblue;
                border: none;
                border-bottom: 2px solid darkgoldenrod;
                font-size: 3vh;
            }
            .buttonSub{
                float:right;
                margin-right: 10%;
                width: 9vw;
                height: 5vh;
                color: white;
                border-radius: 5px;
                background-color: rgba(0, 0, 0, 0.8);
                padding-top: 0.5vh;
                padding-left: 0.5vh;
                border: 2px solid darkgoldenrod;
                opacity: 0.6;
            }
            .buttonSub:hover{
                opacity: 1;
            }
            .fa-check:hover{
	            width:50px;
	            height:50px;
	            border-radius: 5px;;
                opacity:0.3;
        }
        </style>
    </head>
    <body>
        <div class="backGround">
            <div class="neviBar" ><span class="todoes">To-Does</span><span class="addlist">Add List</span></div>
            <div class="container1">
                <div class="Title"style="text-align: center;padding; 0;"><span>THESE TASKS ARE PENDING TODAY</span></div>
                <div class="notes"><?php echo $allTask?></div>
            </div>
            <div class="container2">
                <div class="notes">
                    <form action="" method="POST">
                           <span>Task Title</span><br><br><input class="input" type="text" name="TaskTitle"id="TaskTitle"placeholder="Enter your task title"><br><br>
                           <span>Description</span><br><br><input class="input"type="text" name="TaskDescription"id="TaskDescription" placeholder="Short Description about this task"><br><br>
                           <span>Task Date</span><br><br><input class="input"type="date" name="TaskDate"id="TaskDate"><br><div><?php echo $taskErr;?></div><br>
        </form>
                           <div class="buttonSub"name="add">Add to List</div>
                </div>
            </div>
        </div>
        
    </body>
</html>