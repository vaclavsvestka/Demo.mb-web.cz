<?php
class poznamky {
	private $tpl = null;
	private $web = null;
	private $cols_poznamky = array('id','uzivatel','nazev','datum_cas_vytvoreni','datum_cas_editace','verejna','pripnout','text');
	
	public function __construct() {
		$this->tpl = new web_Smarty;
		$this->web = new web;
	}

	public function seznam_poznamek_uzivatele($id_uzivatele) {
		$sql = "select * from poznamky where uzivatel = ".$id_uzivatele;
		foreach($this->web->query($sql) as $row) {
			foreach($this->cols_poznamky as $col) {
				$poznamky[$row['id']][$col] = $row[$col];
			}
		}
		return $poznamky;
	}

	public function poznamka($id) {
		$sql = "select * from poznamky where id = ".$id;
		foreach($this->web->query($sql) as $row) {
			foreach($this->cols_poznamky as $col) {
				$poznamka[$col] = $row[$col];
			}
		}
		return $poznamka;
	}

	public function pripnout($id) {
		$data = array('pripnout' => 1);
		$this->web->editEntries('poznamky', $data, 'id='.$id);
	}

	public function odepnout($id) {
		$data = array('pripnout' => 0);
		$this->web->editEntries('poznamky', $data, 'id='.$id);
	}

	public function edit($id) {
		$date = date('Y-m-d H:i:s');
		$data = array('nazev' => $_POST['nazev'], 'text' => $_POST['text'], 'datum_cas_editace' => $date);
		$this->web->editEntries('poznamky', $data, 'id='.$id);
	}

	public function pridat($id_uzivatele) {
		$date = date('Y-m-d H:i:s');
		$sql = "insert into poznamky (uzivatel,nazev,datum_cas_vytvoreni,pripnout,text) values ";
		$sql.= "(";
		$sql.= $id_uzivatele.",";
		$sql.= "'".$_POST['nazev']."',";
		$sql.= "'".$date."',";
		$sql.= "0,";
		$sql.= "'".$_POST['text']."'";
		$sql.= ")";
		$this->web->query($sql);
	}

	public function smazat($id) {
		$this->web->deleteEntryById('poznamky',$id);
	}

}
?>