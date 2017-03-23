<?php
class produkty {
	private $tpl = null;
	private $web = null;
	private $userId = null;
	private $cols_produkty = array('id','nazev','kratky_popis','popis','znacka','datum_vytvoreni','datum_editace','sort','aktivni','url','stara_cena');
	private $cols_produkty_ceny = array('id','id_produktu','cena_czk','datum_zmeny');
	private $cols_parametry_produktu = array('id','nazev','popis');
	private $cols_produkty_kategorie = array('id_produktu','id_kategorie');
	private $cols_produkty_soubory = array('id','id_produktu','title','filename','width','height','datum','parent_id','autor','type','sort','main');
	private $cols_kategorie_produktu_soubory = array('id','id_kategorie','title','filename','width','height','datum','parent_id','autor','type','sort','main');
	private $cols_kategorie_produktu = array('id','parent_id','nazev','popis','datum_vytvoreni','datum_editace','sort','aktivni','url');
	private $cols_znacky_produktu = array('id','nazev','popis','datum_vytvoreni','datum_editace','sort','aktivni','url');
	private $cols_stitky_produktu = array('id','nazev');
	
	public function __construct() {
    	include_once CLASSES . "knihovna.class.php";
		$this->tpl = new web_Smarty;
		$this->web = new web;
		$this->knihovna = new knihovna;
	}

	# kategorie
		public function seznam_kategorii($params) {
			$kategorie = array();
			$sql = "select * from kategorie_produktu where parent_id = 0 order by sort asc";
			foreach($this->web->query($sql) as $row) {
				foreach($this->cols_kategorie_produktu as $col) {
					$kategorie[$row['id']][$col] = $row[$col];
					$kategorie[$row['id']]['obrazky'] = $this->prirad_obrazky_kategorie($row['id']);
					$sql2 = "select * from kategorie_produktu where parent_id = ".$row['id']." order by sort asc";
					foreach($this->web->query($sql2) as $row2) {
						foreach($this->cols_kategorie_produktu as $col2) {
							$kategorie[$row['id']]['podkategorie'][$row2['id']][$col2] = $row2[$col2];
							$kategorie[$row['id']]['podkategorie'][$row2['id']]['obrazky'] = $this->prirad_obrazky_kategorie($row2['id']);
							$sql3 = "select * from kategorie_produktu where parent_id = ".$row2['id']." order by sort asc";
							foreach($this->web->query($sql3) as $row3) {
								foreach($this->cols_kategorie_produktu as $col3) {
									$kategorie[$row['id']]['podkategorie'][$row2['id']]['podkategorie'][$row3['id']][$col3] = $row3[$col3];
									$kategorie[$row['id']]['podkategorie'][$row2['id']]['podkategorie'][$row3['id']]['obrazky'] = $this->prirad_obrazky_kategorie($row3['id']);
									$sql4 = "select * from kategorie_produktu where parent_id = ".$row3['id']." order by sort asc";
									foreach($this->web->query($sql4) as $row4) {
										foreach($this->cols_kategorie_produktu as $col4) {
											$kategorie[$row['id']]['podkategorie'][$row2['id']]['podkategorie'][$row3['id']]['podkategorie'][$row4['id']][$col4] = $row4[$col4];
											$kategorie[$row['id']]['podkategorie'][$row2['id']]['podkategorie'][$row3['id']]['podkategorie'][$row4['id']]['obrazky'] = $this->prirad_obrazky_kategorie($row4['id']);
										}
									}
								}
							}
						}
					}
				}
			}
			return $kategorie;
		}

		public function kategorie($id) {
			$kategorie = array();
			$sql = "select * from kategorie_produktu where id = ".$id;
			$row = $this->web->query($sql,1);
			foreach($this->cols_kategorie_produktu as $col) {
				$kategorie[$col] = $row[$col];
				$kategorie['obrazky'] = $this->prirad_obrazky_kategorie($row['id']);
			}
			return $kategorie;	
		}

		public function pridat_kategorie() {
			$datum = date('Y-m-d H:i:s');
			$url = $this->pridat_kategorie_kontrola_url($_POST['nazev']);
			$data = array(
				0, $_POST['parent_id'], $_POST['nazev'], $_POST['popis'], $datum, 0, $_POST['sort'], $_POST['aktivni'], $url
			);
			$this->web->addEntry('kategorie_produktu', $data);
			$this->web->setLastId();
			$id = $this->web->getLastId();
			$this->pridat_obrazky_ke_kategorii($_FILES['file'], $id);
			return $id;
		}
		
