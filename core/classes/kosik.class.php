<?php
class kosik {
	private $tpl = null;
	private $web = null;
	private $produkty = null;
	private $cols = array('id','produkt','pocet','uzivatel','datum_cas_vytvoreni','ip');
	private $cols_objednavka_kosik_adresy = array('id', 'ip', 'uzivatel', 'firma', 'jmeno', 'prijmeni', 'ulice', 'mesto', 'psc', 'telefon', 
		'email', 'dod_firma', 'dod_jmeno', 'dod_prijmeni', 'dod_ulice', 'dod_mesto', 'dod_psc', 'dod_telefon_prepravce', 'dod_poznamka_prepravce'
	);
	private $cols_objednavka_kosik_doprava = array('ip', 'uzivatel', 'zpusob_dopravy', 'castka_dopravy', 'zpusob_platby', 'castka_platby');

	public function __construct() {
        include_once "../modules/produkty/produkty.class.php";
		$this->tpl = new web_Smarty;
		$this->web = new web;
		$this->produkty = new produkty;
	}	

	public function doprava() {
		$sql = "select * from doprava";
		foreach($this->web->query($sql) as $row) {
			$doprava[$row['id']]['id'] = $row['id'];
			$doprava[$row['id']]['nazev'] = $row['nazev'];
			$doprava[$row['id']]['cena'] = $row['cena'];
		}
		return $doprava;
	}
	
	public function platba() {
		$sql = "select * from platba";
		foreach($this->web->query($sql) as $row) {
			$platba[$row['id']]['id'] = $row['id'];
			$platba[$row['id']]['nazev'] = $row['nazev'];
			$platba[$row['id']]['cena'] = $row['cena'];
		}
		return $platba;
	}

	public function pridat() {
		$datum = date('Y-m-d H:i:s');
		$ip = $_SERVER['REMOTE_ADDR'];
		$produkt = $_POST['produkt'];
		$mnozstvi = $_POST['mnozstvi'];
		if($_SESSION['logged_customer'] == 1) {
			$uzivatel = $_SESSION['logged_customer_id'];
		}
		else {
			$uzivatel = 0;
		}
		$sql = "select * from objednavka_kosik where uzivatel=".$uzivatel." and produkt=".$produkt." and ip='".$ip."'";
		if($row = $this->web->query($sql,1)) {
			$id = $this->pripocitat_kusy($produkt, $mnozstvi, $uzivatel);
		}
		else {
			$data = array(
				0, $produkt, $mnozstvi, $uzivatel, $datum, $ip
			);
			$this->web->addEntry('objednavka_kosik', $data);
			$this->web->setLastId();
			$id = $this->web->getLastId();
		}
		return $id;
	}

	public function obsah() {
		$kosik = array();
		$ip = $_SERVER['REMOTE_ADDR'];
		if($_SESSION['logged_customer'] == 1) {
			$sql = "select * from objednavka_kosik where uzivatel ='".$_SESSION['logged_customer_id']."'";
		}
		else {
			$sql = "select * from objednavka_kosik where uzivatel = 0 and ip='".$ip."'";
		}
		$castka = 0;
		$polozek = 0;
		foreach($this->web->query($sql) as $row) {
			foreach($this->cols as $col) {
				$kosik['polozky'][$row['id']][$col] = $row[$col];
			}
			$kosik['polozky'][$row['id']]['produkt'] = $this->produkty->produkt($row['produkt']);
			$castka = $castka +  ($kosik['polozky'][$row['id']]['produkt']['cena']*$row['pocet']);
			$polozek = $polozek + 1;
		}
		$kosik['polozek'] = $polozek;
		$kosik['castka'] = $castka;
		$kosik['adresy'] = $this->priradit_adresy_ke_kosiku();
		$kosik['doprava'] = $this->priradit_dopravu_ke_kosiku();
		$kosik['platba'] = $this->priradit_platbu_ke_kosiku();

		return $kosik;
	}

	public function priradit_adresy_ke_kosiku() {
		$ip = $_SERVER['REMOTE_ADDR'];
		if($_SESSION['logged_customer'] == 1) {
			$sql = "select * from objednavka_kosik_adresy where uzivatel ='".$_SESSION['logged_customer_id']."'";
		}
		else {
			$sql = "select * from objednavka_kosik_adresy where uzivatel = 0 and ip='".$ip."'";
		}
		foreach($this->web->query($sql) as $row) {
			foreach($this->cols_objednavka_kosik_adresy as $col) {
				$kosik[$col] = $row[$col];
			}
		}
		return $kosik;
	}

