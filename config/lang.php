<?php  
	if(!empty($_GET['lang'])) { $lang = $_GET['lang']; } else { $lang = "cz"; }
    $tpl->assign('lang', $lang);
    include(LANG_FOLDER.$lang.'.lang');
    foreach($language as $key=>$value) {
        $tpl->assign('lang_'.$key, $value);
    }
?>