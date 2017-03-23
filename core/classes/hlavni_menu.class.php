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
		$menu = $this->web->getEntries('*', 'menu', 'parent_id = 0', 'sort asc');
		foreach ($menu as $key => $value) {
			$menu[$key][] = $this->web->getEntries('*', 'menu', 'parent_id = '.$value['id'], 'sort asc');
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