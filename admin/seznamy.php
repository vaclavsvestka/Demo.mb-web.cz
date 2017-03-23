<?php
	if($p2 == "kategorie") {
		if(!empty($id)) { $tpl->assign('kategorie', $seznamy->kategorie($id)); }
	}
	else {
		if(!empty($id)) { $tpl->assign('polozka', $seznamy->seznam($id)); }			
	}		
	$tpl->assign('seznam_kategorii', $seznamy->seznam_kategorii());
    $tpl->assign('seznamy', $seznamy->seznamy());

	$file = "default.tpl";

	if(empty($p2)) {
		$tpl->display(ADMIN_PAGES . $p1.'/'.$file);
	}
	else {
		if(empty($p3)) {
			if($p2 == "novy") {
				if($_GET['akce'] == 'ulozit') {
					$id = $$p1->pridat();
					$web->setLastId();
					if($_POST['button'] == 'send_exit') { 
	                	header('Location: /admin/'.$p1.'');
		            }
		    		else if($_POST['button'] == 'send') { 
		            	header('Location: /admin/'.$p1.'/edit/'.$id.'/'); 			        	
		    		}
				}
				else {
					$file = "form.tpl"; 
					$tpl->display(ADMIN_PAGES . $p1 . '/' . $file);					
				}
			}
			elseif($p2 == "edit") {
				if($_GET['akce'] == 'ulozit') {
					$$p1->edit($_POST['id']);
					if($_POST['button'] == 'send_exit') { 
				        header('Location: /admin/'.$p1.'');
		            }
		    		else if($_POST['button'] == 'send') { 
			            header('Location: /admin/'.$p1.'/'.$p2.'/'.$_POST['id'].'/');			            
		    		}
				}
				else {
					$file = "form.tpl"; 
					$tpl->display(ADMIN_PAGES . $p1.'/'.$file);					
				}
			}
			elseif($p2 == "smazat-fotku") {
				$seznamy->smazat_fotku($_GET['id_fotky']);
				header('Location: /admin/seznamy/edit/'.$_GET['id_clanku']);
			}
			elseif($p2 == "smazat") {
				$$p1->smazat($id);
	        	header('Location: /admin/'.$p1.'');                    
			}
			else {
				$tpl->display(ADMIN_PAGES . $p1.'/'.$p2.'/'.$file);
			}
		}
		else {
			if(empty($p4)) {
				if($p3 == "novy") {
					if($_GET['akce'] == 'ulozit') {
						$funkce = "pridat_".$p2;
						$id = $$p1->$funkce($_POST['id']);
						if($_POST['button'] == 'send_exit') { 
				        	header('Location: /admin/'.$p1);		        		
			            }
			    		else if($_POST['button'] == 'send') { 
			            	header('Location: /admin/'.$p1.'/'.$p2.'/edit/'.$id.'/'); 			        	
			    		}
					}
					else {
						$file = "form.tpl"; 
						$tpl->display(ADMIN_PAGES . $p1.'/'.$p2.'/'.$file);					
					}						
				}
				elseif($p3 == "edit") {
					if($_GET['akce'] == 'ulozit') {
						$funkce = "edit_".$p2;
						$$p1->$funkce($_POST['id']);
						if($_POST['button'] == 'send_exit') { 
				        	header('Location: /admin/'.$p1);		        		
			            }
			    		else if($_POST['button'] == 'send') { 
				            header('Location: /admin/'.$p1.'/'.$p2.'/'.$p3.'/'.$_POST['id'].'/');			            
			    		}
					}
					else {
						$file = "form.tpl"; 
						$tpl->display(ADMIN_PAGES . $p1.'/'.$p2.'/'.$file);
					}
				}
				elseif($p3 == "smazat") {
					$funkce = "smazat_".$p2;
					$$p1->$funkce($id);
		        	header('Location: /admin/'.$p1);		        		
				}
				else {
					$tpl->display(ADMIN_PAGES . $p1.'/'.$p2.'/'.$file);
				}
				// if(is_numeric($p4)) {
				// 	$file = 'form.tpl';
				// 	$tpl->display(ADMIN_PAGES . $p1.'/'.$file);
				// }
				// else {
				// 	$tpl->display(ADMIN_PAGES . $p1.'/'.$p2.'/'.$p3.'/'.$file);					
				// }
			}
		}
	}		
?>