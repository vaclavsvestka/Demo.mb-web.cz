<?php
class galerie {
	private $tpl = null;
	private $web = null;
	private $userId = null;
	private $cols_galerie = array('id','obrazek_maly','obrazek_velky','popis','sort','album');
	private $cols_galerie_album = array('id', 'nazev');

	public function __construct() {
		$this->tpl = new web_Smarty;
		$this->web = new web;
	}

	public function galerie() {
		$sql = "select * from galerie order by sort asc";
		foreach($this->web->query($sql) as $row) {
			foreach($this->cols_galerie as $col) {
				$galerie[$row['id']][$col] = $row[$col];
			}
			$sql = "select * from galerie_album where id=".$row['album'];
			$r = $this->web->query($sql,1);
			$galerie[$row['id']]['album_nazev'] = $r['nazev'];
		}
		return $galerie;
	}

	public function obrazek($id) {
		$sql = "select * from galerie where id=".$id;
		$row = $this->web->query($sql,1);
		foreach($this->cols_galerie as $col) {
			$obrazek[$col] = $row[$col];
		}
		return $obrazek;
	}

	public function nahrat_obrazek() {
		$velky_soubor = $this->web->nahrat_soubor($_FILES['obrazek_velky'], GALERIE_UPLOADS);
		$maly_soubor = $this->web->nahrat_soubor($_FILES['obrazek_maly'], GALERIE_UPLOADS_THUMBS);
		$data = array(
			0,
			$maly_soubor,
			$velky_soubor,
			$_POST['popis'],
			$_POST['sort'],
			$_POST['album']
		);
		$this->web->addEntry('galerie', $data);
	}

	public function uprav_obrazek($id) {
		$data = array(
			'popis' => $_POST['popis'],
			'sort' => $_POST['sort'],
			'album' => $_POST['album']
		);
		$this->web->editEntries('galerie', $data, 'id='.$id);
	}

	public function smaz_obrazek($id) {
		$sql = "select * from galerie where id=".$id;
		$row = $this->web->query($sql,1);
		$maly = $row['obrazek_maly'];
		$velky = $row['obrazek_velky'];
		unlink(GALERIE_UPLOADS.$velky);
		unlink(GALERIE_UPLOADS_THUMBS.$maly);
		$this->web->deleteEntryById('galerie', $id);
	}

	public function seznam_alb() {
		$sql = "select * from galerie_album";
		foreach($this->web->query($sql) as $row) {
			foreach($this->cols_galerie_album as $col) {
				$album[$row['id']][$col] = $row[$col];
			}
		}
		return $album;
	}

	public function album($id) {
		$sql = "select * from galerie_album where id=".$id;
		$row = $this->web->query($sql,1);
		foreach($this->cols_galerie_album as $col) {
			$album[$col] = $row[$col];
		}
		return $album;
	}

	public function nove_album() {
		$data = array('', $_POST['nazev']);
		$this->web->addEntry('galerie_album', $data);
	}

	public function uprav_album($id) {
		$data = array(
			'nazev' => $_POST['nazev'],
		);
		$this->web->editEntries('galerie_album', $data, 'id='.$id);
	}

	public function smaz_album($id) {
		$this->web->deleteEntryById('galerie_album', $id);
	}

	public function obrazky_v_albu($id) {
		$sql = "select * from galerie where album=".$id;
		foreach($this->web->query($sql) as $row) {
			foreach($this->cols_galerie as $col) {
				$obrazky[$row['id']][$col] = $row[$col];
			}
		}
		return $obrazky;
	}

}
?>