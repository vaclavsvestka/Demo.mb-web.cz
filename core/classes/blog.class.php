<?php
class blog {
	private $tpl = null;
	private $web = null;
	private $cols_blog = array('id','datum_cas_vytvoreni','datum_cas_editace','autor','kategorie','url','obrazek1','obrazek2');
	private $cols_blog_kategorie = array('id','url');
	private $cols_blog_kategorie_texty = array('id','id_kategorie','jazyk','nazev');
	private $cols_blog_texty = array('id_clanku','jazyk','nadpis','anotace','text','description','title');
	
	public function __construct() {
		$this->tpl = new web_Smarty;
		$this->web = new web;
	}	

	public function seznam_kategorii() {
		$sql = "select * from blog_kategorie";
		foreach($this->web->query($sql) as $row) {
			$id = $row['id'];
			foreach($this->cols_blog_kategorie as $col) {
				$kategorie[$id][$col] = $row[$col];
			}
			$sql = "select * from jazyky";
			foreach($this->web->query($sql) as $row) {
				$jazyk = $row['zkratka'];
				$sql2 = "select * from blog_kategorie_texty where id_kategorie=".$id." and jazyk = '".$jazyk."'";
				foreach($this->web->query($sql2) as $r) {
					$kategorie[$id]['texty'][$jazyk]['nazev'] = $r['nazev'];
				}
			}
		}
		return $kategorie;
	}

	public function seznam_clanku() {
		$blog = array();
		$sql = "select * from blog";
		foreach ($this->web->query($sql) as $row) {
			foreach($this->cols_blog as $col) {
				$blog[$row['id']][$col] = $row[$col];
			}
			// texty
			$blog[$row['id']]['texty'] = $this->texty_clanku($row['id']);
			// autor
			$autor = $this->autor_clanku($row['autor']);
			$blog[$row['id']]['autor_jmeno'] = $autor['name']." ".$autor['surname'];
			// kategorie
			$kat = $this->kategorie($row['kategorie']);
			$blog[$row['id']]['kategorie'] = $kat['texty']['cs']['nazev'];
			$blog[$row['id']]['id_kategorie'] = $kat['id'];
		}
		return $blog;
	}

	public function seznam_clanku_z_kategorie($id_kategorie) {
		$blog = array();
		$sql = "select * from blog where kategorie = ".$id_kategorie;
		foreach ($this->web->query($sql) as $row) {
			foreach($this->cols_blog as $col) {
				$blog[$row['id']][$col] = $row[$col];
			}
			// texty
			$blog[$row['id']]['texty'] = $this->texty_clanku($row['id']);
			// autor
			$autor = $this->autor_clanku($row['autor']);
			$blog[$row['id']]['autor_jmeno'] = $autor['name']." ".$autor['surname'];
			// kategorie
			$kat = $this->kategorie($row['kategorie']);
			$blog[$row['id']]['kategorie'] = $kat['nazev'];
			$blog[$row['id']]['id_kategorie'] = $kat['id'];
		}
		return $blog;
	}
	
