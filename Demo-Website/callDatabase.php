<?php
    function callMysql(){
        // Server and Database details or variable section
        $serverName="localhost";
        $DB_userName="root";
        $DB_userPassword="santosh1";
        $databaseName="users";
        $connect=new mysqli($serverName,$DB_userName,$DB_userPassword,$databaseName);
        //User details Section-->>> filtering all the data before process
        $userFirstName=filter_var($_POST['fname'],FILTER_SANITIZE_STRING);
        $userLastName=filter_var($_POST['lname'],FILTER_SANITIZE_STRING);
        $userGender=filter_var($_POST['gender'],FILTER_SANITIZE_STRING);
        $userLanguage=filter_var($_POST['language'],FILTER_SANITIZE_STRING);
        $userAddLine1=filter_var($_POST['addLine1'],FILTER_SANITIZE_STRING);
        $userAddline2=filter_var($_POST['addLine2'],FILTER_SANITIZE_STRING);
        $userPincode=filter_var($_POST['pincode'],FILTER_SANITIZE_STRING);
        $userCity=filter_var($_POST['city'],FILTER_SANITIZE_STRING);
        $userState=filter_var($_POST['state'],FILTER_SANITIZE_STRING);
        $userPhone=filter_var($_POST['phone'],FILTER_SANITIZE_STRING);
        $userEmail=filter_var($_POST['email'],FILTER_SANITIZE_STRING);
        $userUsrName=filter_var($_POST['usrName'],FILTER_SANITIZE_STRING);
        $userPass=filter_var($_POST['passWord'],FILTER_SANITIZE_STRING);
        // User Details exist or Not 
        $userValid=checkUserExist($connect,$userUsrName);
        $emailValid=checkEmailExist($connect,$userEmail);
        $phoneValid=checkPhoneExist($connect,$userPhone);
        //IF SERVER SIDE VALIDATION IS TRUE THEN WE WILL ADD USER DATA TO THE DATABASE
        if(!($userValid||$emailValid||$phoneValid)){
            addInDatabase($connect,$userFirstName,$userLastName,$userGender,$userLanguage,$userAddLine1,$userAddline2,$userPincode,$userCity,$userState,$userPhone,$userEmail,$userUsrName,$userPass);
            header('Location:login.php');
        }
    }
    //######################################################## Check if Uername Already exist or not ###########
    //  Return true if exist \\\\\\\return false if does not exist
    function checkUserExist($connect,$userUsrName){
        $sqlRequest="SELECT userName FROM user_details WHERE userName='$userUsrName'";
        if($connect->query($sqlRequest)){
            $result=$connect->query($sqlRequest);
            $row=$result->fetch_assoc();
            if($result->num_rows>0)
            {
                $GLOBALS['userNameErr']="Error: User Name Already Available Try With Another User Name ";
                return true;
            }
            else{
                
                return false;
            }
        }
        else{
            echo "Error : ".$connect->error;
        }
    }
    //################################################# CHECK PHONE NUMBER OF USER EXIST OR NOT ###################################################################################################################
    //rETURN TRUE ID EXIST ---RETURN FALSE IF DOES NOT EXIST
    function checkPhoneExist($connect,$userPhone){
        $sqlRequest="SELECT phone FROM user_details WHERE phone='$userPhone'";
        if($connect->query($sqlRequest)){
            $result=$connect->query($sqlRequest);
            if($result->num_rows>0){
                $GLOBALS['phoneErr']="Error : Phone Number Already Exist";
                return true;
            }
            else
            {
                return false;
            }
        }
        else{
            echo "Querry Error : ".$connect->error;
        }
    }
    //####################################################################### CHECK EMAIL EXIST OR NOT #####################################################################################################################
    //RETURN TRUE IF EXIST -----RETURN FALSE IF DOES NOT EXIST
    function checkEmailExist($connect,$userEmail){
        $sqlRequest="SELECT email FROM user_details WHERE email='$userEmail'";
        if($connect->query($sqlRequest)){
            $result=$connect->query($sqlRequest);
            if($result->num_rows>0){
                $GLOBALS['emailErr']="Error : Email Already Exist";
                return true;
            }
            else
            {
                return false;
            }
        }
        else{
            echo "Querry Error : ".$connect->error;
        }
    }
    /////#################################################################################### ADD DATA TO THE DATABASE AFTER VALIDATION #########################################################################################
    function addInDatabase($connect,$userFirstName,$userLastName,$userGender,$userLanguage,$userAddLine1,$userAddline2,$userPincode,$userCity,$userState,$userPhone,$userEmail,$userUsrName,$userPass){
        $sqlRequest="INSERT INTO user_details(userName,firstName,lastName,gender,languages,addressLine1,addressLine2,pincode,city,state,phone,email,pass) VALUES('$userUsrName','$userFirstName','$userLastName','$userGender','$userLanguage','$userAddLine1','$userAddline2','$userPincode','$userCity','$userState','$userPhone','$userEmail','$userPass')";
        if($connect->query($sqlRequest)){
            echo "Created Successully";
        }
        else
        {
            echo"Error : ".$connect->error;
        }
    }
?>