	public function pridat_adresy_do_kosiku($id_zakaznika) {
		$ip = $_SERVER['REMOTE_ADDR'];
		$sql = "select * from objednavka_kosik_adresy where ip='".$ip."' and uzivatel=".$id_zakaznika;
		if($row = $this->web->query($sql,1)) {

		}
		else {
			if($id_zakaznika == 0) {
				$data = array(
					0, $ip, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''
				);
				$this->web->addEntry('objednavka_kosik_adresy', $data);
			}
			else {
				// vzit udaje z registrovaneho zakaznika a vlozit
				$sql = "select * from zakaznici where id=".$id_zakaznika;
				$row = $this->web->query($sql,1);
				$firma = $row['firma'];
				$jmeno = $row['jmeno'];
				$prijmeni = $row['prijmeni'];
				$ulice = $row['ulice'];
				$mesto = $row['mesto'];
				$psc = $row['psc'];
				$telefon = $row['telefon'];
				$email = $row['email'];
				$dod_firma = $row['dod_firma'];
				$dod_jmeno = $row['dod_jmeno'];
				$dod_prijmeni = $row['dod_prijmeni'];
				$dod_ulice = $row['dod_ulice'];
				$dod_mesto = $row['dod_mesto'];
				$dod_psc = $row['dod_psc'];
				$dod_telefon_prepravce = $row['dod_telefon_prepravce'];
				$dod_poznamka_prepravce = $row['dod_poznamka_prepravce'];
				$data = array (
					0, $ip, $id_zakaznika, $firma, $jmeno, $prijmeni, $ulice, $mesto, $psc, $telefon, $email, $dod_firma, $dod_jmeno, $dod_prijmeni, $dod_ulice, $dod_mesto, 
					$dod_psc, $dod_telefon_prepravce, $dod_poznamka_prepravce
				);
				$this->web->addEntry('objednavka_kosik_adresy', $data);
			}
		}
	}

	public function upravit_adresy_v_kosiku($uzivatel) {
		if($_SESSION['logged_customer'] == 1) { 
			$id_zakaznika = $_SESSION['logged_customer_id'];
		} else { 
			$id_zakaznika = 0;
		}
		$ip = $_SERVER['REMOTE_ADDR'];
		$data = array(
			'uzivatel' => $id_zakaznika,
			'firma' => $_POST['firma'], 
			'jmeno' => $_POST['jmeno'], 
			'prijmeni' => $_POST['prijmeni'], 
			'ulice' => $_POST['ulice'], 
			'mesto' => $_POST['mesto'], 
			'psc' => $_POST['psc'], 
			'telefon' => $_POST['telefon'], 
			'email' => $_POST['email'], 
			'dod_firma' => $_POST['dod_firma'], 
			'dod_jmeno' => $_POST['dod_jmeno'], 
			'dod_prijmeni' => $_POST['dod_prijmeni'], 
			'dod_ulice' => $_POST['dod_ulice'], 
			'dod_mesto' => $_POST['dod_mesto'], 
			'dod_psc' => $_POST['dod_psc'], 
			'dod_telefon_prepravce' => $_POST['dod_telefon_prepravce'], 
			'dod_poznamka_prepravce' => $_POST['dod_poznamka_prepravce']
		);	
		if($_SESSION['logged_customer'] == 1) { 
			$this->web->editEntries('objednavka_kosik_adresy', $data, "uzivatel=".$_SESSION['logged_customer_id']." and ip='".$ip."'");	
		} else { 
			$this->web->editEntries('objednavka_kosik_adresy', $data, "uzivatel=0 and ip='".$ip."'");	
		}
	}

	public function priradit_uzivatele_ke_kosiku($id_zakaznika) {
		$kosik = array();
		$ip = $_SERVER['REMOTE_ADDR'];
		$sql = "select * from objednavka_kosik where ip='".$ip."' and uzivatel=0";
		foreach($this->web->query($sql) as $row) {
			$data = array(
				'uzivatel' => $id_zakaznika,
			);
			$this->web->editEntries('objednavka_kosik', $data, 'id='.$row['id']);
		}		
	}

	public function pridatDopravuPlatbu() {
		$ip = $_SERVER['REMOTE_ADDR'];

		$sql = "select * from doprava where id=".$_POST['doprava'];
		$row = $this->web->query($sql,1);
		$zpusob_doprava = $row['id'];
		$castka_doprava = $row['cena'];
		
		$sql = "select * from platba where id=".$_POST['platba'];
		$row2 = $this->web->query($sql,1);
		$zpusob_platba = $row2['id'];
		$castka_platba = $row2['cena'];
		
		if($_SESSION['logged_customer'] == 1) { $uzivatel = $_SESSION['logged_customer_id']; } else { $uzivatel = 0; }
		
		$data = array($ip,$uzivatel,$zpusob_doprava,$castka_doprava,$zpusob_platba,$castka_platba);
		$this->web->addEntry('objednavka_kosik_doprava', $data);
	}

