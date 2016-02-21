<?php
/**
 * Rtp admin loads from here.
 * @package estella pro
 */

//Enter the path where you have put the admin folder.
define( 'estella_ADMIN_FOLDER_PATH', '/lib/admin/' );

define( 'estella_ADMIN_PATH' , get_template_directory() . estella_ADMIN_FOLDER_PATH );
define( 'estella_ADMIN_URI' , get_template_directory_uri() . estella_ADMIN_FOLDER_PATH );
define( 'estella_CUSTOMIZER_PATH' , estella_ADMIN_PATH . 'customizer/' );

//Loading Files
require_once estella_CUSTOMIZER_PATH . 'customizer.php';
require_once estella_CUSTOMIZER_PATH . 'customizer-front.php';