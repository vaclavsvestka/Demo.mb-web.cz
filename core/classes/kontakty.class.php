<?php
define('IMAGE_UPLOADS', MAIN_SITE . 'contact_images/');
define('VIZITKY_UPLOADS', MAIN_SITE . 'contact_vizitky/');
class kontakty {
	private $tpl = null;
	private $web = null;
	
	public function __construct() {
		$this->tpl = new web_Smarty;
		$this->web = new web;
	}	

	public function seznam_kontaktu($params = array()) {
		$sql = "select A.*, A.id as id_kontaktu, A.nazev as nazev_kontaktu, B.nazev as nazev_pobocky ";
		$sql.= "FROM kontakty A ";
		$sql.= "LEFT JOIN kontakty_skupiny B ON A.skupina = B.id ";
		if(isset($params['skupina'])) {
			$sql.= "WHERE A.skupina = ".$params['skupina']." ";
		}
		return $this->web->query($sql);
	}

	public function seznam_skupin_kontaktu() {
		return $this->web->getEntries('*', 'kontakty_skupiny');
	}

	public function kontakt($id) {
		$sql = "SELECT * FROM kontakty WHERE id=".$id;
		$row = $this->web->query($sql, 1);
		$lide = explode('|', $row['lide']);
		foreach ($lide as $kontakt) {
			$row['kontakty'][] = $kontakt;
		}
		if($row['skupina'] == 1) {
			$sql = "SELECT * FROM kontakty_provoz WHERE pobocka=".$row['id'];			
			$provoz = $this->web->query($sql);
			foreach ($provoz as $den) {
				$row['provozni_doba'][$den['den']] = $den;
			}
		}
		return $row;
	}

	public function edit($id) {
		$timestamp = date('YmdHis');
		$kontakty = "";
		$count = count($_POST['pobocky_lide']);
		$i = 0;
		foreach ($_POST['pobocky_lide'] as $kontakt => $value) {
			$kontakty.= $value;
			if(++$i !== $count) {
				$kontakty.= "|";				
			}
		}
		$data = array(
			'nazev' => $_POST['nazev'], 
			'dlouhy_nazev' => $_POST['dlouhy_nazev'], 'umisteni' => $_POST['umisteni'], 'telefon' => $_POST['telefon'],
			'mobil' => $_POST['mobil'], 'email' => $_POST['email'], 'web' => $_POST['web'], 'mapa' => $_POST['mapa'],
			'skupina' => $_POST['skupina'], 'lide' => $kontakty
		);
		$this->web->editEntries('kontakty', $data, 'id='.$id);
		if($_POST['skupina'] == 1) {
			for($j=1;$j<=7;$j++) {
				$data = array(
					'dop_od' => $_POST[$j.'_dop_od'], 
					'dop_do' => $_POST[$j.'_dop_do'], 
					'odp_od' => $_POST[$j.'_odp_od'], 
					'odp_do' => $_POST[$j.'_odp_do']
				);	
				$this->web->editEntries('kontakty_provoz', $data, 'pobocka='.$id.' and den='.$j.'');
			}
		}
		if (!empty($_FILES['foto']['name'])) {
            $ds = DIRECTORY_SEPARATOR; 
            $tempFile = $_FILES['foto']['tmp_name'];
            if(!opendir(IMAGE_UPLOADS . $ds)) {
                mkdir(IMAGE_UPLOADS . $ds);
            }
            $targetPath = IMAGE_UPLOADS . $ds;
            $filename = $timestamp . '-' . $_FILES['foto']['name'];
            $targetFile =  $targetPath . $filename;
            move_uploaded_file($tempFile,$targetFile);
			$data = array(
				'foto' => $timestamp . '-' . $_FILES['foto']['name'],
			);
			$this->web->editEntries('kontakty', $data, 'id='.$id);
        }
		if (!empty($_FILES['qr']['name'])) {
            $ds = DIRECTORY_SEPARATOR; 
            $tempFile = $_FILES['qr']['tmp_name'];
            if(!opendir(IMAGE_UPLOADS . $ds)) {
                mkdir(IMAGE_UPLOADS . $ds);
            }
            $targetPath = IMAGE_UPLOADS . $ds;
            $filename = $timestamp . '-' . $_FILES['qr']['name'];
            $targetFile =  $targetPath . $filename;
            move_uploaded_file($tempFile,$targetFile);
            $data = array(
				'qr' => $timestamp . '-' . $_FILES['qr']['name'],
			);
			$this->web->editEntries('kontakty', $data, 'id='.$id);
        }
        if (!empty($_FILES['vizitka']['name'])) {
            $ds = DIRECTORY_SEPARATOR; 
            $tempFile = $_FILES['vizitka']['tmp_name'];
            if(!opendir(VIZITKY_UPLOADS . $ds)) {
                mkdir(VIZITKY_UPLOADS . $ds);
            }
            $targetPath = VIZITKY_UPLOADS . $ds;
            $filename = $timestamp . '-' . $_FILES['vizitka']['name'];
            $targetFile =  $targetPath . $filename;
            move_uploaded_file($tempFile,$targetFile);
            $data = array(
				'vizitka' => $timestamp . '-' . $_FILES['vizitka']['name'],
			);
			$this->web->editEntries('kontakty', $data, 'id='.$id);
        }
	}

