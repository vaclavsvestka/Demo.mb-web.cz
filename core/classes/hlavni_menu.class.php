<?php
class hlavni_menu {
	private $tpl = null;
	private $web = null;
	private $clanky = null;

	public function __construct() {
    	include_once CLASSES . "clanky.class.php";
		$this->tpl = new web_Smarty;
		$this->web = new web;
		$this->clanky = new clanky;
	}	
	
	public function vypsat_texty() {
		$params = array('kategorie'=>1);
		return $this->clanky->seznam_clanku($params);
	}

	public function view_menu() {
		$sql = "select * from menu where parent_id=0 order by sort asc";
		foreach ($this->web->query($sql) as $row) {
			$menu[$row['id']]['id'] = $row['id'];
			$menu[$row['id']]['parent_id'] = $row['parent_id'];
			$menu[$row['id']]['nazev'] = $row['nazev'];
			$menu[$row['id']]['odkaz'] = $row['odkaz'];
			$menu[$row['id']]['clanek'] = $row['clanek'];
			$menu[$row['id']]['sort'] = $row['sort'];
			$menu[$row['id']]['aktivni'] = $row['aktivni'];
			$menu[$row['id']]['datum_pridani'] = $row['datum_pridani'];
			$menu[$row['id']]['datum_editace'] = $row['datum_editace'];
			$sql2 = "select * from menu where parent_id=".$row['id']." order by sort asc";
			foreach($this->web->query($sql2) as $row2) {
				$menu[$row['id']]['submenu'][$row2['id']]['id'] = $row2['id'];
				$menu[$row['id']]['submenu'][$row2['id']]['parent_id'] = $row2['parent_id'];
				$menu[$row['id']]['submenu'][$row2['id']]['nazev'] = $row2['nazev'];
				$menu[$row['id']]['submenu'][$row2['id']]['odkaz'] = $row2['odkaz'];
				$menu[$row['id']]['submenu'][$row2['id']]['clanek'] = $row2['clanek'];
				$menu[$row['id']]['submenu'][$row2['id']]['sort'] = $row2['sort'];
				$menu[$row['id']]['submenu'][$row2['id']]['aktivni'] = $row2['aktivni'];
				$menu[$row['id']]['submenu'][$row2['id']]['datum_pridani'] = $row2['datum_pridani'];
				$menu[$row['id']]['submenu'][$row2['id']]['datum_editace'] = $row2['datum_editace'];
			}
		}
		return $menu;
	}
	
	public function pridat_menu() {
		if(empty($_POST['odkaz'])) { $odkaz = $_POST['odkaz2']; } else { $odkaz = $_POST['odkaz']; }
		$datum = date('Y-m-d');
		$data = array(
			0, $_POST['nadrazena'], $_POST['nazev'], $_POST['odkaz'], $_POST['clanek'], $_POST['sort'], $_POST['aktivni'], $datum, 0
		);
		$this->web->addEntry('menu', $data);
	}
	
	public function edit_menu($id) {
		$datum = date('Y-m-d');
		$data = array(
			'nazev' => $_POST['nazev'], 
			'parent_id' => $_POST['nadrazena'], 
			'datum_editace' => $datum,
			'odkaz' => $_POST['odkaz'],
			'clanek' => $_POST['clanek'],
			'sort' => $_POST['sort'],
			'aktivni' => $_POST['aktivni'],
		);
		$this->web->editEntries('menu', $data, 'id='.$id);
	}
	
	public function smazat($id) {
		$this->web->deleteEntryById('menu', $id);
	}
	
	public function detail_menu($id) {
		return $this->web->getEntry('*', 'menu', 'id = '.$id);
	}
}
?>