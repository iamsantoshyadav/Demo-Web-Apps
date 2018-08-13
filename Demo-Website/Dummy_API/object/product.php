<?php
include_once '../config/database.php';
    class product{
        private $connect;
        private $table_name="products";
        //table content this veriables we'll going to use for make changes in the databases
        public $id;
        public $name;
        public $description;
        public $price;
        public $category_id;
        public $created;
        public $modified;

        public function __construct($connectDB){
            $this->connect=$connectDB;
        }
        //function for read the data from the database
        function read(){
            $sqlQuery="SELECT * FROM products";
            if($this->connect->query($sqlQuery)){
                $results=$this->connect->query($sqlQuery);
            return $results;
            }
            else{
                echo "Query Request Error : ".$this->connect->error;
                exit();
            }
        }
        //function for create the new database using create.php
        function create(){
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->price=htmlspecialchars(strip_tags($this->price));
            $this->description=htmlspecialchars(strip_tags($this->description));
            $this->category_id=htmlspecialchars(strip_tags($this->category_id));
            $this->created=htmlspecialchars(strip_tags($this->created));
            $sqlQuery="INSERT INTO `$this->table_name`(name,description,price,category_id,created) VALUES ('$this->name','$this->description','$this->price','$this->category_id','$this->created')";
            if($this->connect->query($sqlQuery)){
                return true;
            }else{
                return false;
            }
        }
        //function for read once by id of the product
        function read_one(){
            $sqlQuerry= "SELECT * FROM `$this->table_name` WHERE id='$this->id'";
            if($this->connect->query($sqlQuerry)){
                $results=$this->connect->query($sqlQuerry);
                if($results->num_rows>0){
                    $row=$results->fetch_assoc();
                    extract($row);
                    $this->name=$name;
                    $this->description=$description;
                    $this->price=$price;
                    $this->category_id=$category_id;
                    
                }else{
                    $error=array(
                        "message"=>"No any data found with this id"
                    );
                    echo json_encode($error);
                    exit();
                    
                }
            }else{
                $querryError =array(
                    "Error"=>$this->connect->error
                );
                echo json_encode($querryError);
                exit();
            }
        }
        //function for update the database using
        function update(){
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->price=htmlspecialchars(strip_tags($this->price));
            $this->description=htmlspecialchars(strip_tags($this->description));
            $this->category_id=htmlspecialchars(strip_tags($this->category_id));
            $this->modified=htmlspecialchars(strip_tags($this->modified));
            $sqlQuerry="SELECT * FROM $this->table_name WHERE id ='$this->id'";
            if($this->connect->query($sqlQuerry)){
                $results=$this->connect->query($sqlQuerry);
                if($results->num_rows==0){
                    return false;
                }else{
                        $sqlQuerry="UPDATE $this->table_name SET name='$this->name',price='$this->price',description='$this->description',category_id='$this->category_id',modified='$this->modified' WHERE id='$this->id'";
                        if($this->connect->query($sqlQuerry)){
                            return true;
                        }else{
                            return false;
                        }
                }
            }else{
                echo '{';
                    echo '"Error": "Somthing is wrong."';
                echo '}';
            }   
        }
        function delete(){
            //check that id exist or not
            $sqlQuerry="SELECT * FROM $this->table_name WHERE id ='$this->id'";
            if($this->connect->query($sqlQuerry)){
                $results=$this->connect->query($sqlQuerry);
                if($results->num_rows==0){
                    echo '{';
                        echo '"Error": "Id not found"';
                    echo '}';
                    exit();
                }else{
                    $sqlQuerry="DELETE FROM $this->table_name WHERE id='$this->id'";
                    if($this->connect->query($sqlQuerry)){
                        return true;
                    }else{
                        return false;
                    }

                }
        }

    }
}
?>