		public function edit_kategorie($id) {
			$datum = date('Y-m-d H:i:s');
			$data = array(
				'parent_id' => $_POST['parent_id'],
				'nazev' => $_POST['nazev'], 
				'popis' => $_POST['popis'],
				'datum_editace' => $datum, 
				'sort' => $_POST['sort'],
				'aktivni' => $_POST['aktivni'],
			);
			$this->web->editEntries('kategorie_produktu', $data, 'id='.$id);
			$this->pridat_obrazky_ke_kategorii($_FILES['file'], $id);
		}

		public function pridat_obrazky_ke_kategorii($files, $id_produktu) {
			$datum = date('Y-m-d');
			for($i=0;$i<=10;$i++) {
				if (!empty($files['name'][$i])) {
					$timestamp = date('YmdHis');
		            $ds = DIRECTORY_SEPARATOR; 
		            $tempFile = $files['tmp_name'][$i];
		            if(!opendir(IMAGES_UPLOADS . $ds)) {
		                mkdir(IMAGES_UPLOADS . $ds);
		            }
		            $targetPath = IMAGES_UPLOADS . $ds;
		            $filename = $timestamp . '-' . substr($files['name'][$i],0,-4);
		            $filenameDB = $timestamp . '-' . $files['name'][$i];
		            $targetFile =  $targetPath . $filename;
		            $size = getimagesize($files['tmp_name'][$i]);
					$width = $size[0];
					$height = $size[1];
					$this->web->nahrat_soubor_bez_vodoznaku($tempFile, $targetPath, $filename);        				
		    		if($i == 0) { $main = 1; } else { $main = 0; }
		    		$data = array(
						0,											// id
						$id_produktu,								// id_produktu
						'',											// title
						$filenameDB,								// filename
						$width,										// width
						$height,									// height
						$datum,										// datum
						0,											// parent_id
						0,											// autor
						$files['type'][$i],							// type
						0,											// sort
						$main										// main
					);
					$this->web->addEntry('kategorie_produktu_soubory', $data);
		        }
			}
		}

		public function pridat_kategorie_kontrola_url($nazev) {
	        $url = $this->web->nice_url($nazev);
			$sql = "select * from kategorie_produktu where url = '".$url."'";
	        if($this->web->query($sql,1)) { 
	        	$new_url = $url."-1"; 
	        }
	        else {
	        	$new_url = $url;
	        }
	        for($i=2;$i<=200;$i++) {
				$sql = "select * from kategorie_produktu where url = '".$new_url."'";
		        if($this->web->query($sql,1)) { 
		        	$new_url = $url."-".$i; 
		        }
	        }
	        return $new_url;
	    }

	    public function prirad_obrazky_kategorie($id) {
			$obrazky = array();
			$sql = "select * from kategorie_produktu_soubory where id_kategorie = ".$id;
			foreach($this->web->query($sql) as $row) {
				if($row['main'] == 1) {
					foreach($this->cols_kategorie_produktu_soubory as $col) {
						$obrazky['main'][$col] = $row[$col];
					}
				}
				else {
					foreach($this->cols_kategorie_produktu_soubory as $col) {
						$obrazky['ostatni'][$row['id']][$col] = $row[$col];
					}
				}
			}
			return $obrazky;
		}

		public function smazat_kategorie($id) {
			$this->web->deleteEntryById('kategorie_produktu', $id);
			$this->web->deleteEntry('produkty_kategorie','id_kategorie='.$id);
		}

	# parametry
		public function seznam_parametru($params) {
			$parametry = array();
			$sql = "select * from parametry_produktu";
			foreach($this->web->query($sql) as $row) {
				foreach($this->cols_parametry_produktu as $col) {
					$parametry[$row['id']][$col] = $row[$col];
				}
			}
			return $parametry;
		}

		public function parametr($id) {
			$parametr = array();
			$sql = "select * from parametry_produktu where id = ".$id;
			$row = $this->web->query($sql,1);
			foreach($this->cols_parametry_produktu as $col) {
				$parametr[$col] = $row[$col];
			}
			return $parametr;	
		}

		public function edit_parametry($id) {
			$datum = date('Y-m-d H:i:s');
			$data = array(
				'nazev' => $_POST['nazev'], 
				'popis' => $_POST['popis'],
			);
			$this->web->editEntries('parametry_produktu', $data, 'id='.$id);
		}

