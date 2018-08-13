<?php
class task{
   private $connect;
   public $table_name="task";
   //columns in the database
   public  $taskId;
   public $userName;
   public $taskName;
   public $taskDescription;
   public $taskTime;

   function __construct($connectDB){
       $this->connect=$connectDB;
   }
//read method for reading the task --------read the task by userName
   function readTask(){
       $sqlQuery="SELECT * FROM `$this->table_name` WHERE userName='$this->userName'";
       if($this->connect->query($sqlQuery)){
           $results=$this->connect->query($sqlQuery);
           return $results;
       }else{
        echo '{';
            echo '"Error": "Query request is not successfull"';
        echo '}';
       }
   }
//create the task by its user name 
function create_task(){
    $sqlQuery ="INSERT INTO `$this->table_name`(userName,taskName,taskDescription,taskTime) VALUES ('$this->userName','$this->taskName','$this->taskDescription','$this->taskTime')" ;
    if($this->connect->query($sqlQuery)){
       return true;

    }else{
        return false;
    }
}

}
?>