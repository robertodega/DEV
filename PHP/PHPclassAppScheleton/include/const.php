<?php
    //	Connection constants
    $dbConst = [
		"localhost" => [
			"host" => "localhost"
			,"dbname" => "utils"
			,"user" => "root"
			,"pwd" => ""
		]
		,"remote" => [
			"host" => ""
			,"dbname" => ""
			,"user" => ""
			,"pwd" => ""
		]
	];

    $env = ($_SERVER["HTTP_HOST"] !== "localhost") ? "remote" : $_SERVER["HTTP_HOST"];

    //	DB constants
    define("CONNDB",$dbConst["".$env.""]["dbname"]);
    define("CONNHOST",$dbConst["".$env.""]["host"]);
    define("CONNUSR",$dbConst["".$env.""]["user"]);
    define("CONNPWD",$dbConst["".$env.""]["pwd"]);

    // PATH CONSTANTS
    define("SRC_PATH","./");
    define("CSS_PATH","".SRC_PATH."assets/css/");
    define("JS_PATH","".SRC_PATH."assets/js/");
    define("IMG_PATH","".SRC_PATH."assets/images/");
    define("INCLUDE_PATH","".SRC_PATH."include/");

    // OTHER CONSTANTS
    define("PROJ_TITLE","");

?>