	public function upravitDopravuPlatbu() {
		$ip = $_SERVER['REMOTE_ADDR'];
		
		$sql = "select * from doprava where id=".$_POST['doprava'];
		$row = $this->web->query($sql,1);
		$zpusob_doprava = $row['id'];
		$castka_doprava = $row['cena'];
		
		$sql = "select * from platba where id=".$_POST['platba'];
		$row2 = $this->web->query($sql,1);
		$zpusob_platba = $row2['id'];
		$castka_platba = $row2['cena'];
		
		if($_SESSION['logged_customer'] == 1) { $uzivatel = $_SESSION['logged_customer_id']; } else { $uzivatel = 0; }
		$data = array(
			'zpusob_dopravy' => $zpusob_doprava,
			'castka_dopravy' => $castka_doprava,
			'zpusob_platby' => $zpusob_platba,
			'castka_platby' => $castka_platba
		);
		$this->web->editEntries('objednavka_kosik_doprava', $data, "ip='".$ip."' and uzivatel=".$uzivatel);
	}

	public function priradit_dopravu_ke_kosiku() {
		$ip = $_SERVER['REMOTE_ADDR'];
		if($_SESSION['logged_customer'] == 1) { $uzivatel = $_SESSION['logged_customer_id']; } else { $uzivatel = 0; }
		$sql = "select * from objednavka_kosik_doprava where ip='".$ip."' and uzivatel=".$uzivatel."";
		if($row = $this->web->query($sql,1)) {
			$sql = "SELECT * FROM doprava WHERE id=".$row['zpusob_dopravy'];
			$row2 = $this->web->query($sql,1);
			$doprava['id_dopravy'] = $row2['id'];
			$doprava['zpusob_dopravy'] = $row2['nazev'];
			$doprava['cena_dopravy'] = $row['castka_dopravy'];
			return $doprava;
		}
	}

	public function priradit_platbu_ke_kosiku() {
		$ip = $_SERVER['REMOTE_ADDR'];
		if($_SESSION['logged_customer'] == 1) { $uzivatel = $_SESSION['logged_customer_id']; } else { $uzivatel = 0; }
		$sql = "select * from objednavka_kosik_doprava where ip='".$ip."' and uzivatel=".$uzivatel."";
		if($row = $this->web->query($sql,1)) {
			$sql = "select * from platba where id=".$row['zpusob_platby'];
			$row2 = $this->web->query($sql,1);
			$platba['id_platby'] = $row2['id'];
			$platba['zpusob_platby'] = $row2['nazev'];
			$platba['cena_platby'] = $row['castka_platby'];
			return $platba;
		}
	}

	public function prepocitat_polozky() {
		foreach($_POST['pocet'] as $key => $value) {
			if($value==0) {
				$this->web->deleteEntryById('objednavka_kosik', $key);
			}
			else {
				$data = array('pocet' => $value);
				$this->web->editEntries('objednavka_kosik', $data, 'id='.$key);
			}
		}
	}

	public function pripocitat_kusy($polozka, $pocet_kusu, $uzivatel) {
		$ip = $_SERVER['REMOTE_ADDR'];
		if($_SESSION['logged_customer'] == 1) {
			$sql = "select * from objednavka_kosik where produkt=".$polozka." and uzivatel=".$uzivatel;
		}
		else {
			$sql = "select * from objednavka_kosik where produkt=".$polozka." and uzivatel=".$uzivatel." and ip='".$ip."'";
		}
		$row = $this->web->query($sql,1);
		$pocet = $row['pocet'];
		$novy_pocet = $pocet + $pocet_kusu;
		$data = array('pocet' => $novy_pocet);
		if($_SESSION['logged_customer'] == 1) {
			$this->web->editEntries('objednavka_kosik', $data, 'produkt='.$polozka.' and uzivatel='.$uzivatel);
		}
		else {
			$this->web->editEntries('objednavka_kosik', $data, "produkt=".$polozka." and uzivatel=".$uzivatel." and ip='".$ip."'");
		}
		$id = $row['id'];
		return $id;
	}

	public function smazat_polozku($polozka) {
		$this->web->deleteEntryById('objednavka_kosik', $polozka);
	}

