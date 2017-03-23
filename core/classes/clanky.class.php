<?php
class clanky {
	private $tpl = null;
	private $web = null;
	private $cols_clanky = array('id','datum_cas_vytvoreni','datum_cas_editace','autor','kategorie', 'url');
	private $cols_clanky_texty = array('id_clanku','jazyk','nadpis','anotace','text','description','title');
	
	public function __construct() {
		$this->tpl = new web_Smarty;
		$this->web = new web;
	}	

	public function seznam_kategorii() {
		$sql = "select * from clanky_kategorie";
		return $this->web->query($sql);
	}

	public function seznam_clanku($params) {
		$clanky = array();
		$sql = "select * from clanky ";
		if(!empty($params['kategorie'])) {
			$sql.= "where kategorie=".$params['kategorie']." ";
		}
		foreach ($this->web->query($sql) as $row) {
			foreach($this->cols_clanky as $col) {
				$clanky[$row['id']][$col] = $row[$col];
			}
			// texty
			$clanky[$row['id']]['texty'] = $this->texty_clanku($row['id']);
			// autor
			$autor = $this->autor_clanku($row['autor']);
			$clanky[$row['id']]['autor_jmeno'] = $autor['name']." ".$autor['surname'];
			// kategorie
			$kat = $this->kategorie($row['kategorie']);
			$clanky[$row['id']]['kategorie'] = $kat['nazev'];
			$clanky[$row['id']]['id_kategorie'] = $kat['id'];
		}
		return $clanky;
	}
	
	public function clanek($id) {
		$clanek = array();
		$sql = "select * from clanky where id=".$id;
		$row = $this->web->query($sql,1);
		foreach($this->cols_clanky as $col) {
			$clanek[$col] = $row[$col];
		}
		// texty
		$clanek['texty'] = $this->texty_clanku($row['id']);
		// autor
		$autor = $this->autor_clanku($row['autor']);
		$clanek['autor_jmeno'] = $autor['name']." ".$autor['surname'];
		// nazev kategorie
		$kategorie = $this->kategorie($row['kategorie']);
		$clanek['nazev_kategorie'] = $kategorie['nazev'];
		$clanek['fotogalerie'] = $this->fotogalerie($id);
		return $clanek;
	}

	public function fotogalerie($id_clanku) {
		$sql = "select * from clanky_galerie where id_clanku = ".$id_clanku;
		foreach($this->web->query($sql) as $row) {
			$fotogalerie[$row['id']]['id'] = $row['id'];
			$fotogalerie[$row['id']]['soubor'] = $row['soubor'];
		}
		return $fotogalerie;
	}

	public function smazat_fotku($id) {
		$this->web->deleteEntryById('clanky_galerie', $id);
	}
	
	public function texty_clanku($id_clanku) {
		$sql = "select * from clanky_texty where id_clanku=".$id_clanku;
		foreach($this->web->query($sql) as $row) {
			foreach($this->cols_clanky_texty as $col) {
				$texty[$row['jazyk']][$col] = $row[$col];
			}
		}
		return $texty;
	}

	public function autor_clanku($autor) {
		$sql = "select * from uzivatele where id=".$autor;
		return $this->web->query($sql,1);
	}

	public function kategorie($id) {
		$sql = "select * from clanky_kategorie where id=".$id."";
		return $this->web->query($sql,1);
	}

	public function edit($id) {
		$datum = date('Y-m-d H:i:s');
		$data = array(
			'datum_cas_editace' => $datum, 
			'kategorie' => $_POST['kategorie'],
			'url' => $_POST['url'],
		);
		$this->web->editEntries('clanky', $data, 'id='.$id);
		$sql = "select * from jazyky";
		foreach($this->web->query($sql) as $row) {
			$jazyk = $row['zkratka'];
			$sql = "select * from clanky_texty where id_clanku=".$id." and jazyk='".$jazyk."' ";
			if($row = $this->web->query($sql,1)) {
				$data = array(
					'nadpis' => $_POST['nadpis_'.$jazyk], 
					'anotace' => $_POST['anotace_'.$jazyk],
					'text' => $_POST['text_'.$jazyk],
					'title' => $_POST['title_'.$jazyk],
					'description' => $_POST['description_'.$jazyk],
				);
				$this->web->editEntries('clanky_texty', $data, "id_clanku=".$id." and jazyk='".$jazyk."'");
			}
			else {
				$data = array(
					'',
					$id,
					$jazyk, 
					$_POST['nadpis_'.$jazyk], 
					$_POST['anotace_'.$jazyk], 
					$_POST['text_'.$jazyk], 
					$_POST['description_'.$jazyk], 
					$_POST['title_'.$jazyk]
				);
				$this->web->addEntry('clanky_texty', $data);
			}
		}
		$this->pridat_obrazky_k_clanku($id);
	}

	public function pridat() {
		$datum = date('Y-m-d H:i:s');
		$url = $this->web->nice_url($_POST['nadpis_cs']);
		$data = array('', $datum, 0, $_POST['autor'], $_POST['kategorie'], $url);
		$this->web->addEntry('clanky', $data);
		$this->web->setLastId();
		$id = $this->web->getLastId();
		$sql = "select * from jazyky";
		foreach($this->web->query($sql) as $row) {
			$jazyk = $row['zkratka'];
			$data = array('', $id, $jazyk, $_POST['nadpis_'.$jazyk], $_POST['anotace_'.$jazyk], $_POST['text_'.$jazyk], $_POST['description_'.$jazyk], $_POST['title_'.$jazyk]);
			$this->web->addEntry('clanky_texty', $data);
		}
		$this->pridat_obrazky_k_clanku($id);
		return $id;
	}

	public function pridat_obrazky_k_clanku($id_clanku) {
		for($i=1;$i<=5;$i++) {
			if($_FILES['fotogalerie'.$i]['error'] == 0) {
				$obr = $this->web->nahrat_obrazek($_FILES['fotogalerie'.$i]);
				$data = array('', $id_clanku, $obr);
				$this->web->addEntry('clanky_galerie', $data);
			}
		}
	}

	public function pridat_kategorie() {
		$data = array(
			'', $_POST['nazev']
		);
		$this->web->addEntry('clanky_kategorie', $data);
		$this->web->setLastId();
		$id = $this->web->getLastId();
		return $id;
	}

	public function edit_kategorie($id) {
		$data = array(
			'nazev' => $_POST['nazev'], 
		);
		$this->web->editEntries('clanky_kategorie', $data, 'id='.$id);
	}

	public function smazat_kategorie($id) {
		$this->web->deleteEntryById('clanky_kategorie', $id);
	}

	public function smazat($id) {
		$this->web->deleteEntryById('clanky', $id);
		$this->web->deleteEntry('clanky_texty', 'id_clanku='.$id);
	}
}
?>