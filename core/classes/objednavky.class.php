<?php
class objednavky {
	private $tpl = null;
	private $web = null;
	private $produkty = null;
	private $userId = null;
	private $cols_objednavka = array('id','uzivatel','datum_cas_vytvoreni','ip','status');
	private $cols_objednavka_polozky = array('id','id_objednavky','produkt','pocet','cena_ks');
	private $cols_objednavka_adresy = array('id','id_objednavky','ip','uzivatel','firma','jmeno','prijmeni','ulice','mesto','psc','telefon','email','dod_firma', 'dod_jmeno','dod_prijmeni','dod_ulice','dod_mesto','dod_psc','dod_telefon_prepravce','dod_poznamka_prepravce');
	private $cols_objednavka_doprava = array('id_objednavky','ip','uzivatel','zpusob_dopravy','castka_dopravy','zpusob_platby','castka_platby');
	
	public function __construct() {
        include_once CLASSES . "produkty.class.php";
		$this->tpl = new web_Smarty;
		$this->web = new web;
		$this->produkty = new produkty;
	}

	public function seznam_objednavek() {
		$sql = "select * from objednavka";
		foreach($this->web->query($sql) as $row) {
			foreach($this->cols_objednavka as $col) {
				$objednavky[$row['id']][$col] = $row[$col];
			}
			$objednavky[$row['id']]['polozky'] = $this->polozky_objednavky($row['id']);
			$objednavky[$row['id']]['adresy'] = $this->adresy_objednavky($row['id']);
			$objednavky[$row['id']]['doprava'] = $this->doprava_objednavky($row['id']);
			$objednavky[$row['id']]['castka_s_dopravou'] = $this->cena_objednavky($row['id']);

		} 
		return $objednavky;
	}

	public function seznam_objednavek_zakaznika($zakaznik) {
		$sql = "select * from objednavka where uzivatel = ".$zakaznik;
		foreach($this->web->query($sql) as $row) {
			foreach($this->cols_objednavka as $col) {
				$objednavky[$row['id']][$col] = $row[$col];
			}
			$objednavky[$row['id']]['polozky'] = $this->polozky_objednavky($row['id']);
			$objednavky[$row['id']]['adresy'] = $this->adresy_objednavky($row['id']);
			$objednavky[$row['id']]['doprava'] = $this->doprava_objednavky($row['id']);
			$objednavky[$row['id']]['castka_s_dopravou'] = $this->cena_objednavky($row['id']);

		} 
		return $objednavky;
	}
	
	public function objednavka($id_objednavky) {
		$sql = "select * from objednavka where id=".$id_objednavky;
		$row = $this->web->query($sql,1);
		foreach($this->cols_objednavka as $col) {
			$objednavky[$col] = $row[$col];
		}
		$objednavky['polozky'] = $this->polozky_objednavky($row['id']);
		$objednavky['adresy'] = $this->adresy_objednavky($row['id']);
		$objednavky['doprava'] = $this->doprava_objednavky($row['id']);
		$objednavky['castka_s_dopravou'] = $this->cena_objednavky($row['id']);
		return $objednavky;
	}

	public function polozky_objednavky($id_objednavky) {
		$sql = "select * from objednavka_polozky where id_objednavky=".$id_objednavky;
		foreach($this->web->query($sql) as $row) {
			foreach($this->cols_objednavka_polozky as $col) {
				$polozky[$row['id']][$col] = $row[$col];
			}
			$polozky[$row['id']]['produkt'] = $this->produkty->produkt($row['produkt']);
		}
		return $polozky;
	}

	public function adresy_objednavky($id_objednavky) {
		$sql = "select * from objednavka_adresy where id_objednavky=".$id_objednavky;
		$row = $this->web->query($sql,1);
		foreach($this->cols_objednavka_adresy as $col) {
			$adresy[$col] = $row[$col];
		}
		return $adresy;
	}

