<?php 
	// kategorie
	$params = array();
	$tpl->assign('kategorie', $produkty->seznam_kategorii($params));
	if($p2 == "kategorie" && !empty($id)) {
		$tpl->assign('kat', $produkty->kategorie($id));
	}

	// znacky
	$params = array();
	$tpl->assign('znacky', $produkty->seznam_znacek($params));
	if($p2 == "znacky" && !empty($id)) {
		$tpl->assign('znacka', $produkty->znacka($id));
	}

	// stitky
	$params = array();
	$tpl->assign('stitky', $produkty->seznam_stitku($params));
	if($p2 == "stitky" && !empty($id)) {
		$tpl->assign('stitek', $produkty->stitek($id));
	}
	
	// parametry
	$params = array();
	$tpl->assign('parametry', $produkty->seznam_parametru($params));
	if($p2 == "parametry" && !empty($id)) {
		$tpl->assign('par', $produkty->parametr($id));
	}

	// produkty
	$params = array();
	$tpl->assign('produkty', $produkty->seznam_produktu($params));
	if($p2 == "seznam" && !empty($id)) {
		$tpl->assign('produkt', $produkty->produkt($id));
	}	

	$file = "default.tpl";
	if($p3 == "novy") {
		if($_GET['akce'] == 'ulozit') {
			if($p2 == "kategorie") { $id = $produkty->pridat_kategorie(); }
			elseif($p2 == "seznam") { $id = $produkty->pridat_produkt(); }
			elseif($p2 == "parametry") { $id = $produkty->pridat_parametry(); }
			elseif($p2 == "znacky") { $id = $produkty->pridat_znacku(); }
			if($_POST['button'] == 'send_exit') { 
				$web->setLastId();
	        	header('Location: /admin/'.$p1.'/'.$p2);
            }
    		else if($_POST['button'] == 'send') { 
            	header('Location: /admin/'.$p1.'/'.$p2.'/edit/'.$id.'/');
    		}
		}
		else {
			$file = "form.tpl"; 
			$tpl->display(ADMIN_PAGES . $p1.'/'.$p2.'/'.$file);					
		}						
	}
	elseif($p3 == "edit") {
		if($_GET['akce'] == 'ulozit') {
			if($p2 == "kategorie") { $produkty->edit_kategorie($_POST['id']); }
			elseif($p2 == "seznam") { $produkty->edit_produkt($_POST['id']); }
			elseif($p2 == "parametry") { $produkty->edit_parametry($_POST['id']); }
			elseif($p2 == "znacky") { $produkty->edit_znacku($_POST['id']); }
			if($_POST['button'] == 'send_exit') { 
		        header('Location: /admin/'.$p1.'/'.$p2);		        		
            }
    		else if($_POST['button'] == 'send') { 
	            header('Location: /admin/'.$p1.'/'.$p2.'/'.$p3.'/'.$_POST['id'].'/');			            
    		}
		}
		else {
			$file = "form.tpl"; 
			$tpl->display(ADMIN_PAGES . $p1.'/'.$p2.'/'.$file);
		}
	}
	elseif($p3 == "smazat") {
		if($p2 == "kategorie") { $produkty->smazat_kategorie($id); }
		elseif($p2 == "seznam") { $produkty->smazat_produkt($id); }
		elseif($p2 == "parametry") { $produkty->smazat_parametry($id); }
		elseif($p2 == "znacky") { $produkty->smazat_znacku($id); }
    	header('Location: /admin/'.$p1.'/'.$p2);		        		
	}
	else {
		$tpl->display(ADMIN_PAGES . '/'.$p1.'/'.$p2.'/default.tpl');
	}
?>