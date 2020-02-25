<?php
date_default_timezone_set("Asia/Bangkok");
error_reporting(E_ALL ^ E_DEPRECATED);
	
	define('db_host','localhost');
	define('db_user','qmuajico_root');
	define('db_pass',"Muaji*19#");
	define('db_name','qmuajico_ecommerce');
	
	mysql_connect(db_host,db_user,db_pass) or die (mysql_error());
	mysql_select_db(db_name) or die (mysql_error());
