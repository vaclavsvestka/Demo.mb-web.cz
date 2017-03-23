<?php
class uzivatele {
	private $tpl = null;
	private $web = null;
	private $userId = null;
	private $cols = array('id', 'username', 'password', 'name', 'surname', 'email', 'admin_group', 'registration', 'last_login', 'ip');
	private $cols_skupiny = array('id','name');
	private $cols_logins = array('id', 'user_id', 'datetime', 'ip');
	private $cols_prava = array(
		'id','id_skupiny', 'clanky', 'clanky_kategorie','clanky_seznam','nastaveni','nastaveni_menu', 'nastaveni_uzivatele',
		'nastaveni_bloky', 'nastaveni_kontakty','nastaveni_jazyky','produkty','produkty_kategorie','produkty_seznam','produkty_parametry', 'produkty_znacky',
		'sortiment','sortiment_obory','sortiment_dodavatele','pokoje','objednavky','rezervace','zakaznici','knihovna','navstevnost',
		'diskuze','ukoly','poznamky','kalendar','jidelni_listek','seznamy','galerie','blog_seznam'
	);
	
	public function __construct() {
		$this->tpl = new web_Smarty;
		$this->web = new web;
	}

	public function seznam() {
		$uzivatele = array();
		$sql = "select * from uzivatele";
		foreach ($this->web->query($sql) as $row) {
			foreach($this->cols as $col) {
				$uzivatele[$row['id']][$col] = $row[$col];
				$sql = "select * from uzivatele_skupiny where id=".$row['admin_group'];
				$row2 = $this->web->query($sql,1);
				$uzivatele[$row['id']]['skupina'] = $row2['name'];
			}

		}
		return $uzivatele;
	}

	public function uzivatel($id) {
		$uzivatel = array();
		$sql = "select * from uzivatele where id=".$id;
		$row = $this->web->query($sql,1);
		foreach($this->cols as $col) {
			$uzivatel[$col] = $row[$col];
		}
		return $uzivatel;	
	}

	public function seznam_prihlaseni($id) {
		$prihlaseni = array();
		$sql = "select * from uzivatele_logins where user_id=".$id." order by datetime desc";
		foreach ($this->web->query($sql) as $row) {
			foreach($this->cols_logins as $col) {
				$prihlaseni[$row['id']][$col] = $row[$col];
			}

		}
		return $prihlaseni;
	}

	public function pridat() {
		$datum = date('Y-m-d');
		$data = array(
			0, $_POST['username'], md5($_POST['password']), $_POST['name'], $_POST['surname'], $_POST['email'], $_POST['admin_group'], $datum, 0, 0
		);
		$this->web->addEntry('uzivatele', $data);
	}

	public function edit($id) {
		if(!empty($_POST['password'])) {
			$data = array(
				'username' => $_POST['username'], 'password' => md5($_POST['password']), 'name' => $_POST['name'], 'surname' => $_POST['surname'], 'email' => $_POST['email'], 'admin_group' => $_POST['admin_group'],
			);
		}
		else {
			$data = array(
				'username' => $_POST['username'], 'name' => $_POST['name'], 'surname' => $_POST['surname'], 'email' => $_POST['email'], 'admin_group' => $_POST['admin_group'],
			);
		}
		$this->web->editEntries('uzivatele', $data, 'id='.$id);
	}

	public function smazat($id) {
		$this->web->deleteEntryById('uzivatele', $id);
	}

	public function seznam_skupin() {
		$skupiny = array();
		$sql = "select * from uzivatele_skupiny ";
		foreach ($this->web->query($sql) as $row) {
			foreach($this->cols as $col) {
				$skupiny[$row['id']][$col] = $row[$col];
			}

		}
		return $skupiny;
	}

	public function skupina($id) {
		$skupina = array();
		$sql = "select * from uzivatele_skupiny where id=".$id;
		$row = $this->web->query($sql,1);
		foreach($this->cols as $col) {
			$skupina[$col] = $row[$col];
		}
		$skupina['prava'] = $this->prava_skupiny($row['id']);
		return $skupina;	
	}

	public function pridat_skupinu() {
		$datum = date('Y-m-d');
		$data = array(
			0, $_POST['name']
		);
		$this->web->addEntry('uzivatele_skupiny', $data);
		$this->web->setLastId();
		$id = $this->web->getLastId();
		$data = array();
		foreach ($this->cols_prava as $col) {
			if($col == 'id_skupiny') { 
				$data['id_skupiny'] = $id; 
			}
			else {
				$data[$col] = $_POST[$col];
			}
		}
		$this->web->addEntry('uzivatele_skupiny_prava', $data);
		return $id;
	}

	public function edit_skupinu($id) {
		$datum = date('Y-m-d');
		$data = array(
			'name' => $_POST['name'],
		);
		$this->web->editEntries('uzivatele_skupiny', $data, 'id='.$id);
		$data = null;
		foreach ($this->cols_prava as $col) {
			if($col != 'id_skupiny' && $col != 'id') { 
				if($_POST[$col] == 'on') { $value = 1; } else { $value = 0; }
				$data[$col] = $value;
			}
		}
		$this->web->editEntries('uzivatele_skupiny_prava', $data, 'id_skupiny='.$id);
	}

	public function smazat_skupinu($id) {
		$this->web->deleteEntryById('uzivatele_skupiny', $id);
		$this->web->deleteEntry('uzivatele_skupiny_prava', 'id_skupiny='.$id);
	}

	public function prava_skupiny($id_skupiny) {
		$prava = array();
		$sql = "select * from uzivatele_skupiny_prava where id_skupiny=".$id_skupiny;
		$row = $this->web->query($sql,1);
		return $row;
	}

}
?>