	public function vlozKosikObjednavka($id_objednavky, $ip) {
		// vlozeni polozek z kosiku do objednavky
		$kosik = array();
		if($_SESSION['logged_customer'] == 1) {
			$sql = "select * from objednavka_kosik where uzivatel ='".$_SESSION['logged_customer_id']."'";
		}
		else {
			$sql = "select * from objednavka_kosik where uzivatel = 0 and ip='".$ip."'";
		}
		foreach($this->web->query($sql) as $row) {
			foreach($this->cols as $col) {
				$kosik[$row['id']][$col] = $row[$col];
				$$col = $row[$col];
			}
			$produkt2 = $this->produkty->produkt($row['produkt']);
			$cena_ks = $produkt2['cena'];
			$data = array(0, $id_objednavky, $produkt, $pocet, $cena_ks);
			$this->web->addEntry('objednavka_polozky', $data);
		}
	}

	public function vlozDopravaKosikObjednavka($id_objednavky, $ip) {
		// vlozeni dopravy a platby z kosiku do objednavky
		$doprava = array();
		if($_SESSION['logged_customer'] == 1) {
			$sql = "select * from objednavka_kosik_doprava where uzivatel ='".$_SESSION['logged_customer_id']."'";
		}
		else {
			$sql = "select * from objednavka_kosik_doprava where uzivatel = 0 and ip='".$ip."'";
		}
		foreach($this->web->query($sql) as $row) {
			foreach($this->cols_objednavka_kosik_doprava as $col) {
				$doprava[$row['id']][$col] = $row[$col];
				$$col = $row[$col];
			}
			$data = array($id_objednavky, $ip, $_SESSION['logged_customer_id'], $zpusob_dopravy, $castka_dopravy, $zpusob_platby, $castka_platby);
			$this->web->addEntry('objednavka_doprava', $data);
		}
	}

	public function vlozAdresyKosikObjednavka($id_objednavky, $ip) {
		// vlozeni adres z kosiku do objednavky
		$doprava = array();
		if($_SESSION['logged_customer'] == 1) {
			$sql = "select * from objednavka_kosik_adresy where uzivatel ='".$_SESSION['logged_customer_id']."'";
		}
		else {
			$sql = "select * from objednavka_kosik_adresy where uzivatel = 0 and ip='".$ip."'";
		}
		foreach($this->web->query($sql) as $row) {
			foreach($this->cols_objednavka_kosik_adresy as $col) {
				$doprava[$row['id']][$col] = $row[$col];
				$$col = $row[$col];
			}
			$data = array(
				0, $id_objednavky, $ip, $_SESSION['logged_customer_id'], $firma, $jmeno, $prijmeni, $ulice, $mesto, $psc, $telefon, 
				$email, $dod_firma, $dod_jmeno, $dod_prijmeni, $dod_ulice, $dod_mesto, $dod_psc, $dod_telefon_prepravce, $dod_poznamka_prepravce
			);
			$this->web->addEntry('objednavka_adresy', $data);
		}
	}

	public function ulozit_objednavku() {
		// pridani nove objednavky
		$datum = date('Y-m-d H:i:s');
		$ip = $_SERVER['REMOTE_ADDR'];
		$data = array(0, $_SESSION['logged_customer_id'], $datum, $ip, 'nova');
		$this->web->addEntry('objednavka', $data);
		$this->web->setLastId();
		$id_objednavky = $this->web->getLastId();
		$this->vlozKosikObjednavka($id_objednavky, $ip);
		$this->vlozDopravaKosikObjednavka($id_objednavky, $ip);
		$this->vlozAdresyKosikObjednavka($id_objednavky, $ip);
		$this->vymazKosik($ip);
	}

	public function vymazKosik($ip) {
		if($_SESSION['logged_customer'] == 1) {
			$this->web->deleteEntry('objednavka_kosik',"uzivatel ='".$_SESSION['logged_customer_id']."'");
			$this->web->deleteEntry('objednavka_kosik_adresy',"uzivatel ='".$_SESSION['logged_customer_id']."'");
			$this->web->deleteEntry('objednavka_kosik_doprava',"uzivatel ='".$_SESSION['logged_customer_id']."'");
		}
		else {
			$this->web->deleteEntry('objednavka_kosik',"uzivatel = 0 and ip ='".$ip."'");
			$this->web->deleteEntry('objednavka_kosik_adresy',"uzivatel = 0 and ip ='".$ip."'");
			$this->web->deleteEntry('objednavka_kosik_doprava',"uzivatel = 0 and ip ='".$ip."'");
		}
	}

}
?>