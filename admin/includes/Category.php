<?php
class Category extends Db_object
{
    /*** PROPERTIES ****/
    protected static $db_table = "categories";
    protected static $db_table_fields = array('category_name');
    public $id;
    public $category_name;

    /*** Methods ****/
    /*** CRUD ****/



    public static function find_the_photo_id($cat_id){
        global $database;
        $sql = "SELECT photo_id FROM categories_photos WHERE category_id = " . $cat_id;
        return  $database->query($sql);

    }

}
?>