<?php
class nastaveni {
	private $tpl = null;
	private $web = null;

	public function __construct() {
		$this->tpl = new web_Smarty;
		$this->web = new web;
	}	

	public function nacti() {
		return $this->web->getEntry('*','nastaveni');
	}

	public function edit($id) {
		$data = array(
            'nazev_stranek' => $_POST['nazev_stranek'], 
            'facebook' => $_POST['facebook'], 
            'twitter' => $_POST['twitter'], 
            'linkedin' => $_POST['linkedin'], 
            'google_plus' => $_POST['google_plus'],
            'youtube' => $_POST['youtube'],
            'instagram' => $_POST['instagram'],
            'email'=> $_POST['email']
        );
        $this->web->editEntries('nastaveni', $data, 'id='.$id);
	}

	public function zjistiEmail() {
		$row = $this->web->getEntry('email','nastaveni');
		return $row['email'];
	}
}
?>