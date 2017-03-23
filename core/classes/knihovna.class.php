<?php 
define('VODOZNAK', MAIN_SITE . 'files/images/vodoznak.png');
class knihovna {
	private $tpl = null;
	private $web = null;
	
	public function __construct() {
		$this->tpl = new web_Smarty;
		$this->web = new web;
	}

	public function seznam_kategorii($params = array()) {
		$seznam = array();
		$sql = "select * FROM knihovna WHERE parent_id = 0 order by title asc";
		foreach ($this->web->query($sql) as $row) {
			$sql = "select count(id) as pocet FROM knihovna_soubory WHERE parent_id = ".$row['id'];
			$pocet = $this->web->query($sql,1);
			$seznam['kategorie'][$row['id']]['pocet_souboru'] = $pocet['pocet'];
			$sql = "select count(id) as pocet FROM knihovna WHERE parent_id = ".$row['id'];
			$pocet = $this->web->query($sql,1);
			$seznam['kategorie'][$row['id']]['pocet_slozek'] = $pocet['pocet'];
			$seznam['kategorie'][$row['id']]['id'] = $row['id'];
			$seznam['kategorie'][$row['id']]['parent_id'] = $row['parent_id'];
			$seznam['kategorie'][$row['id']]['title'] = $row['title'];
			$seznam['kategorie'][$row['id']]['text'] = $row['text'];
			$seznam['kategorie'][$row['id']]['datum'] = $row['datum'];
			$seznam['kategorie'][$row['id']]['sort'] = $row['sort'];
			if(!empty($params) && ($params['zobrazit'] != 'hlavni_kategorie')) {
				$sql = "select * FROM knihovna WHERE parent_id = ".$row['id']." order by title asc";
				foreach ($this->web->query($sql) as $row2) {
					$sql = "select count(id) as pocet FROM knihovna_soubory WHERE parent_id = ".$row2['id'];
					$pocet = $this->web->query($sql,1);
					$seznam['kategorie'][$row['id']]['podkategorie'][$row2['id']]['pocet_souboru'] = $pocet['pocet'];
					$sql = "select count(id) as pocet FROM knihovna WHERE parent_id = ".$row2['id'];
					$pocet = $this->web->query($sql,1);
					$seznam['kategorie'][$row['id']]['podkategorie'][$row2['id']]['pocet_slozek'] = $pocet['pocet'];
					$seznam['kategorie'][$row['id']]['podkategorie'][$row2['id']]['id'] = $row2['id'];
					$seznam['kategorie'][$row['id']]['podkategorie'][$row2['id']]['parent_id'] = $row2['parent_id'];
					$seznam['kategorie'][$row['id']]['podkategorie'][$row2['id']]['title'] = $row2['title'];
					$seznam['kategorie'][$row['id']]['podkategorie'][$row2['id']]['text'] = $row2['text'];
					$seznam['kategorie'][$row['id']]['podkategorie'][$row2['id']]['datum'] = $row2['datum'];
					$seznam['kategorie'][$row['id']]['podkategorie'][$row2['id']]['sort'] = $row2['sort'];
					$sql = "select * FROM knihovna WHERE parent_id = ".$row2['id']." order by title asc";
					foreach ($this->web->query($sql) as $row3) {
						$sql = "select count(id) as pocet FROM knihovna_soubory WHERE parent_id = ".$row3['id'];
						$pocet = $this->web->query($sql,1);
						$seznam['kategorie'][$row['id']]['podkategorie'][$row2['id']]['podkategorie'][$row3['id']]['pocet_souboru'] = $pocet['pocet'];
						$sql = "select count(id) as pocet FROM knihovna WHERE parent_id = ".$row3['id'];
						$pocet = $this->web->query($sql,1);
						$seznam['kategorie'][$row['id']]['podkategorie'][$row2['id']]['podkategorie'][$row3['id']]['pocet_slozek'] = $pocet['pocet'];
						$seznam['kategorie'][$row['id']]['podkategorie'][$row2['id']]['podkategorie'][$row3['id']]['id'] = $row3['id'];
						$seznam['kategorie'][$row['id']]['podkategorie'][$row2['id']]['podkategorie'][$row3['id']]['parent_id'] = $row3['parent_id'];
						$seznam['kategorie'][$row['id']]['podkategorie'][$row2['id']]['podkategorie'][$row3['id']]['title'] = $row3['title'];
						$seznam['kategorie'][$row['id']]['podkategorie'][$row2['id']]['podkategorie'][$row3['id']]['text'] = $row3['text'];
						$seznam['kategorie'][$row['id']]['podkategorie'][$row2['id']]['podkategorie'][$row3['id']]['datum'] = $row3['datum'];
						$seznam['kategorie'][$row['id']]['podkategorie'][$row2['id']]['podkategorie'][$row3['id']]['sort'] = $row3['sort'];
						$sql = "select * FROM knihovna WHERE parent_id = ".$row3['id']." order by title asc";
						foreach ($this->web->query($sql) as $row4) {
							$sql = "select count(id) as pocet FROM knihovna_soubory WHERE parent_id = ".$row4['id'];
							$pocet = $this->web->query($sql,1);
							$seznam['kategorie'][$row['id']]['podkategorie'][$row2['id']]['podkategorie'][$row3['id']]['podkategorie'][$row4['id']]['pocet_souboru'] = $pocet['pocet'];
							$sql = "select count(id) as pocet FROM knihovna WHERE parent_id = ".$row4['id'];
							$pocet = $this->web->query($sql,1);
							$seznam['kategorie'][$row['id']]['podkategorie'][$row2['id']]['podkategorie'][$row3['id']]['podkategorie'][$row4['id']]['pocet_slozek'] = $pocet['pocet'];
							$seznam['kategorie'][$row['id']]['podkategorie'][$row2['id']]['podkategorie'][$row3['id']]['podkategorie'][$row4['id']]['id'] = $row4['id'];
							$seznam['kategorie'][$row['id']]['podkategorie'][$row2['id']]['podkategorie'][$row3['id']]['podkategorie'][$row4['id']]['parent_id'] = $row4['parent_id'];
							$seznam['kategorie'][$row['id']]['podkategorie'][$row2['id']]['podkategorie'][$row3['id']]['podkategorie'][$row4['id']]['title'] = $row4['title'];
							$seznam['kategorie'][$row['id']]['podkategorie'][$row2['id']]['podkategorie'][$row3['id']]['podkategorie'][$row4['id']]['text'] = $row4['text'];
							$seznam['kategorie'][$row['id']]['podkategorie'][$row2['id']]['podkategorie'][$row3['id']]['podkategorie'][$row4['id']]['datum'] = $row4['datum'];
							$seznam['kategorie'][$row['id']]['podkategorie'][$row2['id']]['podkategorie'][$row3['id']]['podkategorie'][$row4['id']]['sort'] = $row4['sort'];

						}
					}				
				}
			}
		}
		return $seznam;
	}

