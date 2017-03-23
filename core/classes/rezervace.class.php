<?php
class rezervace {
	private $tpl = null;
	private $web = null;
	private $userId = null;
	
	public function __construct() {
		$this->tpl = new web_Smarty;
		$this->web = new web;
	}

	public function pridat() {
		$datum = date('Y-m-d');
		if(!empty($_POST['zakaznik_id'])) {
			$zakaznik = $_POST['zakaznik_id'];
		}
		else {
			$data = array(
				0, $_POST['firma'], $_POST['jmeno'], $_POST['prijmeni'], $_POST['ulice'], $_POST['mesto'], $_POST['psc'], $_POST['telefon'],
				$_POST['email'], $_POST['status'], $datum, $_POST['poznamka']
	 		);
			$this->web->addEntry('zakaznici', $data);
			$this->web->setLastId();
			$zakaznik = $this->web->getLastId();
		}
		// Vypocet ceny
		// $pocet_dni = $this->web->date_diff($_POST['datum_od'], $_POST['datum_do']);
		// $cena = "";
		$data = array(
			0, $_POST['datum_od'], $_POST['datum_do'], $datum, $cena, "nova", $_POST['pokoj_id'], $zakaznik,
 		);
		$this->web->addEntry('rezervace', $data);
		$this->web->setLastId();
		$id = $this->web->getLastId();
		return $id;	
	}	

}
?>