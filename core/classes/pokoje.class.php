<?php
class pokoje {
	private $tpl = null;
	private $web = null;
	private $userId = null;
	private $cols_pokoje = array('id','nazev','galerie_id','anotace','popis','datum_cas_vytvoreni','datum_cas_editace','cena');
	
	public function __construct() {
		$this->tpl = new web_Smarty;
		$this->web = new web;
	}

	public function seznam_pokoju() {
		$pokoje = array();
		$sql = "select * from pokoje ";
		foreach($this->web->query($sql) as $row) {
			foreach($this->cols_pokoje as $col) {
				$pokoje[$row['id']][$col] = $row[$col];
			}
		}
		return $pokoje;
	}

	public function pokoj($id) {
		$pokoj = array();
		$sql = "select * from pokoje where id=".$id." ";
		$row = $this->web->query($sql,1);
		foreach($this->cols_pokoje as $col) {
			$pokoj[$col] = $row[$col];
		}
		return $pokoj;
	}

	public function pridat() {
		$datum = date('Y-m-d H:i:s');
		$data = array(
			0, $_POST['nazev'], $_POST['galerie_id'], $_POST['anotace'], $_POST['popis'], $datum, 0, $_POST['cena']
		);
		$this->web->addEntry('pokoje', $data);
	}

	public function edit($id) {
		$datum = date('Y-m-d H:i:s');
		$data = array(
			'nazev' => $_POST['nazev'], 
			'galerie_id' => $_POST['galerie_id'],
			'anotace' => $_POST['anotace'],
			'popis' => $_POST['popis'],
			'datum_cas_editace' => $datum, 
			'cena' => $_POST['cena']
		);
		$this->web->editEntries('pokoje', $data, 'id='.$id);
	}

	public function smazat($id) {
		$this->web->deleteEntryById('pokoje', $id);
	}

}
?>