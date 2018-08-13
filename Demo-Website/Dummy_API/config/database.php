<?php
    class database{
        private $serverName="localhost";
        private $DB_userName="root";
        private $DB_userPassword="santosh1";
        private $databaseName="Dummy_API";
        private $connect;
        
        public function getConnectDB(){
            $this->connect=new mysqli($this->serverName,$this->DB_userName,$this->DB_userPassword,$this->databaseName);
            return $this->connect;
    }
}
?>