		public function pridat_parametry() {
			$datum = date('Y-m-d H:i:s');
			$data = array(
				0, $_POST['nazev'], $_POST['popis']
			);
			$this->web->addEntry('parametry_produktu', $data);
			$this->web->setLastId();
			$id = $this->web->getLastId();
			return $id;
		}

		public function smazat_parametry($id) {
			$this->web->deleteEntryById('parametry_produktu', $id);
			$this->web->deleteEntry('produkty_parametry','id_parametru='.$id);
		}

	# produkty
		public function seznam_produktu($params) {
			$produkty = array();
			$sql = "select * from produkty order by sort asc";
			foreach($this->web->query($sql) as $row) {
				foreach($this->cols_produkty as $col) {
					$produkty[$row['id']][$col] = $row[$col];
				}
				$produkty[$row['id']]['cena'] = $this->cena_produktu($row['id']);
				$produkty[$row['id']]['historie_cen'] = $this->historie_cen_produktu($row['id']);
			}
			return $produkty;
		}

		public function seznam_produktu_z_kategorie($kategorie, $id_produktu = null) {
			$produkty = array();
			$p2 = array();
			// prida do pole vsechny podkategorie
			$podkategorie = $this->najdi_podkategorie($kategorie);
			foreach($podkategorie as $key=>$value) {
				$sql = "select * from produkty_kategorie where id_kategorie=".$value;
				foreach($this->web->query($sql) as $row) {
					if($id_produktu != NULL) {
						if($row['id_produktu'] != $id_produktu) {
							$p2[] = $row['id_produktu'];
						}
					}
					else {
						$p2[] = $row['id_produktu'];
					}
					foreach($p2 as $kat => $value) {
						$sql2 = "select * from produkty where id=".$value;
						foreach($this->web->query($sql2) as $row2) {
							foreach($this->cols_produkty as $col) {
								$produkty[$row2['id']][$col] = $row2[$col];
							}
							$produkty[$row2['id']]['cena'] = $this->cena_produktu($row2['id']);
							$produkty[$row2['id']]['historie_cen'] = $this->historie_cen_produktu($row2['id']);
							$produkty[$row2['id']]['obrazky'] = $this->prirad_obrazky_produktu($row2['id']);
							$produkty[$row2['id']]['stitky'] = $this->prirad_stitky_produktu($row2['id']);
						}
					}
				}
			}
			return $produkty;
		}

		public function najdi_podkategorie($kategorie) {
			$kat = array();
			$kat[] = $kategorie;
			$sql = "select * from kategorie_produktu where id=".$kategorie;
			$row = $this->web->query($sql,1);
			if($row['parent_id'] != 0) { $kat[] = $row['id']; }
			for($i=1;$i<=6;$i++) {
				if(!empty($row['id'])) {
					$sql = "select * from kategorie_produktu where parent_id=".$row['id'];
					$row = $this->web->query($sql,1);
					if($row['parent_id'] != 0) { $kat[] = $row['id']; }
				}
			}
			return $kat;
		}

		public function produkt($id) {
			$produkt = array();
			$sql = "select * from produkty where id = ".$id;
			$row = $this->web->query($sql,1);
			foreach($this->cols_produkty as $col) {
				$produkt[$col] = $row[$col];
			}
			$produkt['parametry'] = $this->parametry_produktu($row['id']);
			$produkt['cena'] = $this->cena_produktu($row['id']);
			$produkt['historie_cen'] = $this->historie_cen_produktu($row['id']);
			$produkt['kategorie'] = $this->prirad_kategorie($row['id']);
			$produkt['obrazky'] = $this->prirad_obrazky_produktu($row['id']);
			$produkt['stitky'] = $this->prirad_stitky_produktu($row['id']);
			$produkt['podobne_produkty'] = $this->prirad_podobne_produkty($row['id']);
			return $produkt;	
		}

		public function prirad_podobne_produkty($id) {
			$kategorie = array();
			$sql = "select * from produkty_kategorie where id_produktu=".$id;
			foreach($this->web->query($sql) as $row) {
				$kategorie[] = $row['id_kategorie'];
			}
			foreach($kategorie as $kat=>$value) {
				$produkty = $this->seznam_produktu_z_kategorie($value, $id);
			}
			return $produkty;
		}
	