	public function doprava_objednavky($id_objednavky) {
		$sql = "select * from objednavka_doprava where id_objednavky=".$id_objednavky;
		$row = $this->web->query($sql,1);
		foreach($this->cols_objednavka_doprava as $col) {
			$doprava[$col] = $row[$col];
		}
		return $doprava;
	}

	public function cena_objednavky($id_objednavky) {
		$celkem = 0;
		// vypocet cen polozek
		$sql = "select * from objednavka_polozky where id_objednavky=".$id_objednavky;
		foreach($this->web->query($sql) as $row) {
			$sql = "select * from produkty where id = ".$row['produkt'];
			$d = $this->web->query($sql,1);
			$dph = $d['dph'];
			$sazba = (1+($dph/100));
			$celkem = $celkem + ($row['pocet']*$row['cena_ks']*$sazba);
		}
		// pricteni dopravneho
		$sql = "select * from objednavka_doprava where id_objednavky=".$id_objednavky;
		$row = $this->web->query($sql,1);
		$cena_dopravy = $row['castka_platby']+$row['castka_dopravy'];
		$celkem = $celkem + $cena_dopravy;
		return $celkem;
	}

	public function zmenit_stav_objednavky($id_objednavky) {
		$status = $_POST['status'];
		$data = array('status'=> $status);
		$this->web->editEntries('objednavka', $data, 'id='.$id_objednavky);
		$objednavka = $this->objednavka($id_objednavky);
		$komu = $objednavka['adresy']['email'];
		switch ($status) {
			case 'Objednávka zaplacena':
				$this->mail_zaplacena($komu, $id_objednavky);
				break;
			case 'Objednávka expedována':
				$this->mail_expedice($komu, $id_objednavky);
				break;
			case 'Objednávka nezaplacena':
				$this->mail_nezaplacena($komu, $id_objednavky);
				break;
			case 'Objednávka stornována':
				$this->mail_stornovana($komu, $id_objednavky);
				break;
		}
	}

	public function zmenit_dodaci_adresu($id_objednavky) {
		$data = array(
			'firma'=> $_POST['firma'],
			'jmeno'=> $_POST['jmeno'],
			'prijmeni'=> $_POST['prijmeni'],
			'ulice'=> $_POST['ulice'],
			'mesto'=> $_POST['mesto'],
			'psc'=> $_POST['psc'],
			'telefon'=> $_POST['telefon'],
			'email'=> $_POST['email'],
		);
		$this->web->editEntries('objednavka_adresy', $data, 'id_objednavky='.$id_objednavky);
	}

	public function zmenit_fakturacni_adresu($id_objednavky) {
		$data = array(
			'dod_firma'=> $_POST['dod_firma'],
			'dod_jmeno'=> $_POST['dod_jmeno'],
			'dod_prijmeni'=> $_POST['dod_prijmeni'],
			'dod_ulice'=> $_POST['dod_ulice'],
			'dod_mesto'=> $_POST['dod_mesto'],
			'dod_psc'=> $_POST['dod_psc'],
		);
		$this->web->editEntries('objednavka_adresy', $data, 'id_objednavky='.$id_objednavky);
	}

	public function zmenit_polozku($id_polozky) {
		$data = array(
			'pocet' => $_POST['pocet'],
			'cena_ks' => $_POST['cena_ks'],
		);
		$this->web->editEntries('objednavka_polozky', $data, 'id='.$id_polozky);
	}

	public function smazat_polozku($id_polozky) {
		$this->web->deleteEntryById('objednavka_polozky', $id_polozky);
	}

	public function smazat($id) {
		$this->web->deleteEntryBy('objednavka', 'id', $id);
		$this->web->deleteEntryBy('objednavka_adresy', 'id_objednavky', $id);
		$this->web->deleteEntryBy('objednavka_doprava', 'id_objednavky', $id);
		$this->web->deleteEntryBy('objednavka_polozky', 'id_objednavky', $id);
	}

