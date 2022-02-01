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
        $sql = "SELECT photo_id FROM categories_photos WHERE category_id = " . $cat_id; //alle photo ids ophalen
        //uit de tussentabel waar de category id = variabele (int w uit de url gehaald)
        $result =  $database->query($sql);
        $rows = [];
        while($row = $result->fetch_row()) {
            $rows[] = $row;
        }
        $all_photos_of_category = []; //hierin komt array met elke foto die bij die category hoort
        foreach ($rows as $one_photo_id){
            $photo_id = implode("", $one_photo_id); //opl array to string error, haalt "" weg en levert af als string
            $one_photo_id =  Photo::find_by_id($photo_id); //findbyid heeft hier die stringwaarde nodig om de query te kunnen uitvoeren
            $all_photos_of_category[] = $one_photo_id;
        }
        return $all_photos_of_category;
    }
    public static function cats_w_photos(){ //ENKEL de categorieen ophalen uit tussentabel die een photoID hebben
        global $database; //Distinct om enkel unieke waarden uit de tabel te halen
        $sql = "SELECT DISTINCT category_id FROM categories_photos WHERE photo_id IS NOT null";
        $result =  $database->query($sql);
        $rows = [];
        while($row = $result->fetch_row()) { //queryresult loopen en rij per rij in $rows[] steken
            $rows[] = $row;
        }

        $all_photo_categories = [];
        foreach ($rows as $one_cat_id){ //
            $cat_id = implode("", $one_cat_id);//turns array into string
            $one_cat_id =  Category::find_by_id($cat_id);//string is used to run query
            $all_photo_categories[] = $one_cat_id;
        }
        return $all_photo_categories;
    }

}
?>