	public function clanek($id) {
		$clanek = array();
		$sql = "select * from blog where id=".$id;
		$row = $this->web->query($sql,1);
		foreach($this->cols_blog as $col) {
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
		return $clanek;
	}

	public function clanekDleUrl($url) {
		$clanek = array();
		$sql = "select * from blog where url='".$url."'";
		$row = $this->web->query($sql,1);
		foreach($this->cols_blog as $col) {
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
		return $clanek;
	}
	
	public function texty_clanku($id_clanku) {
		$sql = "select * from blog_texty where id_clanku=".$id_clanku;
		foreach($this->web->query($sql) as $row) {
			foreach($this->cols_blog_texty as $col) {
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
		$sql = "select * from blog_kategorie where id=".$id."";
		$row = $this->web->query($sql,1);
		$kat['id'] = $row['id'];
		$kat['url'] = $row['url'];
		$sql = "select * from jazyky";
		foreach($this->web->query($sql) as $row) {
			$jazyk = $row['zkratka'];
			$sql2 = "select * from blog_kategorie_texty where id_kategorie=".$kat['id']." and jazyk='".$jazyk."'";
			foreach($this->web->query($sql2) as $r) {
				$kat['texty'][$jazyk]['nazev'] = $r['nazev'];
			}
		}
		return $kat;
	}

	public function edit($id) {
		$datum = date('Y-m-d H:i:s');
		$url = $_POST['url'];
		$data = array(
			'datum_cas_editace' => $datum, 
			'kategorie' => $_POST['kategorie'],
			'url' => $url
		);
		$this->web->editEntries('blog', $data, 'id='.$id);
		if(!empty($_FILES['obrazek1']['name'])) { 
			$obrazek1 = $this->nahrat_obrazek($_FILES['obrazek1']); 
			$data = array('obrazek1' => $obrazek1);
			$this->web->editEntries('blog', $data, 'id='.$id);
		}
		if(!empty($_FILES['obrazek2']['name'])) { 
			$obrazek2 = $this->nahrat_obrazek($_FILES['obrazek2']); 
			$data = array('obrazek2' => $obrazek2);
			$this->web->editEntries('blog', $data, 'id='.$id);
		}
		$sql = "select * from jazyky";
		foreach($this->web->query($sql) as $row) {
			$jazyk = $row['zkratka'];
			$sql = "select * from blog_texty where id_clanku=".$id." and jazyk='".$jazyk."' ";
			if($row = $this->web->query($sql,1)) {
				$data = array(
					'nadpis' => $_POST['nadpis_'.$jazyk], 
					'anotace' => $_POST['anotace_'.$jazyk],
					'text' => $_POST['text_'.$jazyk],
					'title' => $_POST['title_'.$jazyk],
					'description' => $_POST['description_'.$jazyk],
				);
				$this->web->editEntries('blog_texty', $data, "id_clanku=".$id." and jazyk='".$jazyk."'");
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
				$this->web->addEntry('blog_texty', $data);
			}
		}
	}

	public function pridat() {
		if(!empty($_FILES['obrazek1']['name'])) { 
			$obrazek1 = $this->nahrat_obrazek($_FILES['obrazek1']); 
		}
		if(!empty($_FILES['obrazek2']['name'])) { 
			$obrazek2 = $this->nahrat_obrazek($_FILES['obrazek2']); 
		}
		$datum = date('Y-m-d H:i:s');
		$url = $this->web->nice_url($_POST['nadpis_cs']);
		$data = array(0, $datum, 0, $_POST['autor'], $_POST['kategorie'],$url,$obrazek1,$obrazek2);
		$this->web->addEntry('blog', $data);
		$this->web->setLastId();
		$id = $this->web->getLastId();
		$sql = "select * from jazyky";
		foreach($this->web->query($sql) as $row) {
			$jazyk = $row['zkratka'];
			$data = array(0, $id, $jazyk, $_POST['nadpis_'.$jazyk], $_POST['anotace_'.$jazyk], $_POST['text_'.$jazyk], $_POST['description_'.$jazyk], $_POST['title_'.$jazyk] );
			$this->web->addEntry('blog_texty', $data);
		}
		return $id;
	}

	public function pridat_kategorie() {
		$url = $this->web->nice_url($_POST['nazev_cs']);
		$data = array(
			0, $url
		);
		$this->web->addEntry('blog_kategorie', $data);
		$this->web->setLastId();
		$id = $this->web->getLastId();
		$sql = "select * from jazyky";
		foreach($this->web->query($sql) as $row) {
			$jazyk = $row['zkratka'];
			$data = array(
				'',
				$id,
				$jazyk,
				$_POST['nazev_'.$jazyk], 
			);
			$this->web->addEntry('blog_kategorie_texty', $data);
		}
		return $id;
	}

	public function edit_kategorie($id) {
		$data = array(
			'url' => $_POST['url'], 
		);
		$this->web->editEntries('blog_kategorie', $data, "id = ".$id);
		$sql = "select * from jazyky";
		foreach($this->web->query($sql) as $row) {
			$jazyk = $row['zkratka'];
			$sql = "select * from blog_kategorie_texty where id_kategorie=".$id." and jazyk='".$jazyk."' ";
			if($row = $this->web->query($sql,1)) {
				$data = array(
					'nazev' => $_POST['nazev_'.$jazyk], 
				);
				$this->web->editEntries('blog_kategorie_texty', $data, "id_kategorie=".$id." and jazyk='".$jazyk."'");
			}
			else {
				$data = array(
					'',
					$id,
					$jazyk,
					$_POST['nazev_'.$jazyk], 
				);
				$this->web->addEntry('blog_kategorie_texty', $data);
			}
		}
	}

	public function nahrat_obrazek($obrazek) {
		if(!empty($obrazek['name'])) {
			$datum = date('YmdHi');
			$name = $obrazek['name'];
			$uploadfile = IMAGES_UPLOADS . $datum . $name;
	        $allowedExts = array("jpg", "jpeg", "gif", "png");
	        $temp = explode(".", $name);
	        $extension = end($temp);
	        if(in_array($extension, $allowedExts)) {
	            move_uploaded_file($obrazek['tmp_name'], $uploadfile);
	        }
	        $obr = $datum . $obrazek['name'];
		}
		return $obr;
	}

	public function smazat_kategorie($id) {
		$this->web->deleteEntryById('blog_kategorie', $id);
	}

	public function smazat($id) {
		$this->web->deleteEntryById('blog', $id);
		$this->web->deleteEntry('blog_texty', 'id_clanku='.$id);
	}

	public function vypis_kategorii() {
		$sql = "select * from blog where kategorie > 0 group by kategorie";
		foreach($this->web->query($sql) as $row) {
			$kategorie[$row['id']] = $this->kategorie($row['kategorie']);
		}
		return $kategorie;
	}
}
?>