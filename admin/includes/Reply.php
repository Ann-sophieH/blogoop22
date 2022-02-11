<?php
    class Reply extends Db_object{
        /*** PROPERTIES ****/
        protected static $db_table = "replies";
        protected static $db_table_fields = array('comment_id', 'r_author', 'r_body');
        public $id;
        public $comment_id;
        public $r_author;
        public $r_body;

        /*** Methods ****/
        /*** CRUD ****/
        public static function create_reply($comment_id, $r_author="Test",$r_body="" ){
            if(!empty($comment_id)&& !empty($r_author)&& !empty($r_body)){
                $reply = new Reply(); //NIEUWE reply OPHALEN
                $reply->comment_id = (int)$comment_id; //typecasting!!!!!!!!!!!! om sql injectie op te vangen (nu kan enkel id in)
                $reply->r_author = $r_author;
                $reply->r_body = $r_body;
                return $reply;
            }else{
                return false;
            }
        }
        public static function find_the_reply($comment_id){
            global $database;
            $sql = "SELECT * FROM " . self::$db_table;
            $sql .= " WHERE comment_id = " . $database->escape_string($comment_id);
            $sql .= " ORDER BY comment_id ASC";

            return self::find_this_query($sql);
        }
    }
?>