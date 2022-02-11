<?php
class Role extends Db_object{
    protected static $db_table = "roles";
    protected static $db_table_fields = array('role');
    public $id;
    public $role;

}