	public function seznam_souboru($params = array()) {
		$seznam = array();
		if($params['hledani']) {
			$sql = "select * from knihovna_soubory where title LIKE '%".$params['hledani']."%' OR filename LIKE '%".$params['hledani']."%'";
		}
		else {
			$sql = "select count(*) as pocet FROM knihovna_soubory ";
			if($params['zobrazit'] == 'images') {
				$where == 1 ? $sql.= "AND " : $sql.= "WHERE ";
				$sql.= "WHERE type = 'image/jpeg' OR type = 'img' "; 
				$where = 1; 
			}
			if($params['kategorie']) {
				$where == 1 ? $sql.= "AND " : $sql.= "WHERE ";
				$sql.= "parent_id = ".$params['kategorie']." "; 
				$where = 1; 				
			}			
			$row = $this->web->query($sql,1);
			$seznam['pocet_stran'] = ceil($row['pocet']/$params['pocet_na_strane']);

			$sql = "select * FROM knihovna_soubory ";
			$where = 0; 
			if($params['zobrazit'] == 'images') {
				$where == 1 ? $sql.= "AND " : $sql.= "WHERE ";
				$sql.= "WHERE type = 'image/jpeg' OR type = 'img' "; 
				$where = 1; 
			}
			if($params['kategorie']) {
				$where == 1 ? $sql.= "AND " : $sql.= "WHERE ";
				$sql.= "parent_id = ".$params['kategorie']." "; 
				$where = 1; 				
			}
			$sql.= "ORDER by main desc ";
			if($params['LIMIT']) {
				$sql.= "LIMIT ".$params['limit']." ";				
			}
		}
		foreach ($this->web->query($sql) as $row) {
			if($row['main'] == 1) {
				$seznam['soubory']['hlavni_foto']['id'] = $row['id']; 
				$seznam['soubory']['hlavni_foto']['title'] = $row['title']; 
				$seznam['soubory']['hlavni_foto']['filename'] = $row['filename']; 
				$seznam['soubory']['hlavni_foto']['width'] = $row['width']; 
				$seznam['soubory']['hlavni_foto']['height'] = $row['height']; 
				$seznam['soubory']['hlavni_foto']['parent_id'] = $row['parent_id']; 
				$seznam['soubory']['hlavni_foto']['autor'] = $row['autor']; 
				$seznam['soubory']['hlavni_foto']['type'] = $row['type']; 
				$seznam['soubory']['hlavni_foto']['sort'] = $row['sort']; 
				$seznam['soubory']['hlavni_foto']['main'] = $row['main']; 	
			}
			else {
				$seznam['soubory'][$row['id']]['id'] = $row['id']; 
				$seznam['soubory'][$row['id']]['title'] = $row['title']; 
				$seznam['soubory'][$row['id']]['filename'] = $row['filename']; 
				$seznam['soubory'][$row['id']]['width'] = $row['width']; 
				$seznam['soubory'][$row['id']]['height'] = $row['height']; 
				$seznam['soubory'][$row['id']]['parent_id'] = $row['parent_id']; 
				$seznam['soubory'][$row['id']]['autor'] = $row['autor']; 
				$seznam['soubory'][$row['id']]['type'] = $row['type']; 
				$seznam['soubory'][$row['id']]['sort'] = $row['sort']; 
				$seznam['soubory'][$row['id']]['main'] = $row['main']; 				
			}
		}
		return $seznam;
	}

