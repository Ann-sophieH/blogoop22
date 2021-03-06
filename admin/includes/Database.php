<?php
    require_once("config.php");
    class Database{
        /** class properties **/
        public $connection;
        /** class methods **/
        public function open_db_connection(){
          $this->connection = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
          if(mysqli_connect_errno()){
              printf("Connectie mislukt: %s\n",mysqli_connect_errno());
              exit();
          }
        }
        public function query($sql){
            $result = $this->connection->query($sql);
            $this->confirm_query($result);
            return $result;
        }
        private function confirm_query($result){
            if(!$result){
                die("Query kan niet worden uitgevoerd " . $this->connection->error);
            }
        }
        public function escape_string($string){
            $escaped_string = $this->connection->real_escape_string($string);
            return $escaped_string;
        }
        public function the_insert_id(){
            return mysqli_insert_id($this->connection);
        }

        function __construct(){
            $this->open_db_connection();
        }
    }
    $database = new Database();
?>
