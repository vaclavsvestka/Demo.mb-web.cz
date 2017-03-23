<?php 
	$tpl->assign('galerie', $galerie->galerie());
	$tpl->assign('album', $galerie->seznam_alb());
    
    if(($p2 == "edit") && (!empty($id))) { $tpl->assign('obrazek', $galerie->obrazek($id)); }
    if(($p2 == "edit-album") && (!empty($id))) { $tpl->assign('album', $galerie->album($id)); }

	$file = "default.tpl";
	switch ($p2) {
		case 'novy':
			if($_GET['akce'] == 'ulozit') {
				$galerie->nahrat_obrazek();
				if($_POST['button'] == 'send_exit') { 
			    	header('Location: '.ADMIN_PREFIX.'admin/galerie/album/'.$_POST['album']);
			    }
			}
			else {
				$file = "form.tpl"; 
				$tpl->display(ADMIN_PAGES . $p1 . '/form.tpl');					
			}
			break;

		case 'edit':
			if($_GET['akce'] == 'ulozit') {
				$galerie->uprav_obrazek($_POST['id']);
				if($_POST['button'] == 'send_exit') { 
			        header('Location: '.ADMIN_PREFIX.'admin/galerie/album/'.$_POST['album']);
			    }
			}
			else {
				$tpl->display(ADMIN_PAGES . $p1 . '/form.tpl');
			}
			break;

		case 'smazat':
			$galerie->smaz_obrazek($id);
			header('Location: '.ADMIN_PREFIX.'admin/galerie/album/'.$_GET['id_alba']);
			break;

		case 'album':
			$tpl->assign('album', $galerie->album($id));
			$tpl->assign('galerie', $galerie->obrazky_v_albu($id));
			$file = "album/default.tpl";
			$tpl->display(ADMIN_PAGES . $p1 .'/'. $file);
			break;

		case 'nove-album':
			if($_GET['akce'] == 'ulozit') {
				$galerie->nove_album();
				if($_POST['button'] == 'send_exit') { 
			    	header('Location: '.ADMIN_PREFIX.'admin/galerie/');
			    }
			}
			else {
				$file = "album/form.tpl"; 
				$tpl->display(ADMIN_PAGES . $p1 .'/'. $file);
			}
			break;

		case 'edit-album':
			if($_GET['akce'] == 'ulozit') {
				$galerie->uprav_album($_POST['id']);
				if($_POST['button'] == 'send_exit') { 
			        header('Location: '.ADMIN_PREFIX.'admin/galerie');
			    }
			}
			else {
				$file = "album/form.tpl";
				$tpl->display(ADMIN_PAGES . $p1 . '/'. $file);
			}
			break;

		case 'smazat-album':
			$galerie->smaz_album($id);
			header('Location: '.ADMIN_PREFIX.'admin/galerie');
			break;

		default:
			$tpl->display(ADMIN_PAGES . $p1 . '/default.tpl');
			break;
	}
?>