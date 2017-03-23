<?php  
	if(!empty($modules['seznamy'])) {
		if($modules['seznamy']['enable'] == 1) {
		    $menu['seznamy']['nazev'] = "Seznamy";
		    $menu['seznamy']['ikona'] = "fa-list";
		    $menu['seznamy']['odkaz'] = "seznamy";
		    $menu['seznamy']['prava_nazev'] = "seznamy";
		}
	}
	if(!empty($modules['clanky'])) {
		if($modules['clanky']['enable'] == 1) {
		    $menu['clanky']['nazev'] = "Články";
		    $menu['clanky']['ikona'] = "fa-newspaper-o";
		    $menu['clanky']['odkaz'] = "clanky";
		    $menu['clanky']['prava_nazev'] = "clanky_seznam";
		}
	}
	if(!empty($modules['blog'])) {
		if($modules['blog']['enable'] == 1) {
		    $menu['blog']['nazev'] = "Blog";
		    $menu['blog']['ikona'] = "fa-book";
		    $menu['blog']['odkaz'] = "blog";
		    $menu['blog']['prava_nazev'] = "blog_seznam";
		}
	}

	if(!empty($modules['galerie'])) {
		if($modules['galerie']['enable'] == 1) {
		    $menu['galerie']['nazev'] = "Galerie";
		    $menu['galerie']['ikona'] = "fa-picture-o";
		    $menu['galerie']['odkaz'] = "galerie";
		    $menu['galerie']['prava_nazev'] = "galerie";
		}
	}
	if(!empty($modules['jidelni_listek'])) {
		if($modules['jidelni_listek']['enable'] == 1) {
			$menu['jidelni_listek']['nazev'] = "Jídelní a nápojový lístek";
			$menu['jidelni_listek']['ikona'] = "fa-beer";
			$menu['jidelni_listek']['odkaz'] = "jidelni_listek";
			$menu['jidelni_listek']['prava_nazev'] = "jidelni_listek";    	
	    }
	}
	if(!empty($modules['kontakty'])) {
	    if($modules['kontakty']['enable'] == 1) {
			$menu['kontakty']['nazev'] = "Kontakty";
			$menu['kontakty']['ikona'] = "fa-phone";
			$menu['kontakty']['odkaz'] = "kontakty";
			$menu['kontakty']['prava_nazev'] = "nastaveni_kontakty";    	
		}
	}
	if(!empty($modules['pokoje'])) {
	    if($modules['pokoje']['enable'] == 1) {
			$menu['pokoje']['nazev'] = "Pokoje";
			$menu['pokoje']['ikona'] = "fa-key";
			$menu['pokoje']['odkaz'] = "pokoje";
			$menu['pokoje']['prava_nazev'] = "pokoje";    	
	    }
	}
	if(!empty($modules['rezervace'])) {
	    if($modules['rezervace']['enable'] == 1) {
			$menu['rezervace']['nazev'] = "Rezervace";
			$menu['rezervace']['ikona'] = "fa-money";
			$menu['rezervace']['odkaz'] = "rezervace";
			$menu['rezervace']['prava_nazev'] = "rezervace";    	
	    }
	}
	if(!empty($modules['objednavky'])) {
		if($modules['objednavky']['enable'] == 1) {
			$menu['objednavky']['nazev'] = "Objednávky";
			$menu['objednavky']['ikona'] = "fa-credit-card";
			$menu['objednavky']['odkaz'] = "objednavky";
			$menu['objednavky']['prava_nazev'] = "objednavky";    	
	    }
	}
	if(!empty($modules['produkty'])) {
	    if($modules['produkty']['enable'] == 1) {
	    	$menu['produkty_seznam']['nazev'] = "Produkty";
			$menu['produkty_seznam']['ikona'] = "fa-cube";
			$menu['produkty_seznam']['podmenu'] = 1;
			$menu['produkty_seznam']['podmenu_polozky'][1]['nazev'] = "Seznam produktů";
			$menu['produkty_seznam']['podmenu_polozky'][1]['ikona'] = "fa-cube";
			$menu['produkty_seznam']['podmenu_polozky'][1]['odkaz'] = "produkty/seznam";
			$menu['produkty_seznam']['podmenu_polozky'][1]['prava_nazev'] = "produkty_seznam";
			$menu['produkty_seznam']['podmenu_polozky'][2]['nazev'] = "Kategorie produktů";
			$menu['produkty_seznam']['podmenu_polozky'][2]['ikona'] = "fa-tags";
			$menu['produkty_seznam']['podmenu_polozky'][2]['odkaz'] = "produkty/kategorie";
			$menu['produkty_seznam']['podmenu_polozky'][2]['prava_nazev'] = "produkty_kategorie";
			$menu['produkty_seznam']['podmenu_polozky'][3]['nazev'] = "Parametry produktů";
			$menu['produkty_seznam']['podmenu_polozky'][3]['ikona'] = "fa-cogs";
			$menu['produkty_seznam']['podmenu_polozky'][3]['odkaz'] = "produkty/parametry";
			$menu['produkty_seznam']['podmenu_polozky'][3]['prava_nazev'] = "produkty_parametry";
			$menu['produkty_seznam']['podmenu_polozky'][4]['nazev'] = "Značky produktů";
			$menu['produkty_seznam']['podmenu_polozky'][4]['ikona'] = "fa-copyright";
			$menu['produkty_seznam']['podmenu_polozky'][4]['odkaz'] = "produkty/znacky";
			$menu['produkty_seznam']['podmenu_polozky'][4]['prava_nazev'] = "produkty_znacky";
	    }
	}
	if(!empty($modules['zakaznici'])) {
		if($modules['zakaznici']['enable'] == 1) {
			$menu['zakaznici']['nazev'] = "Zákazníci";
			$menu['zakaznici']['ikona'] = "fa-users";
			$menu['zakaznici']['odkaz'] = "zakaznici";
			$menu['zakaznici']['prava_nazev'] = "zakaznici";    	
	    }
	}
	if(!empty($modules['knihovna'])) {
	    if($modules['knihovna']['enable'] == 1) {
			$menu['knihovna']['nazev'] = "Knihovna souborů";
			$menu['knihovna']['ikona'] = "fa-folder-o";
			$menu['knihovna']['odkaz'] = "knihovna";
			$menu['knihovna']['prava_nazev'] = "knihovna";    	
	    }
	}
?>