<?php
    include "callDatabase.php";
    $fnameErr=$lnameErr=$genderErr=$langError=$addressErr=$pincodeErr=$stateErr=$emailErr=$userNameErr=$passErr=$cnfPassErr=$cityErr=$phoneErr=$address2Err="";
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $fname=validateFname();
        $lname= validateLname();
        $gender=validateGender();
        $language=validateLanguage();
        $addLine1=validateAddLine1();
        $addLine2=validateAddLine2();
        $pincode=validatePincode();
        $state=validateState();
        $email=validateEmail();
        $username=validateUsername()." ";
        $password=validatePassword();
        $city=validateCity();
        $phone=validatePhone();
        if($fname&&$lname&&$gender&&$language&&$addLine1&&$pincode&&$state&&$state&&$email&&$username&&$password&&$city&&$phone){
            callMysql();
            //header('Location:regibackup.php');
        }
        else{
            //echo "Wrong";
        }
    }
    function validateFname(){
        global $fnameErr;
        if(empty(filter_var($_POST['fname'],FILTER_SANITIZE_STRING))){
            $fnameErr="Error : Please Enter Your First Name.";
            return false;
        }
        elseif(preg_match('#[^a-zA-Z]#',filter_var($_POST['fname'],FILTER_SANITIZE_STRING))){
            $fnameErr="Error : Please Enter a Valid First Name.";
            return false;
        }
        return true;
    }
    function validateLname(){
        global $lnameErr;
        if(empty(filter_var($_POST['lname'],FILTER_SANITIZE_STRING))){
            $lnameErr="Error : Please Enter Your Last Name";
            return false;
        }
        elseif(preg_match('#[^a-zA-Z]#',filter_var($_POST['lname'],FILTER_SANITIZE_STRING))){
            $lnameErr="Error : Please Enter a Valid Last Name";
            return false;
        }
        return true;
    }
    function validateGender(){
        global $genderErr;
        if(empty($_POST['gender'])){
            $genderErr="Error : Please Select Any One";
            return false;
        }
        return true;
    }
    function validateLanguage(){
        global $langError;
        if($_POST['language']=="none"){
            $langError="Error : Please Select Any One Language";
            return false;
        }
        return true;
    }
    function validateAddLine1(){
        global $addressErr;
        if(empty($_POST['addLine1'])||preg_match('#[^a-zA-Z0-9 ]#',$_POST['addLine1'])||strlen($_POST['addLine1'])<5){
            $addressErr="Error : Please Enter a Valid Address";
            return false;
        }
        return true ;
    }
    function validateAddLine2(){
        global $address2Err;
        if(!empty($_POST['addLine2'])){
            if(preg_match('#[^a-zA-Z0-9 ]#',$_POST['addLine1'])||strlen($_POST['addLine1'])<5){
                $address2Err="Error : Enter an Valid Address";
                return false;
            }
            return true;
        }
    }
    function validatePincode(){
        global $pincodeErr;
        if(empty($_POST['pincode'])||preg_match('#[^0-9]#',$_POST['pincode'])||strlen($_POST['pincode'])<6){
            $pincodeErr="Error : Please Enter a Valid Pincode";
            return false;
        }
        return true;
    }
    function validateState(){
        global $stateErr;
        if(empty($_POST['state'])||preg_match('#[^a-zA-Z]#',$_POST['state'])||strlen($_POST['state'])<3){
            $stateErr="Error : Enter a Valid State";
            return false;
        }
        return true;
    }
    function validateEmail(){
        global $emailErr;
        if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
            $emailErr="Error : Enter a valid email id";
            return false;
        }
        return true;
    }
    function validateUsername(){
        global $userNameErr;
        if(empty($_POST['usrName'])||preg_match('#[^a-zA-Z0-9]#', $_POST['usrName'])||is_numeric($_POST['usrName'])||strlen($_POST['usrName'])<3){
            $userNameErr="Error : Please Enter a valid User Name";
            return false;
        }
        return true;
    }    
    function validatePassword(){
        global $passErr,$cnfPassErr;
        if(!preg_match('#[^a-zA-Z0-9]#',$_POST['passWord'])||!strlen($_POST['passWord']<6)){
            $passErr="Length must be greater then 6 and should contain at lest one cherecter and one special cherecter";
            return false;
        }
        elseif($_POST['passWord']!=$_POST['cnfPassword']||empty($_POST['cnfPassword'])){
            $cnfPassErr="Error : Entered Password Does Not Matched";
            return false;
        }
        return true;
    }
    function validateCity(){
        global $cityErr;
        if(empty($_POST['city'])||preg_match('#[^a-zA-z]#',$_POST['city'])||strlen($_POST['city'])<3){
            $cityErr="Error : Please Enter a Valid city Name";
            return false;
        }
        return true;
    }
    function validatePhone(){
        global $phoneErr;
        if(empty($_POST['phone'])||preg_match('#[^0-9]#',$_POST['phone'])||strlen($_POST['phone'])!=10){
            $phoneErr="Error: Enter a Valid Ten Digit Phone Number ";
            return false;
        }
        return true;
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
            .dropdown{  
                width: 100px;
                height: 200px;
            }
            .dropdownContent{
                display: hidden;
                width: 10vw;
                background-color: #f1f1f1;
                color: grey;
            }
            .content{width: 80vw;
                height : 100vh;
                border: 2px solid #f1f1f1;
                border-radius: 10px;
                margin-top: 1vh;
                margin-bottom: 1vh;
                float: right;
                background-color: #f1f1f1;  
                text-align:center;      
            }
            .container{width: 15vw;
                height: 100vh;
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
            .container a:hover{background-color: darkolivegreen;}
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
            .element{margin-top: 2  vh;}
            .inputTitle{color: grey;
                font-family: Arial, Helvetica, sans-serif;
                font-size: 2vh;
                float: left;
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
                height: 3vh;
                margin-left: 0.5vw;
                }
            input[type=text]{
                width: 20vw;
                height: 3vh;
            }


        </style>
    </head>
    <body>
        <div class="header">Registration Form Using <span style="color: lightcoral;padding: 0;">PHP</span> And <span style="color: lightcoral;padding: 0;">Mysql</span></div>
        <div class="navBar">
            <a href="#nothing"><span><i class="fa fa-home"></i> Home</span></a> 
            <a href="#nothing"><span>My Assignments <i class="fa fa-caret-down"></i></span></i></a>
            <a href="#nothing"><span>Resources <i class="fa fa-leanpub"></i></span></a>
            <a href="http://localhost/Demo-Website/login.php"><span style="float: right;margin-right: 1vw"> Log In</span> </a> 
            <a href="#nothing"><span style="float: right;" class="active"><i class="fa fa-user-plus"> Register</i></span></a>
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
            <h1>Registration Form</h1>
            <!--################################################ Form Section ###################################################################################################################-->
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <div class="left">
                    <div class="formContainer"style="float: left;width: 13vw;">
                        First Name<span class="require">*</span><br><br><br>
                        Gender<span class="require">*</span><br><br><br>
                        Address Line 1<span class="require">*</span><br><div class="errmessage"><?php echo""; ?></div><br>
                        Address Line 2<br><div class="errmessage"><?php echo""; ?></div><br>
                        Pincode<span class="require">*</span><br><div class="errmessage"><?php echo""; ?></div><br>
                        State<span class="require">*</span><br><div class="errmessage"><?php echo""; ?></div><br>
                        Email<span class="require">*</span><br><div class="errmessage"><?php echo""; ?></div><br>
                        User Name<span class="require">*</span><br><div class="errmessage"><?php echo""; ?></div><br>
                        Password<span class="require">*</span><br><div class="errmessage"><?php echo""; ?></div><br>
                    </div>
                    <div class="formContainer"style="float: right;width: 22vw;">
                        <input type="text" name="fname" id="fname"placeholder="Enter your First Name"<?php echo "value=".htmlspecialchars($_POST['fname']);?>><br><div class="errmessage"><?php echo"$fnameErr"; ?></div><br>
                        <span>Male</span> <input style="margin-right: 2vw;" type="radio" name="gender" id="gender" value="Male">
                        <span>Female</span><input style="margin-right: 2vw;"type="radio" name="gender" id="gender" value="Female">
                        <span>Other</span><input style="margin-right: 2vw;"type="radio" name="gender" id="gender"value="Other"><br><div class="errmessage"><?php echo"$genderErr"; ?></div><br>
                        <input type="text" name="addLine1" id="addLine1" placeholder="Enter your Address"<?php echo "value=".htmlspecialchars($_POST['addLine1']);?>><br><div class="errmessage"><?php echo"$addressErr"; ?></div><br>
                        <input type="text" name="addLine2" id="addLine2"placeholder="(Optional)"<?php echo "value=".htmlspecialchars($_POST['addLine2']);?>><br><div class="errmessage"><?php echo"$address2Err"; ?></div><br>
                        <input type="text" name="pincode" id="pincode" placeholder="Your city pincode"<?php echo "value=".htmlspecialchars($_POST['pincode']);?>><br><div class="errmessage"><?php echo"$pincodeErr"; ?></div><br>
                        <input type="text" name="state" id="state" placeholder="Your State"<?php echo "value=".htmlspecialchars($_POST['state']);?>><br><div class="errmessage"><?php echo"$stateErr"; ?></div><br>
                        <input type="text" name="email" id="email" placeholder="Exa: usrname@example.com"<?php echo "value=".htmlspecialchars($_POST['email']);?>><br><div class="errmessage"><?php echo"$emailErr"; ?></div><br>
                        <input type="text" name="usrName" id="usrName" placeholder="Enter a Unique User Name"<?php echo "value=".htmlspecialchars($_POST['usrName']);?>><br><div class="errmessage"><?php echo"$userNameErr"; ?></div><br>
                        <input style="width: 10vw"type="password" name="passWord" id="passWord" placeholder="Enter Strong Password"><br><div class="errmessage"><?php echo"$passErr"; ?></div>
                    </div>
                </div>
                <div class="right">
                    <div class="formContainer"style="float: left;width: 13vw;">
                        Last Name<span class="require">*</span><br><br><br>
                        Language<span class="require">*</span><br><div class="errmessage"><?php echo""; ?></div><br><br><br><br><br><br><br>
                        District<span class="require">*</span><br><div class="errmessage"><?php echo""; ?></div><br>
                        Phone<span class="require">*</span><br><div class="errmessage"><?php echo""; ?></div><br><br><br><br><br><br><br>
                        Confirm Password<span class="require">*</span><br><div class="errmessage"><?php echo""; ?></div><br>
                    </div>
                    <div class="formContainer"style="float: right;width: 22vw;">
                        <input type="text" name="lname" id="lname" placeholder="Enter Your Last Name"<?php echo "value=".htmlspecialchars($_POST['lname']);?>><br><div class="errmessage"><?php echo"$lnameErr"; ?></div><br>
                        <select name="language" id="lang">
                            <option value="none">(Not Selected)</option>
                            <option value="hindi">Hindi</option>
                            <option value="eng">English</option>
                            <option value="marathi">Marathi</option>
                            <option value="marwari">Marwari</option>
                            <option value="gujrati">Gujrati</option>
                        </select><br><div class="errmessage"><?php echo"$langError"; ?></div><br><br><br><br><br><br><br>
                        <input type="text" name="city" id="city" placeholder="Enter Your City Name"<?php echo "value=".htmlspecialchars($_POST['city']);?>><br><div class="errmessage"><?php echo"$cityErr"; ?></div><br>
                        <input type="text" name="phone" id="phone" placeholder="Enter Your Phone Number"<?php echo "value=".htmlspecialchars($_POST['phone']);?>><br><div class="errmessage"><?php echo"$phoneErr"; ?></div><br><br><br><br><br><br><br>
                        <input style="width: 10vw" type="password" name="cnfPassword" id="cnfPassword" placeholder="Confirm Your Password"><div class="errmessage"><?php echo"$cnfPassErr"; ?></div>
                    </div>
                </div>
                <input style="height: 4vh;width: 7vw;"type="submit"value="Submit Form">  
            </form>
        </div>
        <!--Footer Section-->
        <div class="footer"><span style="color: lightcoral;font-size: 2vh;">Contect </span><span style="font-size: 2vh;">Details</span><br>
            <div style="font-size: 1.5vh;padding-left: 1.5vw;">Name : Santosh Yadav <br>
            Email Id : santosh@readybytes.in <br>
            Phone no : 8560870589 <br>
            </div>
        </div>
        <div style="padding-bottom: 2000px;"></div>
    </body>
</html><div class="errmessage"><?php echo"$passErr"; ?></div>