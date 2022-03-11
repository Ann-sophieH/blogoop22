<?php
    defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
    define('SITE_ROOT', DS . 'wamp64' . DS . 'www' . DS . 'blogoop22');
    defined('INCLUDES_PATH') ? null : define('INCLUDES_PATH', SITE_ROOT.DS.'admin'.DS.'includes');
    defined('IMAGES_PATH') ? null : define('IMAGES_PATH', SITE_ROOT.DS.'admin'.DS.'img');
    require_once(INCLUDES_PATH.DS."functions.php");
    require_once(INCLUDES_PATH.DS."config.php"); //boven
    require_once(INCLUDES_PATH.DS."Database_pdo.php"); //b
    require_once(INCLUDES_PATH.DS."Db_object_pdo.php"); //Bovenaan
    require_once(INCLUDES_PATH.DS."User.php");
    require_once(INCLUDES_PATH.DS."Role.php");
    require_once(INCLUDES_PATH.DS."Photo.php");
    require_once(INCLUDES_PATH.DS."Comment.php");
    require_once(INCLUDES_PATH.DS."Reply.php");
    require_once(INCLUDES_PATH.DS."Category.php");
    require_once(INCLUDES_PATH.DS."Session.php");
    require_once(INCLUDES_PATH.DS."Paginate.php");
?>
