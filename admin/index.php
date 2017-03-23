<?php 
    ob_start();
    session_start();
    error_reporting(E_ERROR);
    ini_set("display_errors", "off");
    
    define('ROOT', '/www/mb-web.cz/demo.mb-web.cz/');

    require_once ROOT . "config/define.php";
    require_once ROOT . "config/modules.php";
    require_once ROOT . "config/admin_menu.php";
    require_once ROOT . "config/load_classes.php";
    
    register_shutdown_function("fatal_handler");
    function fatal_handler() {
        $web = new web;
        $err = error_get_last();
        if($err['type'] == 1) {
            $web->pridat_do_error_log_fatal($err['type'], $err['message'],$err['file'],$err['line']);
            $web->odeslat_error_email_fatal($err['type'], $err['message'],$err['file'],$err['line']);
        }
    }
    
    if($_SESSION['logged'] == 1) {
        
        $logged_user = $admin->logged_user();
        $tpl->assign('web_menu',$menu);
        $tpl->assign('logged_user', $logged_user);
        $tpl->assign('URL', URL);
        $tpl->assign('nastaveni', $nastaveni->nacti());
        $tpl->assign('mena', 'Kč');

        $tpl->assign('modules', $modules);

        $params = array();
        $tpl->assign('knihovna_kategorie', $knihovna->seznam_kategorii($params));

        $mesic = date('m');
        $rok = date('Y');

        if(!empty($_GET['p5'])) { $p5 = $_GET['p5']; if(is_numeric($p5)) { $id = $p5; $p5 = ""; }}
        if(!empty($_GET['p4'])) { $p4 = $_GET['p4']; if(is_numeric($p4)) { $id = $p4; $p4 = ""; }}
        if(!empty($_GET['p3'])) { $p3 = $_GET['p3']; if(is_numeric($p3)) { $id = $p3; $p3 = ""; }}
        if(!empty($_GET['p2'])) { $p2 = $_GET['p2']; if(is_numeric($p2)) { $id = $p2; $p2 = ""; }}
        if(!empty($_GET['p1'])) { $p1 = $_GET['p1']; }

        $tpl->assign('jazyky', $jazyky->seznam_jazyku());

        if($p1 == "logout") {
            $admin->logout();
            header('Location: /admin/');
        }
        else {
            if(!empty($p1)) { 
                require_once(ROOT . 'admin/'.$p1.'.php');
            } 
            else { 
                $tpl->display(ROOT . 'admin/pages/layout.tpl'); 
            }
        }
    }
    else {
        switch ($_GET['m']) {
            case 'login':
                $admin->login();
                break;
            default:
                $admin->displayLogin();
                break;
        }
    }
    
    ob_end_flush();
?>