		public function prirad_kategorie($id) {
			$kategorie = array();
			$sql = "select * from produkty_kategorie where id_produktu = ".$id;
			foreach($this->web->query($sql) as $row) {
				$kategorie[$row['id_kategorie']] = $row['id_kategorie'];
			}
			return $kategorie;
		}

		public function prirad_stitky_produktu($id) {
			$stitky = array();
			$sql = "select * from produkty_stitky where id_produktu = ".$id;
			foreach($this->web->query($sql) as $row) {
				$stitky[$row['id_stitku']]['id_stitku'] = $row['id_stitku'] ;
				$sql2 = "select * from stitky_produktu where id = ".$row['id_stitku'];
				$row2 = $this->web->query($sql2,1);
				$stitky[$row['id_stitku']]['nazev'] = $row2['nazev'] ;
			}
			return $stitky;	
		}

		public function prirad_obrazky_produktu($id) {
			$obrazky = array();
			$sql = "select * from produkty_soubory where id_produktu = ".$id;
			foreach($this->web->query($sql) as $row) {
				if($row['main'] == 1) {
					foreach($this->cols_produkty_soubory as $col) {
						$obrazky['main'][$col] = $row[$col];
					}
				}
				else {
					foreach($this->cols_produkty_soubory as $col) {
						$obrazky['ostatni'][$row['id']][$col] = $row[$col];
					}
				}
			}
			return $obrazky;
		}

		public function edit_produkt($id) {
			$datum = date('Y-m-d H:i:s');
			$data = array(
				'nazev' => $_POST['nazev'], 
				'kratky_popis' => $_POST['kratky_popis'],
				'popis' => $_POST['popis'],
				'znacka' => $_POST['znacka'],
				'datum_editace' => $_POST['datum_editace'],
				'sort' => $_POST['sort'],
				'aktivni' => $_POST['aktivni'],
				'stara_cena' => $_POST['stara_cena'],
			);
			$this->web->editEntries('produkty', $data, 'id='.$id);
			// smazani z tabulky produkty_kategorie
			$this->web->deleteEntry('produkty_kategorie','id_produktu='.$id);
			// vlozeni novych dat do tabulky produkty_kategorie
			$this->pridat_produkty_kategorie($_POST['kategorie'], $id);		
			// uprava dat v radcich tabulky parametry_produktu
			$this->edit_parametry_produktu($_POST['parametr'], $id);
			// prida stitky k produktu
			$this->edit_stitky_produktu($_POST['stitky'], $id);		
			// pokud se zmeni cena, prida radek do tabulky produkty_ceny
			$this->uprav_cenu($id, $_POST['cena']);
			// prida obrazky
			$this->pridat_obrazky_k_produktu($_FILES['file'], $id);
			// smazani obrazku
			foreach($_POST['smazat_obrazek'] as $obr=>$value) {
				$this->smazat_obrazek_produktu($obr);
			}
			// nastaveni hlavniho obrazku
			if(!empty($_POST['hlavni_obrazek'])) {
				$this->nastavit_hlavni_obrazek_produktu($id, $_POST['hlavni_obrazek']);
			}
		}

		public function smazat_obrazek_produktu($id) {
			$sql = "select * from produkty_soubory where id=".$id;
			$row = $this->web->query($sql,1);
			$soubor = $row['filename'];
			$this->web->deleteEntryById('produkty_soubory', $id);
			$this->web->deleteFile(IMAGES_UPLOADS, $soubor);
		}

		public function nastavit_hlavni_obrazek_produktu($id_produktu, $id_obrazku) {
			$data = array('main' => 0);
			$this->web->editEntries('produkty_soubory', $data, 'id_produktu='.$id_produktu);
			$data = array('main' => 1);
			$this->web->editEntries('produkty_soubory', $data, 'id='.$id_obrazku);
		}

		public function pridat_produkt() {
			$datum = date('Y-m-d H:i:s');
			// nalezeni url v produktech
			$url = $this->pridat_produkt_kontrola_url($_POST['nazev']);
			$data = array(
				0, $_POST['nazev'], $_POST['kratky_popis'], $_POST['popis'], $_POST['znacka'], $datum, 0, $_POST['sort'], $_POST['aktivni'], $url, $_POST['stara_cena']
			);
			$this->web->addEntry('produkty', $data);
			$this->web->setLastId();
			$id = $this->web->getLastId();
			
			// prida cenu do tabulky produkty_ceny
			$this->uprav_cenu($id, $_POST['cena']);
			
			$this->pridat_produkty_kategorie($_POST['kategorie'], $id);
			$this->pridat_parametry_produktu($_POST['parametr'], $id);
			$this->pridat_stitky_produktu($_POST['stitky'], $id);

			// prida obrazky
			$this->pridat_obrazky_k_produktu($_FILES['file'], $id);

			// vraci cislo id
			return $id;
		}

