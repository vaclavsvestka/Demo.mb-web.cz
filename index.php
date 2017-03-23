<?php 
    ob_start();
    session_start();
    error_reporting(E_ERROR);

    define('ROOT', __DIR__ .'/');
    
    require_once "config/define.php";
    require_once "config/modules.php";
    require_once "config/load_classes.php";
    require_once "config/lang.php";

    $tpl->assign('EMAIL', EMAIL);
    $tpl->assign('WEB_URL', URL);
    $tpl->assign('TEMPLATE', TEMPLATE);
    $tpl->assign('menu', $hlavni_menu->view_menu());
    $tpl->assign('nastaveni', $nastaveni->nacti());
    
    SetLocale(LC_ALL, "cs_CZ"); 

    switch ($_GET['m']) {
        case 'blog':
            $tpl->display(TEMPLATE.'pages/blog/default.tpl');
            break;
        case 'cms':
            $tpl->display(TEMPLATE.'pages/cms/default.tpl');
            break;
        case 'faq':
            $tpl->display(TEMPLATE.'pages/faq/default.tpl');
            break;
        case 'kontakt':
            $tpl->display(TEMPLATE.'pages/kontakt/default.tpl');
            break;
        case 'reference':
            $tpl->display(TEMPLATE.'pages/reference/default.tpl');
            break;
        case 'sluzby':
            $tpl->display(TEMPLATE.'pages/sluzby/default.tpl');
            break;
        default:
            $tpl->display(TEMPLATE.'pages/layout.tpl');
            break;
    }

    ob_end_flush();
?>