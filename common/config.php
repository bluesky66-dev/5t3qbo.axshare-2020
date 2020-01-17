<?php
ob_start();
session_start();
if ( $_SERVER['SERVER_NAME'] == 'localhost' ) {
	define( "DB_TYPE", "mysql" );
	define( "DB_HOSTNAME", "localhost" );
	define( "DB_USERNAME", "root" );
	define( "DB_PASSWORD", "" );
	define( "DB_DATABASE", "projectscope" );
} else {
	define( "DB_TYPE", "mysql" );
	define( "DB_HOSTNAME", "localhost" );
	define( "DB_USERNAME", "root" );
	define( "DB_PASSWORD", "" );
	define( "DB_DATABASE", "projectscope" );
}

define( "HOST_SERVER", $_SERVER['SERVER_NAME'] );
define( "SITE_NAME", "Etsy Script" );
define( "NO_PROFILE_PHOTO", "img/profile/noPhoto.png" );
define( "NO_MEDIA_PHOTO", "img/noPhoto.png" );

define( "CV_ADMIN_EMAIL", "" );
define( "CV_SENDGRID_API_KEY", "" );
define( "CV_KEYSTRING", "72hru11fajyjwbq4vn1cuziq" );
define( "CV_SHARED_SECRET", "3lrmny1zu6" );


if ( $_SERVER['SERVER_NAME'] == 'localhost' ) {
	define( "CV_BACKEND", "http://localhost:7005/admin/" );
	define( "CV_FRONTEND", "http://localhost:7005/" );
	define("CV_SERVER_DOCUMENT_ROOT", $_SERVER['DOCUMENT_ROOT']."/");
	define("CV_ADMIN_SERVER_DOCUMENT_ROOT", $_SERVER['DOCUMENT_ROOT']."/admin/");
	define("CV_MEDIA_DIR", $_SERVER['DOCUMENT_ROOT']."/images/");
	define("CV_MEDIA_PATH", "http://localhost:7005/images/");
}else{
	define( "CV_BACKEND", "" );
	define( "CV_FRONTEND", "" );
	define("CV_SERVER_DOCUMENT_ROOT", $_SERVER['DOCUMENT_ROOT']."/");
	define("CV_ADMIN_SERVER_DOCUMENT_ROOT", $_SERVER['DOCUMENT_ROOT']."/");
	define("CV_MEDIA_DIR", $_SERVER['DOCUMENT_ROOT']."/images/");
	define("CV_MEDIA_PATH", "/images/");
}

?>