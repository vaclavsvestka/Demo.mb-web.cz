<?php 
	$tpl->assign('zakaznici', $zakaznici->seznam_zakazniku());
    if(!empty($id)) { 
    	$tpl->assign('zakaznik', $zakaznici->zakaznik($id)); 
    }
	
	$file = "default.tpl";
	
	switch ($p2) {
		case 'novy':
			if($_GET['akce'] == 'ulozit') {
				$id = $$p1->pridat($_POST['id']);
				if($_POST['button'] == 'send_exit') { 
                	header('Location: /admin/'.$p1.'');
	            }
	    		else if($_POST['button'] == 'send') { 
	            	header('Location: /admin/'.$p1.'/edit/'.$id.'/'); 			        	
	    		}
			}
			else {
				$file = "form.tpl"; 
				$tpl->display(ADMIN_PAGES . $p1.'/'.$file);					
			}
			break;
		case 'edit':
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
			break;
		case 'smazat':
			$$p1->smazat($id);
        	header('Location: /admin/'.$p1.'');                    
			break;
		default:
			$tpl->display(ADMIN_PAGES . $p1.'/'.$file);
			break;
	}
?>