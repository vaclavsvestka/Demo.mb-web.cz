<?php  
	$tpl->assign('kategorie', $knihovna->seznam_kategorii($params));
    if(!empty($_GET['id'])) { $id = $_GET['id']; }
    if(!empty($_GET['id2'])) { $id = $_GET['id2']; }
    if(!empty($_GET['id3'])) { $id = $_GET['id3']; }
    if(!empty($_GET['id4'])) { $id = $_GET['id4']; }
    if(!empty($id)) {
        $params = array('kategorie' => $id, 'limit' => 100);
        $tpl->assign('soubory', $knihovna->seznam_souboru($params));
        $tpl->assign('album', $knihovna->kategorie($id));                
    }
    if(!empty($p2)) {
        switch ($p2) {
            case 'nova-slozka':
                if($_GET['akce']=="ulozit") {
                    $knihovna->pridat_kategorii();
                    if(!empty($_GET['id'])) { $odkaz = "&id=".$_GET['id']."&zobrazit=".$_GET['zobrazit'].""; }
                    if(!empty($_GET['id2'])) { $odkaz = "&id=".$_GET['id']."&id2=".$_GET['id2']."&zobrazit=".$_GET['zobrazit'].""; }
                    if(!empty($_GET['id3'])) { $odkaz = "&id=".$_GET['id']."&id2=".$_GET['id2']."&id3=".$_GET['id3']."&zobrazit=".$_GET['zobrazit'].""; }
                    if(!empty($_GET['id4'])) { $odkaz = "&id=".$_GET['id']."&id2=".$_GET['id2']."&id3=".$_GET['id3']."&id4=".$_GET['id4']."&zobrazit=".$_GET['zobrazit'].""; }
                    header('Location: /admin/knihovna/'.$odkaz);
                }
                else {
                    $tpl->display(ADMIN_PAGES . 'knihovna/form.tpl');            
                }
                break;
            case 'edit-slozky':
                if($_GET['akce']=="ulozit") {
                    $knihovna->upravit_kategorii($_POST['id']);
                    header('Location: /admin/knihovna');
                }
                else {
                    $tpl->display(ADMIN_PAGES . 'knihovna/form.tpl');            
                }
                break;
            case 'smazat-slozku':
                $knihovna->smazat_kategorii($_GET['slozka']);
                if(!empty($_GET['id'])) { $odkaz = "&id=".$_GET['id']."&zobrazit=".$_GET['zobrazit'].""; } else { $odkaz = "seznam-alb"; }
                if(!empty($_GET['id2'])) { $odkaz = "&id=".$_GET['id']."&id2=".$_GET['id2']."&zobrazit=".$_GET['zobrazit'].""; }
                if(!empty($_GET['id3'])) { $odkaz = "&id=".$_GET['id']."&id2=".$_GET['id2']."&id3=".$_GET['id3']."&zobrazit=".$_GET['zobrazit'].""; }
                if(!empty($_GET['id4'])) { $odkaz = "&id=".$_GET['id']."&id2=".$_GET['id2']."&id3=".$_GET['id3']."&id4=".$_GET['id4']."&zobrazit=".$_GET['zobrazit'].""; }
                header('Location: /admin/knihovna/'.$odkaz);
                break;
            case 'soubory-pridat-form':
                if(($_GET['akce'] == "nahrat-soubory-vodoznak") || ($_GET['akce'] == "nahrat-soubory-bez-vodoznaku")) {
                    if(!empty($_GET['id4'])) {
                        $album = $_GET['id4'];
                    }
                    else {  
                        if(!empty($_GET['id3'])) {
                            $album = $_GET['id3'];
                        }
                        else {  
                            if(!empty($_GET['id2'])) {
                                $album = $_GET['id2'];
                            }
                            else {  
                                if(!empty($_GET['id'])) {
                                    $album = $_GET['id'];
                                }
                                else {
                                    $album = 0;
                                }
                            }
                        }
                    }
                    // $tpl->assign('album', $knihovna->album($album));
                    // $tpl->assign('photos', $knihovna->fotografieByAlbumId($album));
                    if($_GET['akce'] == "nahrat-soubory-vodoznak") { $knihovna->pridat_soubory(1); } else { $knihovna->pridat_soubory(0); }
                }
                else {
                    $tpl->display(ADMIN_PAGES . 'knihovna/soubory-pridat-form.tpl');                            
                }
                break;
            case 'upravit_soubor':
                if($_GET['akce'] == 'ulozit') {
                    $knihovna->upravit_soubor($_POST['id_souboru']);
                    if(!empty($_GET['id2'])) {
                        if(!empty($_GET['id3'])) {
                            if(!empty($_GET['id4'])) {
                                $odkaz = '&id='.$_POST['id'].'&id2='.$_POST['id2'].'&id3='.$_POST['id3'].'&id4='.$_POST['id4'].'&zobrazit='.$_POST['zobrazit'].'';
                            }
                            else {
                                $odkaz = '&id='.$_POST['id'].'&id2='.$_POST['id2'].'&id3='.$_POST['id3'].'&zobrazit='.$_POST['zobrazit'].'';
                            }
                        }
                        else {
                            $odkaz = '&id='.$_POST['id'].'&id2='.$_POST['id2'].'&zobrazit='.$_POST['zobrazit'].'';
                        }
                    }
                    else {
                        $odkaz = '&id='.$_POST['id'].'&zobrazit='.$_POST['zobrazit'].'';
                    }    
                    header('Location: /admin/knihovna/'.$odkaz);
                }
                else {
                    $tpl->assign('soubor', $knihovna->soubor($_GET['id_souboru']));                
                    $tpl->display(ADMIN_PAGES . 'knihovna/editace_souboru.tpl');
                }
                break;
            case 'smazat_soubor':
                $knihovna->smazat_soubor($_GET['id_souboru']);
                if(!empty($_GET['id2'])) {
                    if(!empty($_GET['id3'])) {
                        if(!empty($_GET['id4'])) {
                            $odkaz = '&id='.$_GET['id'].'&id2='.$_GET['id2'].'&id3='.$_GET['id3'].'&id4='.$_GET['id4'].'&zobrazit='.$_GET['zobrazit'].'';
                        }
                        else {
                            $odkaz = '&id='.$_GET['id'].'&id2='.$_GET['id2'].'&id3='.$_GET['id3'].'&zobrazit='.$_GET['zobrazit'].'';
                        }
                    }
                    else {
                        $odkaz = '&id='.$_GET['id'].'&id2='.$_GET['id2'].'&zobrazit='.$_GET['zobrazit'].'';
                    }
                }
                else {
                    $odkaz = '&id='.$_GET['id'].'&zobrazit='.$_GET['zobrazit'].'';
                }
                header('Location: /admin/knihovna/'.$odkaz);
                break;
            case 'hlavni_fotka':
                $id_fotky = $_GET['id_souboru'];
                if($_GET['id']) { $id_alba = $_GET['id']; }
                if($_GET['id2']) { $id_alba = $_GET['id2']; }
                if($_GET['id3']) { $id_alba = $_GET['id3']; }
                if($_GET['id4']) { $id_alba = $_GET['id4']; }
                if(!empty($_GET['id2'])) {
                    if(!empty($_GET['id3'])) {
                        if(!empty($_GET['id4'])) {
                            $odkaz = '&id='.$_GET['id'].'&id2='.$_GET['id2'].'&id3='.$_GET['id3'].'&id4='.$_GET['id4'].'&zobrazit='.$_GET['zobrazit'].'';
                        }
                        else {
                            $odkaz = '&id='.$_GET['id'].'&id2='.$_GET['id2'].'&id3='.$_GET['id3'].'&zobrazit='.$_GET['zobrazit'].'';
                        }
                    }
                    else {
                        $odkaz = '&id='.$_GET['id'].'&id2='.$_GET['id2'].'&zobrazit='.$_GET['zobrazit'].'';
                    }
                }
                else {
                    $odkaz = '&id='.$_GET['id'].'&zobrazit='.$_GET['zobrazit'].'';
                }
                $knihovna->nastavit_hlavni($id_fotky, $id_alba);
                header('Location: /admin/knihovna/'.$odkaz);
                break;
            default:
                $tpl->display(ADMIN_PAGES . 'knihovna/default.tpl');
                break;
        }
    }
    else {
        $tpl->display(ADMIN_PAGES . 'knihovna/default.tpl');
    }
?>