	public function pridat_kategorii() {
		$timestamp = date('Y-m-d');
		$data = array(
			0,
			$_POST['parent_id'],
			$_POST['title'],
			$_POST['text'],
			$timestamp,
			0
		);
		$this->web->addEntry('knihovna', $data);
	}
	
	public function kategorie($id) {
		$sql = "select * from knihovna WHERE id=".$id." ";
		return $this->web->query($sql,1);
	}

	public function upravit_kategorii($id) {
		$data = array(
			'parent_id' => $_POST['parent_id'],
			'title' => $_POST['title'],
		);
		$this->web->editEntries('knihovna', $data, 'id='.$id);
	}

	public function smazat_kategorii($id) {
		$this->web->deleteEntry('knihovna', 'id='.$id);
	}

	public function nastavit_hlavni($id_fotky, $id_alba) {
		// nastaveni 0 u vsech fotek v albu
			$data = array(
				'main' => 0
			);
			$this->web->editEntries('knihovna_soubory', $data, 'parent_id='.$id_alba);
		
		// nastaveni 1 u oznacene fotky
			$data = array(
				'main' => 1
			);
			$this->web->editEntries('knihovna_soubory', $data, 'id='.$id_fotky);
	}

	public function pridat_soubory($vodotisk) {
		$datum = date('Y-m-d');
		$files = $_FILES;
        if (!empty($files)) {
        	$timestamp = date('YmdHis');
            $ds = DIRECTORY_SEPARATOR; 
            $tempFile = $files['file']['tmp_name'];
            if(!opendir(IMAGES_UPLOADS . $ds)) {
                mkdir(IMAGES_UPLOADS . $ds);
            }
            $targetPath = IMAGES_UPLOADS . $ds;
            $filename = $timestamp . '-' . substr($files['file']['name'],0,-4);
            $filenameDB = $timestamp . '-' . $files['file']['name'];
            $targetFile =  $targetPath . $filename;
            $size = getimagesize($files['file']['tmp_name']);
			$width = $size[0];
			$height = $size[1];
			// pridani vodoznaku
			if($vodotisk == 1) {
				$this->web->nahrat_soubor_s_vodoznakem($tempFile, VODOZNAK, $targetPath, $filename);        				
			}
			else {
				$this->web->nahrat_soubor_bez_vodoznaku($tempFile, $targetPath, $filename);        				
			}
    		$data = array(
				0,											// id
				'',											// title
				$filenameDB,								// filename
				$width,										// width
				$height,									// height
				$datum,										// datum
				$_POST['parent_id'],						// parent_id
				0,											// autor
				$files['file']['type'],						// type
				0,											// sort
				0											// main
			);
			$this->web->addEntry('knihovna_soubory', $data);
        }
	}

	public function upravit_soubor($id) {
		print_r($_POST);
		$data = array(
			'title' => $_POST['title'],
			'parent_id' => $_POST['parent_id'],
		);
		$this->web->editEntries('knihovna_soubory', $data, 'id='.$id);
	}

	public function soubor($id) {
		$sql = "select * from knihovna_soubory where id=".$id." ";
		return $this->web->query($sql,1);
	}

	public function nazev_souboru($id) {
		$sql = "select filename from knihovna_soubory where id=".$id." ";
		$row = $this->web->query($sql,1);
		return $row['filename'];
	}

	public function smazat_soubor($id) {
		unlink(IMAGES_UPLOADS . $this->nazev_souboru($id));
		$this->web->deleteEntry('knihovna_soubory','id='.$id);
	}
}
?>