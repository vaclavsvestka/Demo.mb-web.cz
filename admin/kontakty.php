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

    if($p3 == 'novy') {
        if($_GET['akce'] == 'ulozit') {
            $kontakty->pridat();
            if($_POST['button'] == 'send_exit') { 
                header('Location: /admin/kontakty');
            }
            else if($_POST['button'] == 'send') { 
                $web->setLastId();
                $id = $web->getLastId();
                header('Location: /admin/kontakty/edit/'.$id.'&type='.$_POST['skupina'].''); 
            }
        }
        $tpl->display(ADMIN_PAGES . 'kontakty/form.tpl');
    }
    elseif($p3 == 'edit') {
        if($_GET['akce'] == 'ulozit') {
        	$kontakty->edit($_POST['id']);
            if($_POST['button'] == 'send_exit') { 
                header('Location: /admin/kontakty');
            }
            else if($_POST['button'] == 'send') { 
                header('Location: /admin/kontakty/edit/'.$_POST['id'].'&type='.$_POST['skupina'].''); 
            }
        }
        else {
    		$tpl->assign('kontakt', $kontakty->kontakt($id));
            $tpl->display(ADMIN_PAGES . 'kontakty/form.tpl');                	
        }
    }
    elseif($p3 == 'smazat') {
        $kontakty->smazat($id);
        header('Location: /admin/kontakty');
    }
    else {
        $tpl->display(ADMIN_PAGES . 'kontakty/default.tpl');                      
    }
?>