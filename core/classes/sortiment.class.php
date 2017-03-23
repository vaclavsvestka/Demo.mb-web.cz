<?php
class sortiment {
	private $tpl = null;
	private $web = null;
	
	public function __construct() {
		$this->tpl = new web_Smarty;
		$this->web = new web;
	}

	public function seznam_oboru() {
		$obory = array();
		$sql = "select * from obory order by sort asc";
		foreach ($this->web->query($sql) as $row) {
			$cols = array('id','nazev','popis','obrazek','odkaz','datum_vytvoreni','datum_editace','sort','vytvoril');
			foreach($cols as $col) {
				$obory[$row['id']][$col] = $row[$col];
			}
		}
		return $obory;
	}

	public function obor($id) {
		$obor = array();
		$sql = "select * from obory where id=".$id;
		foreach($this->web->query($sql) as $row) {
			$cols = array('id','nazev','popis','obrazek','odkaz','datum_vytvoreni','datum_editace','sort','vytvoril');
			foreach($cols as $col) {
				$obor[$col] = $row[$col];
			}
		}
		$sql = "select * from dodavatele_obory where id_oboru = ".$id;
		foreach($this->web->query($sql) as $row) {
			$obor['dodavatele'][] = $row['id_dodavatele'];
		}
		return $obor;
	}

	public function edit($id) {
		$datum = date('Y-m-d H:i:s');
		$odkaz = $this->web->nice_url($_POST['nazev']);
		$data = array(
			'nazev' => $_POST['nazev'], 
			'datum_editace' => $datum, 
			'vytvoril' => $_POST['vytvoril'],
			'popis' => $_POST['popis'],
			'obrazek' => $_POST['obrazek'],
			'sort' => $_POST['sort'],
			'odkaz' => $odkaz,
		);
		$this->web->editEntries('obory', $data, 'id='.$id);
		$this->web->deleteEntry('dodavatele_obory', 'id_oboru='.$id);
		foreach($_POST['dodavatele_obory'] as $dodavatel => $value) {
			$data = array(
				$value, $id
			);
			$this->web->addEntry('dodavatele_obory', $data);	
		}
	}

	public function pridat() {
		$datum = date('Y-m-d H:i:s');
		$odkaz = $this->web->nice_url($_POST['nazev']);
		$data = array(
			0, $_POST['nazev'], $_POST['popis'], $_POST['obrazek'], $odkaz, $datum, 0, $_POST['sort'], $_POST['vytvoril']
		);
		$this->web->addEntry('obory', $data);
		$this->web->setLastId();
		$id = $this->web->getLastId();
		foreach($_POST['dodavatele_obory'] as $dodavatel => $value) {
			$data = array(
				$value, 
				$id
			);
			$this->web->addEntry('dodavatele_obory', $data);	
		}
		return $id;	
	}

	public function smazat($id) {
		$this->web->deleteEntryById('obory', $id);
		$this->web->deleteEntry('dodavatele_obory','id_oboru='.$id);
	}

}
?>