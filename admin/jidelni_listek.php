<?php 	
	$tpl->assign('jidelni_listek', $jidelni_listek->jidelni_listek());

	$file = "default.tpl";
		
    if(!empty($_GET['p4'])) { $tpl->assign('aktualni_polozka', $jidelni_listek->detail_jidelni_listek($_GET['p4'])); }

	if($p2 == "vlozit_kategorii") {
		$jidelni_listek->nova_kategorie();
		header('Location: /admin/jidelni_listek');
	}
	elseif($p2 == "pridat_polozku") {
		$jidelni_listek->nova_polozka();
		header('Location: /admin/jidelni_listek');
	}
	elseif($p2 == "smazat_polozku") {
		$jidelni_listek->smazat_polozku($id);
		header('Location: /admin/jidelni_listek');
	}
	elseif($p2 == "upravit_polozku") {
		$jidelni_listek->upravit_polozku($id);
		header('Location: /admin/jidelni_listek');
	}
	else {
    	$tpl->display(ADMIN_PAGES . $p1.'/'.$p2.'/'.$file);
	}
	
?>