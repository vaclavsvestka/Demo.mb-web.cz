<?php  
	include(CLASSES.'web_setup.php');
	$web = new web;
	$tpl = new Web_Smarty;
	foreach($modules as $key=>$value) {
	    if($value['enable'] == 1) {
	        if($value['class'] == 1) { 
	            include_once CLASSES . $key . ".class.php";
	            $$key = new $key;
	        }
	    }
	}
?>