	/**
	* @param komu
	* @param cislo_objednavky
	**/
	public function odeslat_potvrzeni_objednavky($komu, $cislo_objednavky) {
		$objednavka = $this->objednavka($cislo_objednavky);
        $subject = "Přijetí objednávky č. ".$cislo_objednavky." - ProtanCzech.cz";
        $headers = "From: ProtanCzech.cz <no-reply@protanczech.cz>" . "\r\n";
        $headers.= "MIME-Version: 1.0\r\n";
        $headers.= "Content-Type: text/html; charset=UTF-8\r\n";
		$this->tpl->assign('objednavka', $objednavka);
		$message = $this->tpl->fetch(ADMIN_PAGES . 'emaily/prijeti-objednavky.tpl');
    	mail($komu, '=?utf-8?B?'.base64_encode($subject).'?=', $message, $headers);
	}

	/**
	* @param komu
	* @param cislo_objednavky
	**/
	public function mail_expedice($komu, $cislo_objednavky) {
		$objednavka = $this->objednavka($cislo_objednavky);
        $subject = "Objednávka č. ".$cislo_objednavky." byla expedována - ProtanCzech.cz";
        $headers = "From: ProtanCzech.cz <no-reply@protanczech.cz>" . "\r\n";
        $headers.= "MIME-Version: 1.0\r\n";
        $headers.= "Content-Type: text/html; charset=UTF-8\r\n";
		$this->tpl->assign('objednavka', $objednavka);
		$message = $this->tpl->fetch(ADMIN_PAGES . 'emaily/expedice.tpl');
    	mail($komu, '=?utf-8?B?'.base64_encode($subject).'?=', $message, $headers);
	}

	/**
	* @param komu
	* @param cislo_objednavky
	**/
	public function mail_zaplacena($komu, $cislo_objednavky) {
		$objednavka = $this->objednavka($cislo_objednavky);
        $subject = "Objednávka č. ".$cislo_objednavky." byla zaplacena - ProtanCzech.cz";
        $headers = "From: ProtanCzech.cz <no-reply@protanczech.cz>" . "\r\n";
        $headers.= "MIME-Version: 1.0\r\n";
        $headers.= "Content-Type: text/html; charset=UTF-8\r\n";
		$this->tpl->assign('objednavka', $objednavka);
		$message = $this->tpl->fetch(ADMIN_PAGES . 'emaily/zaplaceni.tpl');
    	mail($komu, '=?utf-8?B?'.base64_encode($subject).'?=', $message, $headers);
	}

	/**
	* @param komu
	* @param cislo_objednavky
	**/
	public function mail_nezaplacena($komu, $cislo_objednavky) {
		$objednavka = $this->objednavka($cislo_objednavky);
        $subject = "Objednávka č. ".$cislo_objednavky." není stále zaplacena - ProtanCzech.cz";
        $headers = "From: ProtanCzech.cz <no-reply@protanczech.cz>" . "\r\n";
        $headers.= "MIME-Version: 1.0\r\n";
        $headers.= "Content-Type: text/html; charset=UTF-8\r\n";
		$this->tpl->assign('objednavka', $objednavka);
		$message = $this->tpl->fetch(ADMIN_PAGES . 'emaily/nezaplaceni.tpl');
    	mail($komu, '=?utf-8?B?'.base64_encode($subject).'?=', $message, $headers);
	}

	/**
	* @param komu
	* @param cislo_objednavky
	**/
	public function mail_stornovana($komu, $cislo_objednavky) {
		$objednavka = $this->objednavka($cislo_objednavky);
        $subject = "Objednávka č. ".$cislo_objednavky." byla stornována - ProtanCzech.cz";
        $headers = "From: ProtanCzech.cz <no-reply@protanczech.cz>" . "\r\n";
        $headers.= "MIME-Version: 1.0\r\n";
        $headers.= "Content-Type: text/html; charset=UTF-8\r\n";
		$this->tpl->assign('objednavka', $objednavka);
		$message = $this->tpl->fetch(ADMIN_PAGES . 'emaily/storno.tpl');
    	mail($komu, '=?utf-8?B?'.base64_encode($subject).'?=', $message, $headers);
	}

}
?>