		public function pridat_produkt_kontrola_url($nazev) {
	        $url = $this->web->nice_url($nazev);
			$sql = "select * from produkty where url = '".$url."'";
	        if($this->web->query($sql,1)) { 
	        	$new_url = $url."-1"; 
	        }
	        else {
	        	$new_url = $url;
	        }
	        for($i=2;$i<=200;$i++) {
				$sql = "select * from produkty where url = '".$new_url."'";
		        if($this->web->query($sql,1)) { 
		        	$new_url = $url."-".$i; 
		        }
	        }
	        return $new_url;
	    }

		public function pridat_parametry_produktu($parametry, $id_produktu) {
			foreach($parametry as $par=>$value) {
				$data = array(
					0, $id_produktu, $par, $value
				);
				$this->web->addEntry('produkty_parametry', $data);
			}
		}

		public function edit_parametry_produktu($parametry, $id_produktu) {
			foreach($parametry as $par=>$value) {
				$sql = 'select * from produkty_parametry where id_produktu='.$id_produktu.' and id_parametru='.$par;
				if($this->web->query($sql)) {
					$data = array(
						'hodnota' => $value, 
					);
					$this->web->editEntries('produkty_parametry', $data, 'id_produktu='.$id_produktu.' and id_parametru='.$par);
				}
				else {
					$data = array(
						0, $id_produktu, $par, $value
					);
					$this->web->addEntry('produkty_parametry', $data);		
				}
			}
		}

		public function pridat_stitky_produktu($stitky, $id_produktu) {
			foreach($stitky as $s=>$value) {
				$data = array(
					$id_produktu, $s
				);
				$this->web->addEntry('produkty_stitky', $data);
			}
		}

		public function edit_stitky_produktu($stitky, $id_produktu) {
			$this->web->deleteEntry('produkty_stitky','id_produktu='.$id_produktu);
			foreach($stitky as $s=>$value) {
				$data = array(
					$id_produktu, $s
				);
				$this->web->addEntry('produkty_stitky', $data);
			}
		}

		public function pridat_produkty_kategorie($kategorie, $id) {
			foreach($kategorie as $kat=>$value) {
				$data = array(
					$id, $value
				);
				$this->web->addEntry('produkty_kategorie', $data);
			}
		}

		public function pridat_obrazky_k_produktu($files, $id_produktu) {
			$datum = date('Y-m-d');
			for($i=0;$i<=10;$i++) {
				if (!empty($files['name'][$i])) {
					echo "i: ".$i."<br>";
					$timestamp = date('YmdHis');
		            $ds = DIRECTORY_SEPARATOR; 
		            $tempFile = $files['tmp_name'][$i];
		            if(!opendir(IMAGES_UPLOADS . $ds)) {
		                mkdir(IMAGES_UPLOADS . $ds);
		            }
		            $targetPath = IMAGES_UPLOADS . $ds;
		            $filename = $timestamp . '-' . substr($files['name'][$i],0,-4);
		            $filenameDB = $timestamp . '-' . $files['name'][$i];
		            $targetFile =  $targetPath . $filename;
		            $size = getimagesize($files['tmp_name'][$i]);
					$width = $size[0];
					$height = $size[1];
					$this->web->nahrat_soubor_bez_vodoznaku($tempFile, $targetPath, $filename);        				
		    		if($i == 0) { $main = 1; } else { $main = 0; }
		    		$data = array(
						0,											// id
						$id_produktu,								// id_produktu
						'',											// title
						$filenameDB,								// filename
						$width,										// width
						$height,									// height
						$datum,										// datum
						0,											// parent_id
						0,											// autor
						$files['type'][$i],							// type
						0,											// sort
						$main										// main
					);
					$this->web->addEntry('produkty_soubory', $data);
		        }
			}
		}
		
		public function cena_produktu($id) {
			$sql = "select * from produkty_ceny where id_produktu = ".$id." order by datum_zmeny desc, id desc LIMIT 1";
			$cena = $this->web->query($sql,1);
			return $cena['cena_czk'];
		}

