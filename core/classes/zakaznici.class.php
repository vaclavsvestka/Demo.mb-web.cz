<?php
class zakaznici {
	private $tpl = null;
	private $web = null;
	private $userId = null;
	private $kosik = null;
	private $cols = array('id','registrovan','firma','jmeno','prijmeni','ulice','mesto','psc','telefon','email','status','registrace','poznamka','newsletter','dod_firma','dod_jmeno',
			'dod_prijmeni', 'dod_ulice', 'dod_mesto', 'dod_psc', 'dod_telefon_prepravce','dod_poznamka_prepravce'
		);
	
	public function __construct() {
  		include_once ROOT . "core/classes/kosik.class.php";
		$this->tpl = new web_Smarty;
		$this->web = new web;
	}

	public function seznam_zakazniku() {
		$zakaznici = array();
		$sql = "select * from zakaznici order by jmeno asc, prijmeni asc, firma asc ";
		foreach ($this->web->query($sql) as $row) {
			foreach($this->cols as $col) {
				$zakaznici[$row['id']][$col] = $row[$col];
			}
			$sql = "select * from zakaznici_login where id_zakaznika=".$row['id'];
			$row2 = $this->web->query($sql,1);
			$zakaznici[$row['id']]['user'] = $row2['user'];
		}
		return $zakaznici;
	}

	public function zakaznik($id) {
		$zakaznik = array();
		$sql = "select * from zakaznici where id=".$id;
		foreach($this->web->query($sql) as $row) {
			foreach($this->cols as $col) {
				$zakaznik[$col] = $row[$col];
			}
			$sql = "select * from zakaznici_login where id_zakaznika=".$row['id'];
			$row2 = $this->web->query($sql,1);
			$zakaznik['user'] = $row2['user'];
		}
		return $zakaznik;
	}

	public function pridat($reg) {
		if($reg==1) { $datum = date('Y-m-d'); 
			if($_POST['newsletter'] == "on") {
				$newsletter=1; 
			}
			else {
				$newsletter=0; 				
			}
		} else { 
			$datum = 0; $newsletter = 0; 
		}

		$data = array(
			0, $reg, $_POST['firma'], $_POST['jmeno'], $_POST['prijmeni'], $_POST['ulice'], $_POST['mesto'], $_POST['psc'], $_POST['telefon'],
			$_POST['email'], $_POST['status'], $datum, $_POST['poznamka'], $newsletter, $_POST['dod_firma'], $_POST['dod_jmeno'], 
			$_POST['dod_prijmeni'], $_POST['dod_ulice'], $_POST['dod_mesto'], $_POST['dod_psc'], $_POST['dod_telefon_prepravce'], 
			$_POST['dod_poznamka_prepravce']
		);
		$this->web->addEntry('zakaznici', $data);
		$this->web->setLastId();
		$id = $this->web->getLastId();

		if($reg == 1) {
			$pass = md5($_POST['password1']);
			$data = array(
				$id, $_POST['user'], $pass
			);
			$this->web->addEntry('zakaznici_login', $data);
		}
		return $id;	
	}

	public function userNameControl($name) {
		$sql = "select * from zakaznici_login where user='".$name."'";
		if($row = $this->web->query($sql,1)) {
			return TRUE;
		}
		else {
			return FALSE;
		}
	}

	public function edit($id) {
		$datum = date('Y-m-d H:i:s');
		$odkaz = $this->web->nice_url($_POST['nazev']);
		$data = array(
			'firma' => $_POST['firma'], 
			'jmeno' => $_POST['jmeno'], 
			'prijmeni' => $_POST['prijmeni'], 
			'ulice' => $_POST['ulice'], 
			'mesto' => $_POST['mesto'], 
			'psc' => $_POST['psc'], 
			'telefon' => $_POST['telefon'], 
			'email' => $_POST['email'], 
			'status' => $_POST['status'], 
			'poznamka' => $_POST['poznamka'], 
			'newsletter' => $_POST['newsletter'], 
			'dod_firma' => $_POST['dod_firma'], 
			'dod_jmeno' => $_POST['dod_jmeno'], 
			'dod_prijmeni' => $_POST['dod_prijmeni'], 
			'dod_ulice' => $_POST['dod_ulice'], 
			'dod_mesto' => $_POST['dod_mesto'], 
			'dod_psc' => $_POST['dod_psc'], 
			'dod_telefon_prepravce' => $_POST['dod_telefon_prepravce'],
			'dod_poznamka_prepravce' => $_POST['dod_poznamka_prepravce'], 
		);
		$this->web->editEntries('zakaznici', $data, 'id='.$id);
	}

	public function smazat($id) {
		$this->web->deleteEntryById('zakaznici', $id);
		$this->web->deleteEntry('zakaznici_login', 'id_zakaznika='.$id);
	}

	public function login() {
		$kosik = new kosik;
		$user = $_POST['user'];
		$pass = md5($_POST['pass']);
		$sql = "select * from zakaznici_login where user = '".$user."' and pass = '".$pass."'";
		if($row = $this->web->query($sql,1)) {
			$_SESSION['logged_customer'] = 1;
			$_SESSION['logged_customer_name'] = $row['user'];
			$_SESSION['logged_customer_id'] = $row['id_zakaznika'];
        	$kosik->priradit_uzivatele_ke_kosiku($row['id_zakaznika']);
			return true;
		}
		else {
			return false;
		}
	}

	public function loginById($id) {
		$kosik = new kosik;
		$sql = "select * from zakaznici_login where id_zakaznika = '".$id."'";
		$row = $this->web->query($sql,1);
		$_SESSION['logged_customer'] = 1;
		$_SESSION['logged_customer_name'] = $row['user'];
		$_SESSION['logged_customer_id'] = $row['id_zakaznika'];
		$kosik->priradit_uzivatele_ke_kosiku($row['id_zakaznika']);
	}

}
?>