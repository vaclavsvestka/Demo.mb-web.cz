<?php 
	$file = "default.tpl";
	$tpl->assign('pokoje', $pokoje->seznam_pokoju());
	$tpl->assign('zakaznici', $zakaznici->seznam_zakazniku());
	if(empty($p2)) {
		$tpl->display(ADMIN_PAGES . $p1.'/'.$file);
	}
	else {
		if(empty($p3)) {
			if($p2 == "novy") {
				if($_GET['akce'] == 'ulozit') {
					$$p1->pridat($_POST['id']);
					$web->setLastId();
					if($_POST['button'] == 'send_exit') { 
	                	header('Location: /admin/'.$p1.'');
		            }
		    		else if($_POST['button'] == 'send') { 
		            	header('Location: /admin/'.$p1.'/edit/'.$web->getLastId().'/'); 			        	
		    		}
				}
				else {
					$file = "form.tpl"; 
					$tpl->display(ADMIN_PAGES . $p1.'/'.$file);					
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
						$$p1->$funkce($_POST['id']);
						if($_POST['button'] == 'send_exit') { 
							$web->setLastId();
		                	if($p1=="fotogalerie") {
		        				header('Location: /admin/'.$p1);
				        	}
				        	else {
				        		header('Location: /admin/'.$p1.'/'.$p2);		        		
				        	}
			            }
			    		else if($_POST['button'] == 'send') { 
			            	$web->setLastId();			            	
			            	header('Location: /admin/'.$p1.'/'.$p2.'/edit/'.$web->getLastId().'/'); 			        	
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
					        if($p1=="fotogalerie") {
		        				header('Location: /admin/'.$p1);
				        	}
				        	else {
				        		header('Location: /admin/'.$p1.'/'.$p2);		        		
				        	}
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
		        	if($p1=="fotogalerie") {
		        		header('Location: /admin/'.$p1);
		        	}
		        	else {
		        		header('Location: /admin/'.$p1.'/'.$p2);		        		
		        	}
				}
				else {
					$tpl->display(ADMIN_PAGES . $p1.'/'.$p2.'/'.$file);
				}
				if(is_numeric($p4)) {
					$file = 'form.tpl';
					$tpl->display(ADMIN_PAGES . $p1.'/'.$file);
				}
				else {
					$tpl->display(ADMIN_PAGES . $p1.'/'.$p2.'/'.$p3.'/'.$file);					
				}
			}
			else {
				if(empty($p5)) {
					$tpl->display(ADMIN_PAGES . $p1.'/'.$p2.'/'.$p3.'/'.$p4.'/'.$file);
				}
				else {
					if(empty($p6)) {
						$tpl->display(ADMIN_PAGES . $p1.'/'.$p2.'/'.$p3.'/'.$p4.'/'.$p6.'/'.$file);
					}
				}		
			}	
		}
	}		
?>