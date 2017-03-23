<?php
class seznamy {
	private $tpl = null;
	private $web = null;
	private $cols_seznamy = array('id','nazev','podnazev','datum_cas_vytvoreni','datum_cas_editace','autor','kategorie','obrazek');
	private $cols_seznamy_kategorie = array('id','nazev');
	
	public function __construct() {
		$this->tpl = new web_Smarty;
		$this->web = new web;
	}	

	public function seznam_kategorii() {
		$sql = "select * from seznamy_kategorie";
		return $this->web->query($sql);
	}

	public function seznamy() {
		$seznamy = array();
		$sql = "select * from seznamy";
		foreach ($this->web->query($sql) as $row) {
			foreach($this->cols_seznamy as $col) {
				$seznamy[$row['id']][$col] = $row[$col];
			}
			// autor
			$autor = $this->autor_clanku($row['autor']);
			$seznamy[$row['id']]['autor_jmeno'] = $autor['name']." ".$autor['surname'];
			// kategorie
			$kat = $this->kategorie($row['kategorie']);
			$seznamy[$row['id']]['kategorie'] = $kat['nazev'];
			$seznamy[$row['id']]['id_kategorie'] = $kat['id'];
		}
		return $seznamy;
	}

	public function polozky_z_kategorie($id_kategorie) {
		$seznamy = array();
		$sql = "select * from seznamy where kategorie = ".$id_kategorie;
		foreach ($this->web->query($sql) as $row) {
			foreach($this->cols_seznamy as $col) {
				$seznamy[$row['id']][$col] = $row[$col];
			}
			// autor
			$autor = $this->autor_clanku($row['autor']);
			$seznamy[$row['id']]['autor_jmeno'] = $autor['name']." ".$autor['surname'];
			// kategorie
			$kat = $this->kategorie($row['kategorie']);
			$seznamy[$row['id']]['kategorie'] = $kat['nazev'];
			$seznamy[$row['id']]['id_kategorie'] = $kat['id'];
		}
		return $seznamy;
	}
	
	public function seznam($id) {
		$seznam = array();
		$sql = "select * from seznamy where id=".$id;
		$row = $this->web->query($sql,1);
		foreach($this->cols_seznamy as $col) {
			$seznam[$col] = $row[$col];
		}
		// autor
		$autor = $this->autor_clanku($row['autor']);
		$seznam['autor_jmeno'] = $autor['name']." ".$autor['surname'];
		// nazev kategorie
		$kategorie = $this->kategorie($row['kategorie']);
		$seznam['nazev_kategorie'] = $kategorie['nazev'];
		return $seznam;
	}

	public function smazat_fotku($id) {
		$this->web->deleteEntryById('seznamy_galerie', $id);
	}
	
	public function autor_clanku($autor) {
		$sql = "select * from uzivatele where id=".$autor;
		return $this->web->query($sql,1);
	}

	public function kategorie($id) {
		$sql = "select * from seznamy_kategorie where id=".$id."";
		return $this->web->query($sql,1);
	}

	public function edit($id) {
		$datum = date('Y-m-d H:i:s');
		$data = array(
			'datum_cas_editace' => $datum, 
			'nazev' => $_POST['nazev'],
			'podnazev' => $_POST['podnazev'],
			'kategorie' => $_POST['kategorie'],
		);
		$this->web->editEntries('seznamy', $data, 'id='.$id);
		
		if($_FILES['fotogalerie1']['error'] == 0) {
			$obr = $this->web->nahrat_obrazek($_FILES['fotogalerie1']);
			$data = array(
				'obrazek' => $obr,
			);
			$this->web->editEntries('seznamy', $data, 'id='.$id);
		}
	}

	public function pridat() {
		$datum = date('Y-m-d H:i:s');
		if($_FILES['fotogalerie1']['error'] == 0) {
			$obr = $this->web->nahrat_obrazek($_FILES['fotogalerie1']);
		}
		$data = array('', $_POST['nazev'], $_POST['podnazev'], $datum, 0, 0, $_POST['kategorie'], $obr);
		$this->web->addEntry('seznamy', $data);
		$this->web->setLastId();
		$id = $this->web->getLastId();
		return $id;
	}

	public function pridat_kategorie() {
		$data = array(
			'', $_POST['nazev']
		);
		$this->web->addEntry('seznamy_kategorie', $data);
		$this->web->setLastId();
		$id = $this->web->getLastId();
		return $id;
	}

	public function edit_kategorie($id) {
		$data = array(
			'nazev' => $_POST['nazev'], 
		);
		$this->web->editEntries('seznamy_kategorie', $data, 'id='.$id);
	}

	public function smazat_kategorie($id) {
		$this->web->deleteEntryById('seznamy_kategorie', $id);
	}

	public function smazat($id) {
		$this->web->deleteEntryById('seznamy', $id);
	}
}
?>