		public function historie_cen_produktu($id) {
			$ceny = array();
			$sql = "select * from produkty_ceny where id_produktu = ".$id." order by datum_zmeny asc";
			foreach($this->web->query($sql) as $row) {
				foreach($this->cols_produkty_ceny as $col) {
					$ceny[$row['id']][$col] = $row[$col];
				}	
			}
			return $ceny;
		}

		public function parametry_produktu($id) {
			$parametry = array();
			$sql = "select * from produkty_parametry where id_produktu = ".$id;
			foreach($this->web->query($sql) as $row) {
				$parametry[$row['id_parametru']]['id_parametru'] = $row['id_parametru'] ;
				$sql2 = "select * from parametry_produktu where id = ".$row['id_parametru'];
				$row2 = $this->web->query($sql2,1);
				$parametry[$row['id_parametru']]['nazev_parametru'] = $row2['nazev'] ;
				$parametry[$row['id_parametru']]['hodnota'] = $row['hodnota'] ;
			}
			return $parametry;	
		}

		public function uprav_cenu($id_produktu, $nova_cena) {
			$sql = "select * from produkty_ceny where id_produktu = ".$id_produktu." order by datum_zmeny desc, id desc LIMIT 1";
			$row = $this->web->query($sql,1);
			$aktualni_cena = $row['cena_czk'];
			if($aktualni_cena != $nova_cena) {
				$datum = date('Y-m-d');
				$data = array(
					0, $id_produktu, $nova_cena, $datum
				);
				$this->web->addEntry('produkty_ceny', $data);
			}
		}

		public function smazat_produkt($id) {
			$this->web->deleteEntryById('produkty', $id);
			$this->web->deleteEntry('produkty_ceny','id_produktu='.$id);
			$this->web->deleteEntry('produkty_kategorie','id_produktu='.$id);
			$this->web->deleteEntry('produkty_parametry','id_produktu='.$id);
			$this->web->deleteEntry('produkty_stitky','id_produktu='.$id);
			// smazani obrazku
			$sql = "select * from produkty_soubory where id_produktu=".$id;
			foreach($this->web->query($sql) as $row) {
				$this->smazat_obrazek_produktu($row['id']);
			}
			$this->web->deleteEntry('produkty_soubory','id_produktu='.$id);
		}

	# znacky
		public function seznam_znacek($params) {
			$znacky = array();
			$sql = "select * from znacky_produktu order by nazev asc";
			foreach($this->web->query($sql) as $row) {
				foreach($this->cols_znacky_produktu as $col) {
					$znacky[$row['id']][$col] = $row[$col];
				}
			}
			return $znacky;
		}

		public function znacka($id) {
			$znacka = array();
			$sql = "select * from znacky_produktu where id = ".$id;
			$row = $this->web->query($sql,1);
			foreach($this->cols_znacky_produktu as $col) {
				$znacka[$col] = $row[$col];
			}
			return $znacka;	
		}

		public function edit_znacku($id) {
			$datum = date('Y-m-d H:i:s');
			$data = array(
				'nazev' => $_POST['nazev'], 
				'popis' => $_POST['popis'],
				'datum_editace' => $datum, 
				'aktivni' => $_POST['aktivni'],
			);
			$this->web->editEntries('znacky_produktu', $data, 'id='.$id);
		}

		public function pridat_znacku() {
			$datum = date('Y-m-d H:i:s');
			$url = $this->web->nice_url($_POST['nazev']);
			$data = array(
				0, $_POST['nazev'], $_POST['popis'], $datum, 0, 0, $_POST['aktivni'], $url
			);
			$this->web->addEntry('znacky_produktu', $data);
			$this->web->setLastId();
			$id = $this->web->getLastId();
			return $id;
		}

		public function smazat_znacku($id) {
			$this->web->deleteEntryById('znacky_produktu', $id);
			$this->web->deleteEntry('produkty_znacka','id_znacky='.$id);
		}

	# stitky
		public function seznam_stitku($params) {
			$stitky = array();
			$sql = "select * from stitky_produktu order by nazev asc";
			foreach($this->web->query($sql) as $row) {
				foreach($this->cols_stitky_produktu as $col) {
					$stitky[$row['id']][$col] = $row[$col];
				}
			}
			return $stitky;
		}

		public function stitek($id) {
			$stitek = array();
			$sql = "select * from stitky_produktu where id = ".$id;
			$row = $this->web->query($sql,1);
			foreach($this->cols_stitky_produktu as $col) {
				$stitek[$col] = $row[$col];
			}
			return $stitek;	
		}
}
?>