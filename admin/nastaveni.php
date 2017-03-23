<?php 
	$file = "default.tpl";
	if($p2 == "jazyky" && !empty($id)) { $tpl->assign('jazyk', $jazyky->jazyk($id)); }
	$tpl->assign('menu', $hlavni_menu->view_menu());
	if($p2 == "menu" && !empty($id)) { 
		$tpl->assign('texty', $hlavni_menu->vypsat_texty());
		$tpl->assign('aktualni_polozka', $hlavni_menu->detail_menu($id)); 
	}

	switch ($p2) {
		case 'jazyky':
			switch ($p3) {
		        case 'novy':
		            if($_GET['akce'] == 'ulozit') {
		                $id = $jazyky->pridat_jazyk();
		                if($_POST['button'] == 'send_exit') { 
		                    header('Location: /admin/nastaveni/jazyky');
		                }
		                else if($_POST['button'] == 'send') { 
		                    header('Location: /admin/nastaveni/jazyky/edit/'.$id); 
		                }
		            }
		            else {
		                $tpl->display(ADMIN_PAGES . '/nastaveni/jazyky/form.tpl');
		            }
		            break;
		        case 'edit':
		            if($_GET['akce'] == 'ulozit') {
		                $jazyky->edit_jazyk($_POST['id']);
		                if($_POST['button'] == 'send_exit') { 
		                    header('Location: /admin/nastaveni/jazyky');
		                }
		                else if($_POST['button'] == 'send') { 
		                    header('Location: /admin/nastaveni/jazyky/edit/'.$_POST['id']); 
		                }
		            }
		            else {
		                $tpl->display(ADMIN_PAGES . '/nastaveni/jazyky/form.tpl');                   
		            }
		            break;
		        case 'smazat':
		            $jazyky->smazat_jazyk($id);
		            header('Location: /admin/nastaveni/jazyky');
		            break;
		        default:
		            $tpl->display(ADMIN_PAGES . $p1 . '/default.tpl');
		            break;
		    }
			break;
		case 'menu':
			$file = "default.tpl";
		    $tpl->assign('menu', $hlavni_menu->view_menu());
			if(!empty($_GET['p4'])) { $tpl->assign('aktualni_polozka', $hlavni_menu->detail_menu($_GET['p4'])); }
			if($p3 == "novy") {
				if($_GET['akce'] == 'ulozit') {
					$hlavni_menu->pridat_menu();
					$web->setLastId();
					if($_POST['button'] == 'send_exit') { header('Location: /admin/nastaveni/'); }
		    		else if($_POST['button'] == 'send') { header('Location: /admin/nastaveni/menu/edit/'.$web->getLastId().'/'); }
				}
				else {
					$file = "form.tpl"; 
					$tpl->display(ADMIN_PAGES . $p1.'/'.$p2.'/'.$file);					
				}						
			}
			elseif($p3 == "edit") {
				if($_GET['akce'] == 'ulozit') {
					$hlavni_menu->edit_menu($_POST['id']);
					if($_POST['button'] == 'send_exit') { header('Location: /admin/nastaveni/'); }
		    		else if($_POST['button'] == 'send') { header('Location: /admin/nastaveni/menu/edit/'.$_POST['id'].'/'); }
				}
				else {
					$file = "form.tpl"; 
					$tpl->display(ADMIN_PAGES . $p1.'/'.$p2.'/'.$file);
				}
			}
			elseif($p3 == "smazat") {
				$hlavni_menu->smazat($_GET['p4']);
		    	header('Location: /admin/nastaveni/');
			}
			else {
		        $tpl->display(ADMIN_PAGES . $p1.'/'.$p2.'/'.$file);
			}
			break;
		default:
			$tpl->display(ADMIN_PAGES . $p1.'/'.$file);
			break;

	}
?>