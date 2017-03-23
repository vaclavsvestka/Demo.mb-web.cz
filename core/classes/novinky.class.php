<?php
class novinky {
	private $tpl = null;
	private $web = null;
	
	public function __construct() {
		$this->tpl = new web_Smarty;
		$this->web = new web;
	}	

	public function pridat() {
		$datum = date('Y-m-d H:i:s');
		$data = array(
			0, $datum, 0, $_POST['autor'], $_POST['nadpis'], $_POST['anotace'], $_POST['text']
		);
		$this->web->addEntry('novinky', $data);
	}

	public function edit($id) {
		$datum = date('Y-m-d H:i:s');
		$data = array(
			'nadpis' => $_POST['nadpis'], 
			'datum_cas_editace' => $datum, 
			'autor' => $_POST['autor'],
			'anotace' => $_POST['anotace'],
			'text' => $_POST['text'],
		);
		$this->web->editEntries('novinky', $data, 'id='.$id);
	}

	public function smazat($id) {
		$this->web->deleteEntryById('novinky', $id);
	}
	
	public function seznam_novinek() {
		// return $this->web->getEntries('*','novinky');
		$novinky = array();
		$sql = "select * from novinky";
		foreach ($this->web->query($sql) as $row) {
			$novinky[$row['id']]['id'] = $row['id'];
			$novinky[$row['id']]['datum_cas_vytvoreni'] = $row['datum_cas_vytvoreni'];			
			$novinky[$row['id']]['datum_cas_editace'] = $row['datum_cas_editace'];
			$novinky[$row['id']]['nadpis'] = $row['nadpis'];
			$novinky[$row['id']]['anotace'] = $row['anotace'];
			$novinky[$row['id']]['text'] = $row['text'];
			$sql = "select * from uzivatele where id=".$row['autor']." ";
			$row2 = $this->web->query($sql,1);
			$novinky[$row['id']]['autor_id'] = $row2['id'];
			$novinky[$row['id']]['autor'] = $row2['name']." ".$row2['surname'];
		}
		return $novinky;
	}

	public function novinka($id) {
		$sql = "select * from novinky A left join uzivatele B on A.autor=B.id where A.id=".$id;
		return $this->web->query($sql,1);
		// return $this->web->getEntry('*','novinky','id='.$id);
	}

}
?>