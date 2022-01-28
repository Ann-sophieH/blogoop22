<?php
class User extends Db_object{
    /*** PROPERTIES ****/
    protected static $db_table = "users";
    protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name', 'user_image');
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;
    public $user_image;
    public $upload_directory = 'img'.DS.'users';
    public $image_placeholder = 'https://via.placeholder.com/400';
    public $type;
    public $size;
    public $tmp_path;
    public $errors = array();
    public $upload_errors_array = array(
        UPLOAD_ERR_OK => "There is no error",
        UPLOAD_ERR_INI_SIZE => "THE UPLOADED FILE EXCEEDS THE UPLOAD MAX_FILESIZE FROM php.ini",
        UPLOAD_ERR_FORM_SIZE => "The upload file exceeds MAX_FILE_SIZE  in php.ini voor een ftml form",
        UPLOAD_ERR_NO_FILE => "No file uploaded",
        UPLOAD_ERR_PARTIAL => "The file was partially uploaded",
        UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder",
        UPLOAD_ERR_CANT_WRITE => "Failed to write to disk",
        UPLOAD_ERR_EXTENSION => "A php extension stopped your upload");

    public function set_file($file){
        if(empty($file) || !$file || !is_array($file)){
            $this->errors[] = "No file uploaded";
            return false;
        }elseif($file['error'] != 0){
            $this->errors[] = $this->upload_errors_array['error'];
            return false;
        }else{
            $time = date('Y_m_d-H-i-s');
            $without_extension = pathinfo(basename($file['name']), PATHINFO_FILENAME);
            $extension = pathinfo(basename($file['name']), PATHINFO_EXTENSION);
            $this->user_image = $without_extension.$time.'.'.$extension;
            $this->type = $file['type'];
            $this->size = $file['size'];
            $this->tmp_path = $file['tmp_name'];}
    }
    public function save_user_and_image(){ //opladen en updaten van avatar foto nr db
        $target_path = SITE_ROOT.DS."admin".DS.$this->upload_directory.DS.$this->user_image;
        if($this->id){
            move_uploaded_file($this->tmp_path, $target_path); // van tijdelijk path nr target path
            $this->update();
            unset($this->tmp_path); //zeer belangrijk, wist de tijdelijke folder om server te ontlasten
            return true;
        }else{
            if(!empty($this->errors)){
                return false;
            }
            if(empty($this->user_image) || empty($this->tmp_path)){
                $this->errors[] = "File not available";
                return false;
            }

            if(file_exists($target_path)){
                $this->errors[]= "File {$this->user_image} EXISTS!";
                return false;
            }
            if(move_uploaded_file($this->tmp_path,$target_path)){//upload in de images map

                if($this->create()){//aanmaken in de database
                    unset($this->tmp_path);
                    return true;}
            }else{
                $this->errors[] = "This folder has no write rights";
                return false;}
        }}
    public static function verify_user($username, $password){
        global $database;
        $username = $database->escape_string($username);
        $password = $database->escape_string($password);

        $sql = "SELECT * FROM " . self::$db_table . " WHERE ";
        $sql .= "username = '{$username}' ";
        $sql .= "AND password = '{$password}' ";
        $sql .= "LIMIT 1";
        $the_result_array = self::find_this_query($sql);

        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }

    public function image_path_and_placeholder(){
        return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory.DS.$this->user_image;
    }
    public function image_path(){
        return $this->upload_directory.DS.$this->user_image;
    }
    public function delete_user_image(){
        if($this->delete()){
             unlink(SITE_ROOT.DS.'admin'.DS.$this->image_path());
        }else{
            return false;
        }
    }




}

?>