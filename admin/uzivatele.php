<?php  
	if(!empty($id)) { $tpl->assign('kontakt', $kontakty->kontakt($id)); }
    $params = array('skupina' => 2);
    $tpl->assign('kontakty_pobocky', $kontakty->seznam_kontaktu($params));
    $tpl->assign('skupiny', $kontakty->seznam_skupin_kontaktu());
    $tpl->assign('kontakty', $kontakty->seznam_kontaktu());

	$file = "default.tpl";
		
    $params = array('skupina' => 2);
    $tpl->assign('kontakty_pobocky', $kontakty->seznam_kontaktu($params));
    $tpl->assign('skupiny', $kontakty->seznam_skupin_kontaktu());                
    $tpl->assign('kontakty', $kontakty->seznam_kontaktu());

    $tpl->assign('uzivatele', $uzivatele->seznam());
    $tpl->assign('skupiny', $uzivatele->seznam_skupin());
    
    if($p3 == 'seznam-prihlaseni') {
        if($p4 == "smazat") {
            $row = $web->getEntry('*','uzivatele_logins','id='.$id);
            $uzivatel = $row['user_id'];
            $web->deleteEntryById('uzivatele_logins', $id);
            header('Location: /admin/nastaveni/uzivatele/seznam-prihlaseni/'.$uzivatel);
        }
        else {
            $tpl->assign('uzivatel', $uzivatele->uzivatel($id));
            $tpl->assign('prihlaseni', $uzivatele->seznam_prihlaseni($id));
            $tpl->display(ADMIN_PAGES . 'uzivatele/logins.tpl');                    
        }
    }
    elseif($p3 == 'novy') {
        if($_GET['akce'] == 'ulozit') {
            $uzivatele->pridat();
            if($_POST['button'] == 'send_exit') { 
                header('Location: /admin/nastaveni/uzivatele');
            }
            else if($_POST['button'] == 'send') { 
                $web->setLastId();
                $id = $web->getLastId();
                header('Location: /admin/nastaveni/uzivatele/edit/'.$id.'&type='.$_POST['skupina'].''); 
            }
        }
        $tpl->display(ADMIN_PAGES . 'uzivatele/form.tpl');
    }
    elseif($p3 == 'edit') {
        if($_GET['akce'] == 'ulozit') {
            $uzivatele->edit($_POST['id']);
            if($_POST['button'] == 'send_exit') { 
                header('Location: /admin/nastaveni/uzivatele');
            }
            else if($_POST['button'] == 'send') { 
                header('Location: /admin/nastaveni/uzivatele/edit/'.$_POST['id'].'&type='.$_POST['skupina'].''); 
            }
        }
        else {
            $tpl->assign('uzivatel', $uzivatele->uzivatel($id));
            $tpl->display(ADMIN_PAGES . 'uzivatele/form.tpl');                   
        }
    }
    elseif($p3 == 'smazat') {
        $uzivatele->smazat($id);
        header('Location: /admin/nastaveni/uzivatele');
    }
    elseif($p3 == 'nova-skupina') {
        if($_GET['akce'] == 'ulozit') {
            $uzivatele->pridat_skupinu();
            if($_POST['button'] == 'send_exit') { 
                header('Location: /admin/nastaveni/uzivatele');
            }
            else if($_POST['button'] == 'send') { 
                $web->setLastId();
                $id = $web->getLastId();
                header('Location: /admin/nastaveni/uzivatele/edit-skupinu/'.$id); 
            }
        }
        $tpl->display(ADMIN_PAGES . 'uzivatele/form-skupiny.tpl');
    }
    elseif($p3 == 'edit-skupinu') {
        if($_GET['akce'] == 'ulozit') {
            $uzivatele->edit_skupinu($_POST['id']);
            if($_POST['button'] == 'send_exit') { 
                header('Location: /admin/nastaveni/uzivatele');
            }
            else if($_POST['button'] == 'send') { 
                header('Location: /admin/nastaveni/uzivatele/edit-skupinu/'.$_POST['id']); 
            }
        }
        else {
            $tpl->assign('skupina', $uzivatele->skupina($id));
            $tpl->display(ADMIN_PAGES . 'uzivatele/form-skupiny.tpl');                   
        }
    }
    elseif($p3 == 'smazat-skupinu') {
        $uzivatele->smazat_skupinu($id);
        header('Location: /admin/nastaveni/uzivatele');
    }
    else {
        $tpl->display(ADMIN_PAGES . $p1.'/'.$file);
    }

?>