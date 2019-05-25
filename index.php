<!-- 
#http://junil-hwang.com/blog/mvc-design-pattern-create/
#http://junil-hwang.com/blog/php-mvc-board-%EA%B2%8C%EC%8B%9C%ED%8C%90/ 
-->

<?php
    define('_ROOT',dirname(__FILE__)."/");
    define('_APP',_ROOT."php/");
    define('_RESOURCES',_ROOT."resources/");
    define('_CONFIG',_APP."config/");
    //define('_MODEL',_APP."model/");
    //define('_VIEW',_APP."view/");
    //define('_CONTROLLER',_APP."controller/");
    $url = str_replace("index.php","","http://{$_SERVER['HTTP_HOST']}{$_SERVER['PHP_SELF']}");
    define('_URL',$url);
    define('_IMG',_URL.'resources/img/');
    define('_CSS',_URL.'resources/css/');
    define('_JS',_URL.'resources/js/');
    require_once(_CONFIG."lib.php");
    new Application();
?>