<?php 
	$id = $_GET['p3'];
	$tpl->assign('poznamky_uzivatele', $poznamky->seznam_poznamek_uzivatele($logged_user['id']));
	if(!empty($id)) {$tpl->assign('poznamka', $poznamky->poznamka($id));}
	if($p2 == "pripnout") { $poznamky->pripnout($id); header('Location: /admin/poznamky/'); }
	if($p2 == "odepnout") { $poznamky->odepnout($id); header('Location: /admin/poznamky/'); }
	if($p2 == "novy") {
		if($_GET['akce'] == 'ulozit') {
			$$p1->pridat($logged_user['id']);
			if($i == true) { $vytvoreno = 1; } else { $vytvoreno = 0; }
			if($_POST['button'] == 'send_exit') { 
				header('Location: /admin/'.$p1.'&vytvoreno='.$vytvoreno); } 
			elseif($_POST['button'] == 'send') { 
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
			$poznamky->edit($_POST['id']);
			if($_POST['button'] == 'send_exit') { 
	        	header('Location: /admin/'.$p1);		        		
            }
    		else if($_POST['button'] == 'send') { 
	            header('Location: /admin/'.$p1.'/'.$p2.'/'.$p3.'/'.$_POST['id'].'/');			            
    		}
		}
		else {
			$file = "form.tpl"; 
			$tpl->display(ADMIN_PAGES . $p1.'/'.$file);
		}
	}
	elseif($p2 == "smazat") {
		$poznamky->smazat($id);
	    header('Location: /admin/'.$p1);		        		
	}
	else {
		$file = "default.tpl";
		$tpl->display(ADMIN_PAGES . $p1.'/'.$file);
	}
?>