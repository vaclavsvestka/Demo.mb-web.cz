<?php 
	if(!empty($id)) {
		$tpl->assign('udalost', $kalendar->udalost($id));
	}
	else {
		$tpl->assign('udalosti', $kalendar->seznam_udalosti());
		$tpl->assign('udalosti_nasledujici', $kalendar->seznam_nasledujicich_udalosti());
	}
	
	$file = "default.tpl";
	if($p2 == "novy") {
		if($_GET['akce'] == 'ulozit') {
			$$p1->pridat($i,$id);
			if($i == true) { $vytvoreno = 1; } else { $vytvoreno = 0; }
			if($_POST['button'] == 'send_exit') { 
				header('Location: /admin/'.$p1.'&vytvoreno='.$vytvoreno); 
			} 
			else if($_POST['button'] == 'send') { 
				header('Location: /admin/'.$p1.'/edit/'.$id.'/&vytvoreno='.$vytvoreno); 
			}
		}
		else { 
			$file = "form.tpl"; 
			$tpl->display(ADMIN_PAGES . $p1.'/'.$file);
		}
	}
	elseif($p2 == "edit") {
		if($_GET['akce'] == 'ulozit') {
			if($$p1->edit($_POST['id']) == true) {
				$upraveno = 1;
			}
			else {
				$upraveno = 0;
			}
			if($_POST['button'] == 'send_exit') { 
		        header('Location: /admin/'.$p1.'&upraveno='.$upraveno);
            }
    		else if($_POST['button'] == 'send') { 
	            header('Location: /admin/'.$p1.'/'.$p2.'/'.$_POST['id'].'/&upraveno='.$upraveno);			            
    		}
		}
		else {
			$file = "form.tpl"; 
			$tpl->display(ADMIN_PAGES . $p1.'/'.$file);					
		}
	}
	elseif($p2 == "smazat") {
		if($$p1->smazat($id) == true) {
			$smazano = 1;
		}
		else {
			$smazano = 0;
		}
    	header('Location: /admin/'.$p1.'/&smazano='.$smazano);
	}
	elseif($p2 == "detail") {
		$file = "detail.tpl"; 
		$tpl->display($p1.'/'.$file);
	}
	else {
		$tpl->display(ADMIN_PAGES . $p1.'/'.$file);
	}
?>