<?php 
	$file = "default.tpl";
	if(!empty($id)) {
		$tpl->assign('objednavka', $objednavky->objednavka($id));
	}
	$tpl->assign('objednavky', $objednavky->seznam_objednavek());
	switch ($p2) {
		case 'edit':
			if($_GET['akce'] == 'ulozit') {
				$$p1->edit($_POST['id']);
				if($_POST['button'] == 'send_exit') { 
			        header('Location: /admin/'.$p1.'');
	            }
	    		else if($_POST['button'] == 'send') { 
		            header('Location: /admin/'.$p1.'/'.$p2.'/'.$_POST['id'].'/');			            
	    		}
			}
			else {
				$file = "form.tpl"; 
				$tpl->display(ADMIN_PAGES . $p1.'/'.$file);					
			}
			break;

		case 'zmenit-stav':
			$objednavky->zmenit_stav_objednavky($_POST['id']);
			header('Location: '. URL.'admin/objednavky/edit/'.$_POST['id']);
			break;

		case 'zmenit-dodaci-adresu':
			$objednavky->zmenit_dodaci_adresu($_POST['id']);
			header('Location: '. URL.'admin/objednavky/edit/'.$_POST['id']);
			break;

		case 'zmenit-fakturacni-adresu':
			$objednavky->zmenit_fakturacni_adresu($_POST['id']);
			header('Location: '. URL.'admin/objednavky/edit/'.$_POST['id']);
			break;

		case 'zmenit-polozku':
			$objednavky->zmenit_polozku($_POST['id']);
			header('Location: '. URL.'admin/objednavky/edit/'.$_POST['id_objednavky']);
			break;

		case 'smazat-polozku':
			$objednavky->smazat_polozku($_GET['id_polozky']);
			header('Location: '. URL.'admin/objednavky/edit/'.$_GET['id_objednavky']);
			break;
		
		case 'smazat':
			$$p1->smazat($id);
        	header('Location: '. URL . '/admin/'.$p1.'');
			break;
		
		case 'detail':
			$file = "detail.tpl"; 
			$tpl->display(ADMIN_PAGES . $p1.'/'.$file);	
			break;
		
		default:
			$tpl->display(ADMIN_PAGES . $p1.'/'.$file);
			break;

	}
?>