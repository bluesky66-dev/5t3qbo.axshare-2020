<?php
require_once ('config.php');
require_once ('DB_Connection.php');
require_once ('functions.php');

require_once(CV_SERVER_DOCUMENT_ROOT . 'core/CVManagerLoad.php');

$user = [];
if ( CV_isLogin() ) {
	$isLogin  = "Y";
	$user     = CV_getCurrentUser();
} else {
	$isLogin = "N";
}
