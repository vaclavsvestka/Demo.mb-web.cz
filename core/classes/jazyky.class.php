<?php
class jazyky {
	private $tpl = null;
	private $web = null;
	private $cols_jazyky = array('id','zkratka','nazev');

	public function __construct() {
		$this->tpl = new web_Smarty;
		$this->web = new web;
	}	

	public function seznam_jazyku() {
		$sql = "select * from jazyky";
		foreach($this->web->query($sql) as $row) {
			foreach($this->cols_jazyky as $col) {
				$jazyky[$row['id']][$col] = $row[$col];
			}
		}
		return $jazyky;
	}

	public function jazyk($id) {
		$sql = "select * from jazyky where id=".$id;
		$row = $this->web->query($sql,1);
		foreach($this->cols_jazyky as $col) {
			$jazyk[$col] = $row[$col];
		}
		return $jazyk;
	}

	public function pridat_jazyk() {
		$data = array('', $_POST['zkratka'],$_POST['nazev']);
		$this->web->addEntry('jazyky', $data);
		$this->web->setLastId();
        return $this->web->getLastId();
	}

	public function edit_jazyk($id) {
		$data = array(
			'zkratka' => $_POST['zkratka'],
			'nazev' => $_POST['nazev'],
		);
		$this->web->editEntries('jazyky',$data,'id='.$id);
	}

	public function smazat_jazyk($id) {
		$this->web->deleteEntry('jazyky', 'id='.$id);
	}
}
?>