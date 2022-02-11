<?php
    class Db_object{
        /*** METHODS ***/
        /**QUERY**/
        public static function find_this_query($sql){
            global $database;
            $result = $database->query($sql);
            $the_object_array = array();
            while($row = mysqli_fetch_array($result)){
                $the_object_array[] = static::instantie($row);
            }
            return $the_object_array;
        }
        public static function find_all(){
            return static::find_this_query("SELECT * FROM " . static::$db_table . " ");
        }
        public static function find_by_id($id){
            $result = static::find_this_query("SELECT * FROM ". static::$db_table." WHERE id=$id");
            return !empty($result) ? array_shift($result) : false;

            /* return static::find_this_query("SELECT * FROM users WHERE id=$user_id");*/
        }
        /**CLASS**/
        private function has_the_attribute($the_attribute){
            $object_properties = get_object_vars($this);
            return array_key_exists($the_attribute, $object_properties);
        }
        /**STATIC LATE BINDING
        Zorgt ervoor dat static methodes in overerving kunnen worden gebruikt.
         **/
        public static function instantie($result){
            $calling_class = get_called_class(); //static late binding (overervingproblematiek
            //wanneer je static late binding gebruikt.
            $the_object = new $calling_class;
            foreach($result as $the_attribute => $value){
                if($the_object->has_the_attribute($the_attribute)){
                    $the_object->$the_attribute = $value;
                }
            }
            return $the_object;
        }
        /**CRUD**/
        public function create(){
            global $database;
            $properties = $this->clean_properties();
            $sql = "INSERT INTO ". static::$db_table . " (" .implode(",",array_keys($properties)). ")";
            $sql .= " VALUES ('" . implode("','", array_values($properties)) . "')";

            if($database->query($sql)){
                $this->id = $database->the_insert_id();
                return true;
            }else{
                return false;
            }
            $database->query($sql);

        }
        public function update(){
            global $database;
            $properties = $this->clean_properties();
            $properties_assoc = array();
            foreach($properties as $key => $value){
                $properties_assoc[] = "{$key}='{$value}'";
            }
            $sql = "UPDATE ". static::$db_table ." SET ";
            $sql .= implode(", ",$properties_assoc);
            $sql .= " WHERE id= " . $database->escape_string($this->id);
            // var_dump($sql);
            $database->query($sql);
            return mysqli_affected_rows($database->connection) == 1 ? true : false;

        }
        public function delete(){
            global $database;
            $sql = "DELETE FROM ". static::$db_table . " ";
            $sql .= "WHERE id= " . $database->escape_string($this->id);
            $sql .= " LIMIT 1";
            $database->query($sql);
            return mysqli_affected_rows($database->connection) == 1 ? true : false;
        }
        public function save(){
            return isset($this->id) ? $this->update() : $this->create();
        }

        /**ABSTRACTION PROPERTIES**/
        protected function properties(){
            $properties = array();
            /**'username','password','first_name','last_name'**/
            foreach(static::$db_table_fields as $db_field){
                if(property_exists($this,$db_field)){
                    $properties[$db_field] = $this->$db_field;
                }
            }
            return $properties;
        }
        protected function clean_properties(){
            global $database;
            $clean_properties = array();
            foreach($this->properties() as $key => $value){
                $clean_properties[$key] = $database->escape_string($value);
            }
            return $clean_properties;
        }
        public static function count_all(){
            global $database;
            $sql = "SELECT COUNT(*) FROM " . static::$db_table; //aantal is 10
            $result_set = $database->query($sql); // in var zit alles van de gevraagde tabel (aantal) komt ALTIJD als array
            $row = mysqli_fetch_array($result_set); // opl array in rij steken

            return array_shift($row); //eerste element array uithalen -> maakt er string van ARRAY TO STRING
            //return $row[0] werkt ook
        }


    }
?>