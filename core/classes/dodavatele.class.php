<?php
class dodavatele {
	private $tpl = null;
	private $web = null;
	
	public function __construct() {
		$this->tpl = new web_Smarty;
		$this->web = new web;
	}

	public function seznam_dodavatelu($params = array()) {
		$dodavatele = array();
		$sql = "select * from dodavatele ";
		if($params['view_home'] == 1) { $sql.= "where view_home = 1 "; }
		if($params['random'] == 1) { $sql.= "order by RAND()"; } else { $sql.= "order by sort asc"; }
		foreach ($this->web->query($sql) as $row) {
			$cols = array('id','nazev','popis','obrazek','odkaz','view_home','datum_vytvoreni','datum_editace','sort','vytvoril','aktivni');
			foreach($cols as $col) {
				$dodavatele[$row['id']][$col] = $row[$col];
			}
			$sql = "select * from dodavatele_obory A left join obory B on A.id_oboru = B.id where A.id_dodavatele=".$row['id']." ";
			foreach($this->web->query($sql) as $row2) {
				$cols = array('nazev','odkaz');
				foreach($cols as $col) {
					$dodavatele[$row['id']]['obory'][$row2['id']][$col] = $row2[$col];
				}
			}
		}
		return $dodavatele;
	}

	public function dodavatel($id) {
		$dodavatel = array();
		$sql = "select * from dodavatele where id=".$id;
		foreach($this->web->query($sql) as $row) {
			$cols = array('id','nazev','popis','obrazek','odkaz','view_home','datum_vytvoreni','datum_editace','sort','vytvoril','aktivni');
			foreach($cols as $col) {
				$dodavatel[$col] = $row[$col];
			}
		}
		$sql = "select * from dodavatele_obory where id_dodavatele = ".$id;
		foreach($this->web->query($sql) as $row) {
			$dodavatel['obory'][] = $row['id_oboru'];
		}
		return $dodavatel;
	}

	public function edit($id) {
		$datum = date('Y-m-d H:i:s');
		$timestamp = date('YmdHis');
		if (!empty($_FILES['logo']['name'])) {
            $ds = DIRECTORY_SEPARATOR; 
            $tempFile = $_FILES['logo']['tmp_name'];
            if(!opendir(LOGA_UPLOADS . $ds)) {
                mkdir(LOGA_UPLOADS . $ds);
            }
            $targetPath = LOGA_UPLOADS . $ds;
            $filename = $timestamp . '-' . $_FILES['logo']['name'];
            $targetFile =  $targetPath . $filename;
			$soubor = $timestamp . '-' . $_FILES['logo']['name'];
            move_uploaded_file($tempFile,$targetFile);
        }
        else {
        	$row = $this->web->getEntry('*','dodavatele','id='.$id);
        	$soubor = $row['obrazek'];
        }
		$data = array(
			'nazev' => $_POST['nazev'], 
			'datum_editace' => $datum, 
			'vytvoril' => $_POST['vytvoril'],
			'odkaz' => $_POST['odkaz'],
			'view_home' => $_POST['view_home'],
			'popis' => $_POST['popis'],
			'obrazek' => $soubor,
			'sort' => $_POST['sort'],
			'aktivni' => $_POST['aktivni']
		);
		$this->web->editEntries('dodavatele', $data, 'id='.$id);
		$this->web->deleteEntry('dodavatele_obory', 'id_dodavatele='.$id);
		foreach($_POST['dodavatele_obory'] as $obor => $value) {
			$data = array(
				$id, $value
			);
			$this->web->addEntry('dodavatele_obory', $data);	
		}
	}

	public function pridat() {
		$datum = date('Y-m-d H:i:s');
		$timestamp = date('YmdHis');
		if (!empty($_FILES['logo']['name'])) {
            $ds = DIRECTORY_SEPARATOR; 
            $tempFile = $_FILES['logo']['tmp_name'];
            if(!opendir(LOGA_UPLOADS . $ds)) {
                mkdir(LOGA_UPLOADS . $ds);
            }
            $targetPath = LOGA_UPLOADS . $ds;
            $filename = $timestamp . '-' . $_FILES['logo']['name'];
            $targetFile =  $targetPath . $filename;
			$soubor = $timestamp . '-' . $_FILES['logo']['name'];
            move_uploaded_file($tempFile,$targetFile);
        }
		$data = array(
			0, $_POST['nazev'], $_POST['popis'], $soubor, $_POST['odkaz'], $_POST['view_home'], $datum, 0, $_POST['sort'], $_POST['vytvoril'], $_POST['aktivni']
		);
		$this->web->addEntry('dodavatele', $data);
		$this->web->setLastId();
		$id = $this->web->getLastId();
		foreach($_POST['dodavatele_obory'] as $obor => $value) {
			$data = array(
				$id, 
				$value
			);
			$this->web->addEntry('dodavatele_obory', $data);	
		}
		return $id;
	}

	public function smazat($id) {
		$this->web->deleteEntryById('dodavatele', $id);
		$this->web->deleteEntry('dodavatele_obory','id_dodavatele='.$id);
	}

}
?>