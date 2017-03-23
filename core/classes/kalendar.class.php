<?php
class kalendar {

	private $tpl = null;
	private $web = null;
	private $cols_kalendar = array('id','nazev','popis','typ_udalosti','autor','od_datum','do_datum','od_cas','do_cas');
	private $cols_kalendar_soubory = array('id','id_udalosti','filename','width','height','datum','type');
	
	public function __construct( $date_string = null ) {
		$this->tpl = new web_Smarty;
		$this->web = new web;
	}

	public function seznam_udalosti() {
		$sql = "select * from kalendar order by od_datum asc, od_cas asc";
		foreach($this->web->query($sql) as $row) {
			foreach($this->cols_kalendar as $col) {
				$udalosti[$row['id']][$col] = $row[$col];
			}
			$udalosti[$row['id']]['soubory'] = $this->soubory_k_udalosti($row['id']);
		}
		return $udalosti;
	}

	public function udalost($id) {
		$sql = "select * from kalendar where id = ".$id;
		$row = $this->web->query($sql,1);
		foreach($this->cols_kalendar as $col) {
			$udalost[$col] = $row[$col];
		}
		$udalost['soubory'] = $this->soubory_k_udalosti($id);
		return $udalost;	
	}

	public function seznam_nasledujicich_udalosti() {
		$sql = "select * from kalendar where od_datum >= CURDATE() order by od_datum asc, od_cas asc";
		foreach($this->web->query($sql) as $row) {
			foreach($this->cols_kalendar as $col) {
				$udalosti[$row['id']][$col] = $row[$col];
			}
		}
		return $udalosti;
	}

	public function soubory_k_udalosti($id_udalosti) {
		$sql = "select * from kalendar_soubory where id_udalosti = ".$id_udalosti;
		foreach($this->web->query($sql) as $row) {
			foreach($this->cols_kalendar_soubory as $col) {
				$soubory[$row['id']][$col] = $row[$col];
			}
		}
		return $soubory;
	}

	public function pridat() {
		$sql = "insert into kalendar (id,nazev,popis,autor,od_datum,od_cas,do_datum,do_cas) ";
		$sql.= "values (0,'".$_POST['nazev']."','".$_POST['popis']."',".$_SESSION['logged_user'].",'".$_POST['od_datum']."','".$_POST['od_cas']."','".$_POST['do_datum']."','".$_POST['do_cas']."')";
		$this->web->query($sql);
		$this->web->setLastId();
		$id = $this->web->getLastId();
		$this->pridat_soubory_k_udalosti($id);
	}

	public function pridat_soubory_k_udalosti($id_udalosti) {
		$soubor = $_FILES['soubor'];
		$timestamp = date('YmdHis');
		for($i=0;$i<=4;$i++) {
			if($soubor['tmp_name'][$i] != "") {
				$ds = DIRECTORY_SEPARATOR; 
	            $tempFile = $soubor['tmp_name'][$i];
	            if(!opendir(KALENDAR_FILES_UPLOADS . $ds)) { mkdir(KALENDAR_FILES_UPLOADS . $ds); }
	            $targetPath = KALENDAR_FILES_UPLOADS . $ds;
	            $filename = $timestamp . '-' . $soubor['name'][$i];
	            $targetFile =  $targetPath . $filename;
	            move_uploaded_file($tempFile,$targetFile);
	            $width = "";
	            $height = "";
	            $datum = date('Y-m-d H:i:s');
	            $type = "";
	            $data = array(0,$id_udalosti,$filename,$width,$height,$datum,$type);
	            $this->web->addEntry('kalendar_soubory',$data);
			}
		}
	}

	
}

?>