	public function pridat() {
		$timestamp = date('YmdHis');
		$kontakty = "";
		$count = count($_POST['pobocky_lide']);
		$i = 0;
		foreach ($_POST['pobocky_lide'] as $kontakt => $value) {
			$kontakty.= $value;
			if(++$i !== $count) {
				$kontakty.= "|";				
			}
		}
		if(!empty($_FILES['foto']['name'])) { $foto = $timestamp . '-' . $_FILES['foto']['name']; } else { $foto = ''; }
		if(!empty($_FILES['qr']['name'])) { $qr = $timestamp . '-' . $_FILES['qr']['name']; } else { $qr = ''; }
		if(!empty($_FILES['vizitka']['name'])) { $vizitka = $timestamp . '-' . $_FILES['vizitka']['name']; } else { $vizitka = ''; }
		$data = array(
			0, $_POST['nazev'], $_POST['dlouhy_nazev'], $_POST['umisteni'], $_POST['telefon'], $_POST['mobil'], 
			$_POST['email'], $_POST['web'], $_POST['mapa'], $_POST['skupina'], $foto, $qr, $vizitka, $kontakty
		);
		$this->web->addEntry('kontakty', $data);
		$this->web->setLastId();
		$id = $this->web->getLastId();
		if($_POST['skupina'] == 1) {
			for($i=1;$i<=7;$i++) {
				$data = array(
					0, $id, $i, $_POST[''.$i.'_dop_od'], $_POST[''.$i.'_dop_do'], $_POST[''.$i.'_odp_od'], $_POST[''.$i.'_odp_do']
				);	
				$this->web->addEntry('kontakty_provoz', $data);				
			}
		}
        if (!empty($_FILES['foto']['name'])) {
            $ds = DIRECTORY_SEPARATOR; 
            $tempFile = $_FILES['foto']['tmp_name'];
            if(!opendir(IMAGE_UPLOADS . $ds)) {
                mkdir(IMAGE_UPLOADS . $ds);
            }
            $targetPath = IMAGE_UPLOADS . $ds;
            $filename = $timestamp . '-' . $_FILES['foto']['name'];
            $targetFile =  $targetPath . $filename;
            move_uploaded_file($tempFile,$targetFile);
        }
        if (!empty($_FILES['qr']['name'])) {
            $ds = DIRECTORY_SEPARATOR; 
            $tempFile = $_FILES['qr']['tmp_name'];
            if(!opendir(IMAGE_UPLOADS . $ds)) {
                mkdir(IMAGE_UPLOADS . $ds);
            }
            $targetPath = IMAGE_UPLOADS . $ds;
            $filename = $timestamp . '-' . $_FILES['qr']['name'];
            $targetFile =  $targetPath . $filename;
            move_uploaded_file($tempFile,$targetFile);
        }
        if (!empty($_FILES['vizitka']['name'])) {
            $ds = DIRECTORY_SEPARATOR; 
            $tempFile = $_FILES['vizitka']['tmp_name'];
            if(!opendir(VIZITKY_UPLOADS . $ds)) {
                mkdir(VIZITKY_UPLOADS . $ds);
            }
            $targetPath = VIZITKY_UPLOADS . $ds;
            $filename = $timestamp . '-' . $_FILES['vizitka']['name'];
            $targetFile =  $targetPath . $filename;
            move_uploaded_file($tempFile,$targetFile);
        }
	}

	public function smazat($id) {
		$this->web->deleteEntryById('kontakty', $id);
	}

}
?>