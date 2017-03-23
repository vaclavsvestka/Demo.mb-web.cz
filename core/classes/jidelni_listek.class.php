<?php
class jidelni_listek {
	private $tpl = null;
	private $web = null;

	public function __construct() {
		$this->tpl = new web_Smarty;
		$this->web = new web;
		$this->clanky = new clanky;
	}	
	
	public function jidelni_listek() {
		$jidelni_listek = array();
		$sql = "select * from jidelni_listek_kategorie";
		foreach($this->web->query($sql) as $row) {
			$jidelni_listek[$row['id']]['id'] = $row['id'];
			$jidelni_listek[$row['id']]['nazev'] = $row['nazev'];
			$jidelni_listek[$row['id']]['podnazev'] = $row['podnazev'];
			$jidelni_listek[$row['id']]['napoje'] = $this->napoje($row['id']);
		}
		return $jidelni_listek;
	}

	public function napoje($id_kategorie) {
		$napoje = array();
		$cols = array('id','id_kategorie','nazev','mnozstvi','cena','sort','sleva');
		$sql = "select * from jidelni_listek where id_kategorie = ".$id_kategorie." order by sort asc";
		foreach($this->web->query($sql) as $row) {
			foreach($cols as $col) {
				$napoje[$row['id']][$col] = $row[$col];
			}
		}
		return $napoje;
	}

	public function nova_kategorie() {
		$nazev = $_POST['nazev'];
		$podnazev = $_POST['podnazev'];
		$data = array('',$nazev,$podnazev);
		$this->web->addEntry('jidelni_listek_kategorie', $data);
	}

	public function nova_polozka() {
		$data = array(
			'',
			$_POST['id_kategorie'],
			$_POST['nazev'],
			$_POST['mnozstvi'],
			$_POST['cena'],
			$_POST['sort'],
			$_POST['sleva'],
		);
		$this->web->addEntry('jidelni_listek', $data);
	}

	public function upravit_polozku($id) {
		$data = array(
			'nazev' => $_POST['nazev'],
			'mnozstvi' => $_POST['mnozstvi'],
			'cena' => $_POST['cena'],
			'sort' => $_POST['sort'],
			'sleva' => $_POST['sleva'],
		);
		$this->web->editEntries('jidelni_listek', $data, 'id='.$_POST['id']);
	}

	public function smazat_polozku($id) {
		$this->web->deleteEntry('jidelni_listek','id='.$id);
	}
}
?>