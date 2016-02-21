<?php

// return;

if( ! in_array($_SERVER['REMOTE_ADDR'], array(  '127.0.0.1', '::1' ) )) {
	return;
}

require get_template_directory() . "/sass/scssphp/scss.inc.php";

use Leafo\ScssPhp\Compiler;




$scss = new scssc();
$scss->setImportPaths( get_template_directory() . '/sass');
//$scss->setFormatter("scss_formatter_compressed");

$css =  $scss->compile(' @import "style.scss"; ');

file_put_contents( get_template_directory() . '/style.css' , $css );

//For pro
$scss_pro = new scssc();
$scss_pro->setImportPaths( get_template_directory() . '/pro/sass');
//$scss_pro->setFormatter("scss_formatter_compressed");

$css_pro =  $scss_pro->compile(' @import "pro.scss"; ');

file_put_contents( get_template_directory() . '/pro/pro.css' , $css_pro );



