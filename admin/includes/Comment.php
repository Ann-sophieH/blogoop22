<?php
    class Comment extends Db_object{
        /*** PROPERTIES ****/
        protected static $db_table = "comments";
        protected static $db_table_fields = array('photo_id', 'author', 'body');
        public $id;
        public $photo_id;
        public $author;
        public $body;

        /*** Methods ****/
        /*** CRUD ****/
        public static function create_comment($photo_id, $author="Test",$body="" ){
            if(!empty($photo_id)&& !empty($author)&& !empty($body)){
                $comment = new Comment(); //NIEUWE COMMENT OPHALEN
                $comment->photo_id = (int)$photo_id; //typecasting!!!!!!!!!!!! om sql injectie op te vangen (nu kan enkel id in)
                $comment->author = $author;
                $comment->body = $body;
                return $comment;
            }else{
                return false;
            }
        }
        public static function find_the_comment($photo_id){
            global $database;
            $sql = "SELECT * FROM " . self::$db_table;
            $sql .= " WHERE photo_id = " . $database->escape_string($photo_id);
            $sql .= " ORDER BY photo_id ASC";

            return self::find_this_query($sql);
        }
    }
?>